<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

use Illuminate\Support\Facades\{Config, Log, Session, Http};
use Illuminate\Http\{Request, RedirectResponse};

/**
 * Servizio per l'autenticazione CIE (Carta di Identità Elettronica)
 * 
 * Implementa l'integrazione con CIE 3.0 per l'autenticazione
 * secondo le specifiche AGID per l'identità digitale nella PA
 */
class CieAuthService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected string $redirectUri;

    public function __construct()
    {
        $this->baseUrl = config('cie.base_url', 'https://preprod.idserver.servizicie.interno.gov.it/idp');
        $this->clientId = config('cie.client_id');
        $this->clientSecret = config('cie.client_secret');
        $this->redirectUri = route('cie.callback');
    }

    /**
     * Genera l'URL di login CIE
     */
    public function getLoginUrl(?string $returnUrl = null): string
    {
        $state = $this->generateState();
        $nonce = $this->generateNonce();
        
        // Salva lo stato in sessione
        Session::put('cie.state', $state);
        Session::put('cie.nonce', $nonce);
        Session::put('cie.return_url', $returnUrl ?: url()->previous());

        $params = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'redirect_uri' => $this->redirectUri,
            'state' => $state,
            'nonce' => $nonce,
            'prompt' => 'login',
            'acr_values' => 'https://www.spid.gov.it/SpidL2', // Livello 2 CIE
        ];

        return $this->baseUrl . '/oidc/authorize?' . http_build_query($params);
    }

    /**
     * Genera l'URL per l'autenticazione tramite app CieID
     */
    public function getMobileLoginUrl(?string $returnUrl = null): string
    {
        $state = $this->generateState();
        $nonce = $this->generateNonce();
        
        Session::put('cie.state', $state);
        Session::put('cie.nonce', $nonce);
        Session::put('cie.return_url', $returnUrl ?: url()->previous());
        Session::put('cie.auth_method', 'mobile');

        // URL per deep linking all'app CieID
        $webLoginUrl = $this->getLoginUrl($returnUrl);
        
        // Genera l'URL per mobile con schema custom
        $mobileUrl = 'cieid://login?' . http_build_query([
            'redirect_url' => $webLoginUrl,
            'client_name' => config('app.name'),
        ]);

        return $mobileUrl;
    }

    /**
     * Processa la callback OAuth2 da CIE
     */
    public function processCallback(Request $request): array
    {
        $code = $request->input('code');
        $state = $request->input('state');
        $error = $request->input('error');

        // Verifica errori
        if ($error) {
            throw new \Exception('CIE authentication error: ' . $error);
        }

        // Verifica lo state
        if (!$state || $state !== Session::get('cie.state')) {
            throw new \Exception('State parameter mismatch');
        }

        if (!$code) {
            throw new \Exception('Authorization code missing');
        }

        // Scambia il code per un access token
        $tokenData = $this->exchangeCodeForToken($code);
        
        // Ottieni i dati utente usando l'access token
        $userData = $this->getUserInfo($tokenData['access_token']);
        
        // Valida il JWT ID token
        $idTokenClaims = $this->validateIdToken($tokenData['id_token']);
        
        // Unisci i dati
        $userAttributes = array_merge($userData, $idTokenClaims);

        Log::info('CIE authentication successful', [
            'user_attributes' => $userAttributes,
            'auth_method' => Session::get('cie.auth_method', 'web'),
        ]);

        return $this->mapCieAttributes($userAttributes);
    }

    /**
     * Scambia l'authorization code per un access token
     */
    protected function exchangeCodeForToken(string $code): array
    {
        $response = Http::asForm()->post($this->baseUrl . '/oidc/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirectUri,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if (!$response->successful()) {
            throw new \Exception('Token exchange failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Ottiene le informazioni utente usando l'access token
     */
    protected function getUserInfo(string $accessToken): array
    {
        $response = Http::withToken($accessToken)
            ->get($this->baseUrl . '/oidc/userinfo');

        if (!$response->successful()) {
            throw new \Exception('UserInfo request failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Valida e decodifica l'ID token JWT
     */
    protected function validateIdToken(string $idToken): array
    {
        // Decodifica il JWT (in produzione usare librerie come firebase/jwt)
        $parts = explode('.', $idToken);
        
        if (count($parts) !== 3) {
            throw new \Exception('Invalid JWT format');
        }

        // Decodifica header e payload
        $header = json_decode(base64_decode($parts[0]), true);
        $payload = json_decode(base64_decode($parts[1]), true);

        // Verifica il nonce
        if (!isset($payload['nonce']) || $payload['nonce'] !== Session::get('cie.nonce')) {
            throw new \Exception('Nonce verification failed');
        }

        // Verifica l'audience
        if (!isset($payload['aud']) || $payload['aud'] !== $this->clientId) {
            throw new \Exception('Audience verification failed');
        }

        // Verifica l'issuer
        if (!isset($payload['iss']) || $payload['iss'] !== $this->baseUrl) {
            throw new \Exception('Issuer verification failed');
        }

        // Verifica la scadenza
        if (!isset($payload['exp']) || $payload['exp'] < time()) {
            throw new \Exception('Token expired');
        }

        return $payload;
    }

    /**
     * Mappa gli attributi CIE ai nomi standard
     */
    protected function mapCieAttributes(array $attributes): array
    {
        return [
            'cie_id' => $attributes['sub'] ?? null,
            'name' => $attributes['given_name'] ?? $attributes['name'] ?? null,
            'surname' => $attributes['family_name'] ?? null,
            'fiscal_code' => $attributes['fiscal_number'] ?? $attributes['fiscalNumber'] ?? null,
            'email' => $attributes['email'] ?? null,
            'email_verified' => $attributes['email_verified'] ?? false,
            'birth_date' => $attributes['birthdate'] ?? $attributes['dateOfBirth'] ?? null,
            'birth_place' => $attributes['place_of_birth'] ?? $attributes['placeOfBirth'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'address' => $this->formatAddress($attributes),
            'phone' => $attributes['phone_number'] ?? null,
            'phone_verified' => $attributes['phone_number_verified'] ?? false,
            'auth_method' => Session::get('cie.auth_method', 'web'),
            'provider' => 'cie',
            'auth_level' => 2, // CIE è sempre livello 2
            'auth_time' => $attributes['auth_time'] ?? time(),
        ];
    }

    /**
     * Formatta l'indirizzo dall'array di attributi CIE
     */
    protected function formatAddress(array $attributes): ?string
    {
        $addressParts = [];
        
        if (isset($attributes['address']['street_address'])) {
            $addressParts[] = $attributes['address']['street_address'];
        }
        
        if (isset($attributes['address']['locality'])) {
            $addressParts[] = $attributes['address']['locality'];
        }
        
        if (isset($attributes['address']['postal_code'])) {
            $addressParts[] = $attributes['address']['postal_code'];
        }
        
        if (isset($attributes['address']['country'])) {
            $addressParts[] = $attributes['address']['country'];
        }

        return !empty($addressParts) ? implode(', ', $addressParts) : null;
    }

    /**
     * Genera un state sicuro per OAuth2
     */
    protected function generateState(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Genera un nonce per OIDC
     */
    protected function generateNonce(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Verifica se l'utente è autenticato con CIE
     */
    public function isAuthenticated(): bool
    {
        return Session::has('cie.authenticated') && Session::get('cie.authenticated') === true;
    }

    /**
     * Ottiene i dati dell'utente autenticato
     */
    public function getAuthenticatedUser(): ?array
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return Session::get('cie.user_data');
    }

    /**
     * Effettua il logout dell'utente CIE
     */
    public function logout(): void
    {
        $refreshToken = Session::get('cie.refresh_token');
        
        // Revoca i token se disponibili
        if ($refreshToken) {
            try {
                Http::asForm()->post($this->baseUrl . '/oidc/revoke', [
                    'token' => $refreshToken,
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]);
            } catch (\Exception $e) {
                Log::warning('CIE token revocation failed', ['error' => $e->getMessage()]);
            }
        }

        Session::forget([
            'cie.authenticated',
            'cie.user_data',
            'cie.access_token',
            'cie.refresh_token',
            'cie.state',
            'cie.nonce',
            'cie.auth_method',
        ]);
    }

    /**
     * Ottiene l'URL di logout CIE (post-logout redirect)
     */
    public function getLogoutUrl(?string $returnUrl = null): string
    {
        $params = [
            'post_logout_redirect_uri' => $returnUrl ?: route('home'),
            'client_id' => $this->clientId,
        ];

        return $this->baseUrl . '/oidc/logout?' . http_build_query($params);
    }

    /**
     * Aggiorna l'access token usando il refresh token
     */
    public function refreshToken(): ?array
    {
        $refreshToken = Session::get('cie.refresh_token');
        
        if (!$refreshToken) {
            return null;
        }

        try {
            $response = Http::asForm()->post($this->baseUrl . '/oidc/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            if ($response->successful()) {
                $tokenData = $response->json();
                
                // Aggiorna i token in sessione
                Session::put('cie.access_token', $tokenData['access_token']);
                if (isset($tokenData['refresh_token'])) {
                    Session::put('cie.refresh_token', $tokenData['refresh_token']);
                }

                return $tokenData;
            }
        } catch (\Exception $e) {
            Log::warning('CIE token refresh failed', ['error' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * Verifica se CIE è configurato correttamente
     */
    public function isConfigured(): bool
    {
        return !empty($this->clientId) && 
               !empty($this->clientSecret) && 
               !empty($this->baseUrl);
    }

    /**
     * Ottiene le informazioni di configurazione CIE per il debug
     */
    public function getConfigInfo(): array
    {
        return [
            'base_url' => $this->baseUrl,
            'client_id' => $this->clientId ? 'configured' : 'missing',
            'client_secret' => $this->clientSecret ? 'configured' : 'missing',
            'redirect_uri' => $this->redirectUri,
            'is_configured' => $this->isConfigured(),
        ];
    }
}