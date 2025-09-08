<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

use Illuminate\Support\Facades\{Config, Log, Session, Cache};
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Collection;

/**
 * Servizio per l'autenticazione SPID
 * 
 * Implementa il protocollo SAML 2.0 per l'integrazione con i provider SPID
 * secondo le specifiche AGID per l'autenticazione nelle PA
 */
class SpidAuthService
{
    protected array $providers = [];
    protected string $entityId;
    protected string $assertionConsumerServiceUrl;
    protected string $singleLogoutServiceUrl;

    public function __construct()
    {
        $this->entityId = config('spid.entity_id', config('app.url'));
        $this->assertionConsumerServiceUrl = route('spid.callback');
        $this->singleLogoutServiceUrl = route('spid.slo');
        $this->loadProviders();
    }

    /**
     * Carica la configurazione dei provider SPID
     */
    protected function loadProviders(): void
    {
        $this->providers = config('spid.providers', [
            'poste' => [
                'name' => 'Poste Italiane',
                'entityId' => 'https://posteid.poste.it',
                'sso_url' => 'https://posteid.poste.it/jod-fs/ssoservicepost',
                'slo_url' => 'https://posteid.poste.it/jod-fs/sloservicepost',
                'cert' => 'poste.crt',
                'logo' => 'poste-logo.svg',
            ],
            'sielte' => [
                'name' => 'Sielte',
                'entityId' => 'https://identity.sieltecloud.it',
                'sso_url' => 'https://identity.sieltecloud.it/simplesaml/saml2/idp/SSOService.php',
                'slo_url' => 'https://identity.sieltecloud.it/simplesaml/saml2/idp/SingleLogoutService.php',
                'cert' => 'sielte.crt',
                'logo' => 'sielte-logo.svg',
            ],
            'tim' => [
                'name' => 'TIM Trust Technologies',
                'entityId' => 'https://login.id.tim.it/affwebservices/public/saml2sso',
                'sso_url' => 'https://login.id.tim.it/affwebservices/public/saml2sso',
                'slo_url' => 'https://login.id.tim.it/affwebservices/public/saml2slo',
                'cert' => 'tim.crt',
                'logo' => 'tim-logo.svg',
            ],
        ]);
    }

    /**
     * Ottiene tutti i provider SPID disponibili
     */
    public function getProviders(): array
    {
        return $this->providers;
    }

    /**
     * Genera l'URL di login per un provider SPID specifico
     */
    public function getLoginUrl(string $provider, int $level = 2, ?string $returnUrl = null): string
    {
        if (!isset($this->providers[$provider])) {
            throw new \InvalidArgumentException("Provider SPID '{$provider}' non supportato");
        }

        $providerConfig = $this->providers[$provider];
        $requestId = $this->generateRequestId();
        
        // Salva lo stato della richiesta in sessione
        Session::put('spid.request_id', $requestId);
        Session::put('spid.provider', $provider);
        Session::put('spid.return_url', $returnUrl ?: url()->previous());
        Session::put('spid.auth_level', $level);

        $samlRequest = $this->buildSamlAuthRequest($requestId, $providerConfig, $level);
        $encodedRequest = base64_encode(gzdeflate($samlRequest));

        return $providerConfig['sso_url'] . '?' . http_build_query([
            'SAMLRequest' => $encodedRequest,
            'RelayState' => $requestId,
        ]);
    }

    /**
     * Genera l'URL di logout SPID
     */
    public function getLogoutUrl(string $provider, string $nameId, string $sessionIndex): string
    {
        if (!isset($this->providers[$provider])) {
            throw new \InvalidArgumentException("Provider SPID '{$provider}' non supportato");
        }

        $providerConfig = $this->providers[$provider];
        $requestId = $this->generateRequestId();
        
        Session::put('spid.logout_request_id', $requestId);

        $samlLogoutRequest = $this->buildSamlLogoutRequest($requestId, $nameId, $sessionIndex, $providerConfig);
        $encodedRequest = base64_encode(gzdeflate($samlLogoutRequest));

        return $providerConfig['slo_url'] . '?' . http_build_query([
            'SAMLRequest' => $encodedRequest,
            'RelayState' => $requestId,
        ]);
    }

    /**
     * Processa la response SAML dal provider SPID
     */
    public function processCallback(Request $request): array
    {
        $samlResponse = $request->input('SAMLResponse');
        $relayState = $request->input('RelayState');

        if (!$samlResponse) {
            throw new \Exception('SAMLResponse mancante');
        }

        if (!$relayState || $relayState !== Session::get('spid.request_id')) {
            throw new \Exception('RelayState non valido');
        }

        $decodedResponse = base64_decode($samlResponse);
        $responseDoc = new \DOMDocument();
        $responseDoc->loadXML($decodedResponse);

        // Valida la signature
        $this->validateSamlResponse($responseDoc);

        // Estrai gli attributi utente
        $attributes = $this->extractUserAttributes($responseDoc);

        // Log dell'autenticazione riuscita
        Log::info('SPID authentication successful', [
            'provider' => Session::get('spid.provider'),
            'user_attributes' => $attributes,
        ]);

        return $attributes;
    }

