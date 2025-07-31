<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Bing;

use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\AddressData;
use Modules\Geo\Datas\BingMapData;
use Modules\Geo\Exceptions\InvalidLocationException;

/**
 * Classe per ottenere l'indirizzo da Bing Maps.
 */
class GetAddressFromBingMapsAction
{
    private const BASE_URL = 'http://dev.virtualearth.net/REST/v1/Locations';

    /**
     * Ottiene l'indirizzo da coordinate geografiche.
     *
     * @throws InvalidLocationException Se la richiesta fallisce o i dati non sono validi
     */
    public function execute(float $latitude, float $longitude): AddressData
    {
        $apiKey = $this->getApiKey();
        $response = $this->makeApiRequest($latitude, $longitude, $apiKey);
        $data = $this->parseResponse($response);

        return $this->mapResponseToAddressData($data);
    }

    /**
     * Get the Bing Maps API key from configuration.
     *
     * @return non-empty-string
     * @throws InvalidLocationException
     */
    private function getApiKey(): string
    {
        /** @var string|null $apiKey */
        $apiKey = config('services.bing.maps_api_key');

        if (empty($apiKey)) {
            throw InvalidLocationException::invalidData('API key di Bing Maps non configurata');
        }

        // We've already checked that $apiKey is not empty
        /** @var non-empty-string $apiKey */
        return $apiKey;
    }

    /**
     * Make an API request to Bing Maps.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $apiKey
     * @return array
     * @throws InvalidLocationException
     */
    private function makeApiRequest(float $latitude, float $longitude, string $apiKey): array
    {
        $response = Http::get(self::BASE_URL, [
            'q' => "{$latitude},{$longitude}",
            'key' => $apiKey,
            'o' => 'json',
        ]);

        if (!$response->successful()) {
            throw InvalidLocationException::invalidData('Richiesta API Bing Maps fallita');
        }

        /** @var array $data */
        $data = $response->json();

        if (empty($data) || !isset($data['resourceSets'])) {
            throw InvalidLocationException::invalidData('Risposta API Bing Maps non valida');
        }

        return $data;
    }

    /**
     * Parse the API response.
     *
     * @param array $response
     * @return BingMapData
     * @throws InvalidLocationException
     */
    private function parseResponse(array $response): BingMapData
    {
        $resourceSets = $response['resourceSets'] ?? [];
        
        if (empty($resourceSets)) {
            throw InvalidLocationException::invalidData('Nessun risultato trovato per le coordinate fornite');
        }

        $resources = $resourceSets[0]['resources'] ?? [];
        
        if (empty($resources)) {
            throw InvalidLocationException::invalidData('Nessuna risorsa trovata per le coordinate fornite');
        }

        return BingMapData::from($resources[0]);
    }

    /**
     * Map the Bing Maps response to AddressData.
     *
     * @param BingMapData $data
     * @return AddressData
     */
    private function mapResponseToAddressData(BingMapData $data): AddressData
    {
        return new AddressData(
            latitude: $data->latitude ?? 0.0,
            longitude: $data->longitude ?? 0.0,
            country: $data->countryRegion ?? null,
            city: $data->locality ?? null,
            country_code: strtoupper($data->countryRegionIso2 ?? 'IT'),
            postal_code: (int) ($data->postalCode ?? 0),
            locality: $data->locality ?? null,
            county: $data->adminDistrict2 ?? null,
            street: $data->addressLine ?? null,
            street_number: $data->houseNumber ?? null,
            district: $data->neighborhood ?? null,
            state: $data->adminDistrict ?? null,
        );
    }
}
