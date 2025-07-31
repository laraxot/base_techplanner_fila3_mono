<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Mapbox;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Modules\Geo\Datas\AddressData;

use function Safe\json_decode;
use function Safe\preg_match;

use Webmozart\Assert\Assert;

/**
 * Action per ottenere l'indirizzo e le coordinate tramite Mapbox.
 *
 * Questa classe utilizza l'API Mapbox Geocoding per convertire
 * un indirizzo in coordinate geografiche e dettagli dell'indirizzo.
 */
class GetAddressFromMapboxAction
{
    private const API_URL = 'https://api.mapbox.com/geocoding/v5/mapbox.places';

    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Ottiene i dettagli dell'indirizzo utilizzando Mapbox.
     *
     * @throws \RuntimeException Se la chiave API non è configurata o la richiesta fallisce
     */
    public function execute(string $address): ?AddressData
    {
        $this->validateInput($address);

        try {
            $response = $this->makeApiRequest($address);

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            Log::error('Mapbox Geocoding API request failed', [
                'error' => $e->getMessage(),
                'address' => $address,
            ]);

            return null;
        }
    }

    /**
     * Valida i dati di input.
     *
     * @throws \RuntimeException Se la chiave API non è configurata
     */
    private function validateInput(string $address): void
    {
        $apiKey = config('services.mapbox.access_token');
        Assert::notEmpty($apiKey, 'Mapbox access token not configured');
        Assert::notEmpty($address, 'Address cannot be empty');
        Assert::maxLength($address, 1000, 'Address is too long');
    }

    /**
     * Effettua la richiesta all'API di Mapbox.
     *
     * @throws GuzzleException Se la richiesta fallisce
     */
    private function makeApiRequest(string $address): string
    {
        $encodedAddress = urlencode($address);
        $url = sprintf('%s/%s.json', self::API_URL, $encodedAddress);

        $response = $this->client->get($url, [
            'query' => [
                'access_token' => config('services.mapbox.access_token'),
                'limit' => 1,
                'types' => 'address',
                'country' => 'IT',
                'language' => 'it',
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Parsa la risposta dell'API e restituisce i dati dell'indirizzo.
     */
    private function parseResponse(string $response): ?AddressData
    {
        /** @var array<string, mixed> $data */
        $data = json_decode($response, true);

        if (!isset($data['features']) || empty($data['features'])) {
            return null;
        }

        $feature = $data['features'][0];
        $coordinates = $feature['center'] ?? [];
        $context = $feature['context'] ?? [];
        $properties = $feature['properties'] ?? [];

        if (empty($coordinates) || count($coordinates) < 2) {
            return null;
        }

        return new AddressData(
            latitude: (float) $coordinates[1],
            longitude: (float) $coordinates[0],
            country: $this->extractContextValue($context, 'country'),
            city: $this->extractContextValue($context, 'place'),
            country_code: strtoupper($this->extractContextValue($context, 'country') ?? 'IT'),
            postal_code: (int) ($this->extractContextValue($context, 'postcode') ?? 0),
            locality: $this->extractContextValue($context, 'locality'),
            county: $this->extractContextValue($context, 'region'),
            street: $properties['address'] ?? null,
            street_number: $properties['housenumber'] ?? null,
            district: $this->extractContextValue($context, 'neighborhood'),
            state: $this->extractContextValue($context, 'region'),
        );
    }

    /**
     * Estrae un valore dal contesto dell'indirizzo.
     */
    private function extractContextValue(array $context, string $type): ?string
    {
        foreach ($context as $item) {
            if (isset($item['id']) && str_starts_with($item['id'], $type)) {
                return $item['text'] ?? null;
            }
        }

        return null;
    }
}
