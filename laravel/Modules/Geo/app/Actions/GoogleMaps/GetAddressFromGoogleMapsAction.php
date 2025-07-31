<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\AddressData;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Geo\Datas\GoogleMaps\GoogleMapAddressComponentData;
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
use Modules\Geo\Datas\GoogleMaps\GoogleMapAddressComponentData;
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
use Modules\Geo\Datas\GoogleMaps\GoogleMapAddressComponentData;
>>>>>>> 6f0eea5 (.)
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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0e7ec50 (.)
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

<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if (empty($apiKey) || !is_string($apiKey)) {
=======
        if (empty($apiKey)) {
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        if (empty($apiKey)) {
=======
        if (empty($apiKey) || !is_string($apiKey)) {
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        if (empty($apiKey) || !is_string($apiKey)) {
>>>>>>> 6f0eea5 (.)
            throw GoogleMapsApiException::missingApiKey();
        }

        return $apiKey;
    }

    private function makeApiRequest(string $address, string $apiKey): Response
    {
        $response = Http::get(self::BASE_URL, [
            'address' => $address,
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            throw GoogleMapsApiException::requestFailed((string) $response->status());
        }

        return $response;
    }

    private function validateResponse(Response $response): GoogleMapResponseData
    {
        /** @var GoogleMapResponseData $responseData */
        $responseData = GoogleMapResponseData::from($response->json());

        if (0 === $responseData->results->count()) {
            throw GoogleMapsApiException::noResultsFound();
        }

        return $responseData;
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * @throws GoogleMapsApiException
     */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
    /**
     * @throws GoogleMapsApiException
     */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
    /**
     * @throws GoogleMapsApiException
     */
>>>>>>> 6f0eea5 (.)
    private function getFirstResult(GoogleMapResponseData $responseData): GoogleMapResultData
    {
        $firstResult = $responseData->results->first();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if (!$firstResult instanceof GoogleMapResultData) {
            throw GoogleMapsApiException::noResultsFound();
=======
        if (null === $firstResult->geometry?->location) {
            throw GoogleMapsApiException::invalidLocationData();
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        if (null === $firstResult->geometry?->location) {
            throw GoogleMapsApiException::invalidLocationData();
=======
        if (!$firstResult instanceof GoogleMapResultData) {
            throw GoogleMapsApiException::noResultsFound();
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        if (!$firstResult instanceof GoogleMapResultData) {
            throw GoogleMapsApiException::noResultsFound();
>>>>>>> 6f0eea5 (.)
        }

        return $firstResult;
    }

    private function mapResponseToAddressData(GoogleMapResultData $result): AddressData
    {
        return AddressData::from([
            'latitude' => $result->geometry->location->lat,
            'longitude' => $result->geometry->location->lng,
            'country' => $this->getComponent($result->address_components, ['country']),
            'city' => $this->getComponent($result->address_components, ['administrative_area_level_3']),
            'country_code' => $this->getComponent($result->address_components, ['country'], true),
            'postal_code' => (int) $this->getComponent($result->address_components, ['postal_code']),
            'locality' => $this->getComponent($result->address_components, ['locality']) ?? '',
            'county' => $this->getComponent($result->address_components, ['administrative_area_level_2']),
            'street' => $this->getComponent($result->address_components, ['route']) ?? '',
            'street_number' => $this->getComponent($result->address_components, ['street_number']) ?? '',
            'district' => $this->getComponent($result->address_components, ['sublocality_level_1']) ?? '',
            'state' => $this->getComponent($result->address_components, ['administrative_area_level_1']),
        ]);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @param DataCollection<GoogleMapAddressComponentData> $components
     * @param array<string> $types
     */
    private function getComponent(DataCollection $components, array $types, bool $short = false): ?string
    {
        /** @var GoogleMapAddressComponentData|null $component */
        $component = $components->toCollection()->first(function ($component) use ($types) {
            if (!$component instanceof GoogleMapAddressComponentData) {
                return false;
            }
            
            return !empty($component->types) && count(array_intersect($component->types, $types)) > 0;
        });

        if (!$component instanceof GoogleMapAddressComponentData) {
            return null;
        }

        // Le proprietà short_name e long_name sono sempre string nei Data Objects
        return $short ? $component->short_name : $component->long_name;
=======
=======
>>>>>>> 0e7ec50 (.)
     * Ottiene un componente dell'indirizzo dal risultato di Google Maps.
     *
     * @param DataCollection $components Componenti dell'indirizzo
     * @param array<string>  $types      Tipi di componente da cercare
     * @param bool           $short      Se true, restituisce il nome breve invece di quello lungo
     */
    private function getComponent(DataCollection $components, array $types, bool $short = false): ?string
    {
        $component = $components->toCollection()->first(function ($component) use ($types) {
            return ! empty($component->types)
                && count(array_intersect($component->types, $types)) > 0;
        });

        return $component?->{$short ? 'short_name' : 'long_name'};
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
     * @param DataCollection<GoogleMapAddressComponentData> $components
     * @param array<string> $types
     */
    private function getComponent(DataCollection $components, array $types, bool $short = false): ?string
    {
        /** @var GoogleMapAddressComponentData|null $component */
        $component = $components->toCollection()->first(function ($component) use ($types) {
            if (!$component instanceof GoogleMapAddressComponentData) {
                return false;
            }
            
            return !empty($component->types) && count(array_intersect($component->types, $types)) > 0;
        });

        if (!$component instanceof GoogleMapAddressComponentData) {
            return null;
        }

        // Le proprietà short_name e long_name sono sempre string nei Data Objects
        return $short ? $component->short_name : $component->long_name;
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
    }
}
