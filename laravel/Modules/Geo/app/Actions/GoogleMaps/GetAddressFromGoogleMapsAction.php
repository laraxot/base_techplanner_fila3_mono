<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\AddressData;
use Modules\Geo\Datas\GoogleMaps\GoogleMapAddressComponentData;
use Modules\Geo\Datas\GoogleMaps\GoogleMapResponseData;
use Modules\Geo\Datas\GoogleMaps\GoogleMapResultData;
use Modules\Geo\Exceptions\GoogleMaps\GoogleMapsApiException;
use Spatie\LaravelData\DataCollection;

/**
 * Gestisce le richieste e l'elaborazione delle risposte dell'API di geocodifica di Google Maps.
 */
final class GetAddressFromGoogleMapsAction
{
    private const BASE_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    private const REQUIRED_ADDRESS_COMPONENTS = [
        'country',
        'administrative_area_level_3',
        'postal_code',
        'locality',
        'administrative_area_level_2',
        'route',
        'street_number',
        'sublocality_level_1',
        'administrative_area_level_1',
    ];

    /**
     * @throws GoogleMapsApiException Se la richiesta fallisce o i dati non sono validi
     */
    public function execute(string $address): AddressData
    {
        $apiKey = $this->getApiKey();
        $response = $this->makeApiRequest($address, $apiKey);

        $responseData = $this->validateResponse($response);
        $firstResult = $this->getFirstResult($responseData);

        return $this->mapResponseToAddressData($firstResult);
    }

    private function getApiKey(): string
    {
        $apiKey = config('services.google.maps_api_key');

        if (empty($apiKey) || !is_string($apiKey)) {
            throw GoogleMapsApiException::missingApiKey();
        }

        return $apiKey;
    }

    private function makeApiRequest(string $address, string $apiKey): Response
    {
        return Http::get(self::BASE_URL, [
            'address' => $address,
            'key' => $apiKey,
            'language' => 'it',
            'region' => 'it',
        ]);
    }

    private function validateResponse(Response $response): GoogleMapResponseData
    {
        if (!$response->successful()) {
            throw GoogleMapsApiException::requestFailed('Richiesta API Google Maps fallita');
        }

        $data = $response->json();

        if (!is_array($data) || !isset($data['status'])) {
            throw GoogleMapsApiException::requestFailed('Risposta API Google Maps non valida');
        }

        if ($data['status'] !== 'OK') {
            throw GoogleMapsApiException::requestFailed('Stato API non valido: ' . $data['status']);
        }

        return GoogleMapResponseData::from($data);
    }

    private function getFirstResult(GoogleMapResponseData $responseData): GoogleMapResultData
    {
        $results = $responseData->results;

        if ($results->isEmpty()) {
            throw GoogleMapsApiException::noResultsFound();
        }

        return $results->first();
    }

    private function mapResponseToAddressData(GoogleMapResultData $result): AddressData
    {
        $components = $result->address_components;
        $geometry = $result->geometry;

        return new AddressData(
            latitude: $geometry->location->lat,
            longitude: $geometry->location->lng,
            country: $this->getComponent($components, ['country']),
            city: $this->getComponent($components, ['locality', 'administrative_area_level_3']),
            country_code: strtoupper($this->getComponent($components, ['country'], true) ?? 'IT'),
            postal_code: (int) ($this->getComponent($components, ['postal_code']) ?? 0),
            locality: $this->getComponent($components, ['locality']),
            county: $this->getComponent($components, ['administrative_area_level_2']),
            street: $this->getComponent($components, ['route']),
            street_number: $this->getComponent($components, ['street_number']),
            district: $this->getComponent($components, ['sublocality_level_1']),
            state: $this->getComponent($components, ['administrative_area_level_1']),
        );
    }

    private function getComponent(DataCollection $components, array $types, bool $short = false): ?string
    {
        foreach ($components as $component) {
            if (in_array($component->types->first(), $types, true)) {
                return $short ? $component->shortName : $component->longName;
            }
        }

        return null;
    }
}
