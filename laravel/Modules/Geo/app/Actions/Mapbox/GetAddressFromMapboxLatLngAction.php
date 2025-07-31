<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Mapbox;

use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\AddressData;
use Modules\Geo\Datas\MapboxMapData;
use Modules\Geo\Exceptions\InvalidLocationException;

/**
 * Classe per ottenere i dati dell'indirizzo dal servizio Mapbox.
 */
class GetAddressFromMapboxLatLngAction
{
    private const BASE_URL = 'https://api.mapbox.com/geocoding/v5/mapbox.places';

    /**
     * Ottiene l'indirizzo da coordinate geografiche.
     *
     * @throws InvalidLocationException Se la richiesta fallisce o i dati non sono validi
     */
    public function execute(float $latitude, float $longitude): AddressData
    {
        $this->validateCoordinates($latitude, $longitude);
        $apiKey = $this->getApiKey();
        $response = $this->makeApiRequest($latitude, $longitude, $apiKey);
        $data = $this->parseResponse($response);

        return $this->mapResponseToAddressData($data);
    }

    private function validateCoordinates(float $latitude, float $longitude): void
    {
        if ($latitude < -90 || $latitude > 90) {
            throw InvalidLocationException::invalidData('Latitudine non valida: deve essere compresa tra -90 e 90');
        }

        if ($longitude < -180 || $longitude > 180) {
            throw InvalidLocationException::invalidData('Longitudine non valida: deve essere compresa tra -180 e 180');
        }
    }

    private function getApiKey(): string
    {
        $apiKey = config('services.mapbox.api_key');

        if (empty($apiKey) || !is_string($apiKey)) {
            throw InvalidLocationException::invalidData('API key di Mapbox non configurata');
        }

        return $apiKey;
    }

    private function makeApiRequest(float $latitude, float $longitude, string $apiKey): array
    {
        $response = Http::get(self::BASE_URL."/{$longitude},{$latitude}.json", [
            'access_token' => $apiKey,
            'types' => 'address',
            'limit' => 1,
            'language' => 'it',
        ]);

        if (!$response->successful()) {
            throw InvalidLocationException::invalidData('Richiesta a Mapbox fallita');
        }

        $data = $response->json();
        
        if (!is_array($data)) {
            throw InvalidLocationException::invalidData('Risposta di Mapbox non valida');
        }

        return $data;
    }

    private function parseResponse(array $response): MapboxMapData
    {
        if (!isset($response['features']) || empty($response['features'])) {
            throw InvalidLocationException::invalidData('Nessun risultato trovato per le coordinate fornite');
        }

        $feature = $response['features'][0];
        
        return MapboxMapData::from($feature);
    }

    private function mapResponseToAddressData(MapboxMapData $data): AddressData
    {
        return new AddressData(
            latitude: $data->latitude ?? 0.0,
            longitude: $data->longitude ?? 0.0,
            country: $data->country ?? null,
            city: $data->city ?? null,
            country_code: strtoupper($data->countryCode ?? 'IT'),
            postal_code: (int) ($data->postalCode ?? 0),
            locality: $data->locality ?? null,
            county: $data->county ?? null,
            street: $data->street ?? null,
            street_number: $data->streetNumber ?? null,
            district: $data->district ?? null,
            state: $data->state ?? null,
        );
    }
}