    /**
     * Genera il metadata SAML per il Service Provider
     */
    public function getMetadata(): string
    {
        $metadata = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $metadata .= '<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata"' . PHP_EOL;
        $metadata .= '                     entityID="' . htmlspecialchars($this->entityId) . '">' . PHP_EOL;
        
        $metadata .= '  <md:SPSSODescriptor AuthnRequestsSigned="true"' . PHP_EOL;
        $metadata .= '                      WantAssertionsSigned="true"' . PHP_EOL;
        $metadata .= '                      protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">' . PHP_EOL;
        
        // KeyDescriptor per signing
        $metadata .= '    <md:KeyDescriptor use="signing">' . PHP_EOL;
        $metadata .= '      <ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">' . PHP_EOL;
        $metadata .= '        <ds:X509Data>' . PHP_EOL;
        $metadata .= '          <ds:X509Certificate>' . $this->getSigningCertificate() . '</ds:X509Certificate>' . PHP_EOL;
        $metadata .= '        </ds:X509Data>' . PHP_EOL;
        $metadata .= '      </ds:KeyInfo>' . PHP_EOL;
        $metadata .= '    </md:KeyDescriptor>' . PHP_EOL;

        // Assertion Consumer Service
        $metadata .= '    <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"' . PHP_EOL;
        $metadata .= '                                 Location="' . htmlspecialchars($this->assertionConsumerServiceUrl) . '"' . PHP_EOL;
        $metadata .= '                                 index="0" isDefault="true"/>' . PHP_EOL;

        // Single Logout Service
        $metadata .= '    <md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"' . PHP_EOL;
        $metadata .= '                           Location="' . htmlspecialchars($this->singleLogoutServiceUrl) . '"/>' . PHP_EOL;

        // Attribute consuming service con gli attributi SPID
        $metadata .= '    <md:AttributeConsumingService index="0">' . PHP_EOL;
        $metadata .= '      <md:ServiceName xml:lang="it">' . config('app.name') . '</md:ServiceName>' . PHP_EOL;
        
        $spidAttributes = [
            'spidCode', 'name', 'familyName', 'placeOfBirth', 'countyOfBirth',
            'dateOfBirth', 'gender', 'companyName', 'registeredOffice',
            'fiscalNumber', 'ivaCode', 'idCard', 'mobilePhone', 'email',
            'address', 'digitalAddress'
        ];

        foreach ($spidAttributes as $attr) {
            $metadata .= '      <md:RequestedAttribute Name="' . $attr . '" NameFormat="urn:oasis:names:tc:SAML:2.0:attrname-format:basic"/>' . PHP_EOL;
        }
        
        $metadata .= '    </md:AttributeConsumingService>' . PHP_EOL;
        $metadata .= '  </md:SPSSODescriptor>' . PHP_EOL;
        $metadata .= '</md:EntityDescriptor>' . PHP_EOL;

        return $metadata;
    }

    /**
     * Genera un ID univoco per le richieste SAML
     */
    protected function generateRequestId(): string
    {
        return 'req_' . bin2hex(random_bytes(16));
    }

    /**
     * Costruisce una richiesta di autenticazione SAML
     */
    protected function buildSamlAuthRequest(string $requestId, array $provider, int $level): string
    {
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
        
        $request = '<samlp:AuthnRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"' . PHP_EOL;
        $request .= '                   xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"' . PHP_EOL;
        $request .= '                   ID="' . $requestId . '"' . PHP_EOL;
        $request .= '                   Version="2.0"' . PHP_EOL;
        $request .= '                   IssueInstant="' . $issueInstant . '"' . PHP_EOL;
        $request .= '                   Destination="' . $provider['sso_url'] . '"' . PHP_EOL;
        $request .= '                   AssertionConsumerServiceURL="' . $this->assertionConsumerServiceUrl . '"' . PHP_EOL;
        $request .= '                   AttributeConsumingServiceIndex="0">' . PHP_EOL;
        
        $request .= '  <saml:Issuer>' . htmlspecialchars($this->entityId) . '</saml:Issuer>' . PHP_EOL;
        
        $request .= '  <samlp:RequestedAuthnContext Comparison="minimum">' . PHP_EOL;
        $request .= '    <saml:AuthnContextClassRef>https://www.spid.gov.it/SpidL' . $level . '</saml:AuthnContextClassRef>' . PHP_EOL;
        $request .= '  </samlp:RequestedAuthnContext>' . PHP_EOL;
        
        $request .= '</samlp:AuthnRequest>';

        return $request;
    }

    /**
     * Costruisce una richiesta di logout SAML
     */
    protected function buildSamlLogoutRequest(string $requestId, string $nameId, string $sessionIndex, array $provider): string
    {
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
        
        $request = '<samlp:LogoutRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"' . PHP_EOL;
        $request .= '                    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"' . PHP_EOL;
        $request .= '                    ID="' . $requestId . '"' . PHP_EOL;
        $request .= '                    Version="2.0"' . PHP_EOL;
        $request .= '                    IssueInstant="' . $issueInstant . '"' . PHP_EOL;
        $request .= '                    Destination="' . $provider['slo_url'] . '">' . PHP_EOL;
        
        $request .= '  <saml:Issuer>' . htmlspecialchars($this->entityId) . '</saml:Issuer>' . PHP_EOL;
        $request .= '  <saml:NameID Format="urn:oasis:names:tc:SAML:2.0:nameid-format:transient">' . htmlspecialchars($nameId) . '</saml:NameID>' . PHP_EOL;
        $request .= '  <samlp:SessionIndex>' . htmlspecialchars($sessionIndex) . '</samlp:SessionIndex>' . PHP_EOL;
        
        $request .= '</samlp:LogoutRequest>';

        return $request;
    }

    /**
     * Valida la response SAML
     */
    protected function validateSamlResponse(\DOMDocument $responseDoc): void
    {
        // Implementazione della validazione signature
        // In produzione usare librerie come xmlseclibs per validazione completa
        
        $xpath = new \DOMXPath($responseDoc);
        $xpath->registerNamespace('samlp', 'urn:oasis:names:tc:SAML:2.0:protocol');
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');

        // Verifica che la response sia successful
        $statusCode = $xpath->query('//samlp:StatusCode/@Value');
        if ($statusCode->length === 0 || $statusCode->item(0)->nodeValue !== 'urn:oasis:names:tc:SAML:2.0:status:Success') {
            throw new \Exception('SPID authentication failed');
        }
    }

    /**
     * Estrae gli attributi utente dalla response SAML
     */
    protected function extractUserAttributes(\DOMDocument $responseDoc): array
    {
        $xpath = new \DOMXPath($responseDoc);
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');

        $attributes = [];

        // Estrai tutti gli attributi
        $attributeNodes = $xpath->query('//saml:Attribute');
        foreach ($attributeNodes as $attributeNode) {
            $name = $attributeNode->getAttribute('Name');
            $valueNodes = $xpath->query('saml:AttributeValue', $attributeNode);
            
            if ($valueNodes->length > 0) {
                $attributes[$name] = $valueNodes->item(0)->nodeValue;
            }
        }

        // Mappa gli attributi SPID ai nomi più user-friendly
        return [
            'spid_code' => $attributes['spidCode'] ?? null,
            'name' => $attributes['name'] ?? null,
            'surname' => $attributes['familyName'] ?? null,
            'fiscal_code' => $attributes['fiscalNumber'] ?? null,
            'email' => $attributes['email'] ?? null,
            'mobile' => $attributes['mobilePhone'] ?? null,
            'birth_date' => $attributes['dateOfBirth'] ?? null,
            'birth_place' => $attributes['placeOfBirth'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'address' => $attributes['address'] ?? null,
            'digital_address' => $attributes['digitalAddress'] ?? null,
            'company_name' => $attributes['companyName'] ?? null,
            'vat_number' => $attributes['ivaCode'] ?? null,
            'provider' => Session::get('spid.provider'),
            'auth_level' => Session::get('spid.auth_level', 2),
        ];
    }

    /**
     * Ottiene il certificato per il signing (placeholder)
     */
    protected function getSigningCertificate(): string
    {
        // In produzione, caricare il certificato dal filesystem
        return config('spid.signing_cert', '');
    }

    /**
     * Verifica se l'utente è autenticato con SPID
     */
    public function isAuthenticated(): bool
    {
        return Session::has('spid.authenticated') && Session::get('spid.authenticated') === true;
    }

    /**
     * Ottiene i dati dell'utente autenticato
     */
    public function getAuthenticatedUser(): ?array
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return Session::get('spid.user_data');
    }

    /**
     * Effettua il logout dell'utente SPID
     */
    public function logout(): void
    {
        Session::forget([
            'spid.authenticated',
            'spid.user_data',
            'spid.provider',
            'spid.request_id',
            'spid.auth_level',
        ]);
    }
}