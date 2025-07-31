<?php

declare(strict_types=1);

namespace Modules\Geo\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Service per l'integrazione con Google Maps API.
 */
class GoogleMapsService extends BaseGeoService
{
    /**
     * Base URL per le API di Google Maps.
     */
    protected string $baseUrl = 'https://maps.googleapis.com/maps/api';

    /**
     * API Key per Google Maps.
     */
    protected string $apiKey;

    public function __construct()
    {
        $apiKey = config('services.google.maps_api_key', '');
        $this->apiKey = \Modules\Xot\Actions\Cast\SafeStringCastAction::cast($apiKey);
    }

    /**
     * Restituisce il nome del servizio.
     */
    protected function getServiceName(): string
    {
        return 'Google Maps';
    }

    /**
     * Effettua il reverse geocoding usando Google Maps API.
     *
     * @return array<string, mixed>
     */
    public function reverseGeocode(float $latitude, float $longitude): array
    {
        $cacheKey = "reverse_geocode:{$latitude},{$longitude}";

        /** @var array<string, mixed> $result */
        $result = Cache::remember($cacheKey, now()->addDay(), function () use ($latitude, $longitude) {
            $response = Http::get("{$this->baseUrl}/geocode/json", [
                'latlng' => "{$latitude},{$longitude}",
                'key' => $this->apiKey,
            ]);

            if (!$response->successful() || 'OK' !== $response->json('status')) {
                throw new \RuntimeException('Failed to get reverse geocoding data');
            }

            return $response->json();
        });

        return $result;
    }

    /**
     * Ottiene la matrice delle distanze.
     *
     * @param array<string> $origins
     * @param array<string> $destinations
     * @return array<string, mixed>
     */
    public function getDistanceMatrix(array $origins, array $destinations): array
    {
        $originsStr = implode('|', $origins);
        $destinationsStr = implode('|', $destinations);
        $cacheKey = "distance_matrix:{$originsStr}:{$destinationsStr}";

        /** @var array<string, mixed> $result */
        $result = Cache::remember($cacheKey, now()->addDay(), function () use ($originsStr, $destinationsStr) {
            $response = Http::get("{$this->baseUrl}/distancematrix/json", [
                'origins' => $originsStr,
                'destinations' => $destinationsStr,
                'key' => $this->apiKey,
            ]);

            if (!$response->successful() || 'OK' !== $response->json('status')) {
                throw new \RuntimeException('Failed to get distance matrix data');
            }

            return $response->json();
        });

        return $result;
    }

    /**
     * Ottiene l'elevazione per una posizione specifica.
     *
     * @return array{
     *     results: array<array{
     *         elevation: float,
     *         location: array{lat: float, lng: float},
     *         resolution: float
     *     }>,
     *     status: string
     * }
     */
    public function getElevation(float $latitude, float $longitude): array
    {
        $cacheKey = "elevation:{$latitude},{$longitude}";

        /** @var array{
         *     results: array<array{
         *         elevation: float,
         *         location: array{lat: float, lng: float},
         *         resolution: float
         *     }>,
         *     status: string
         * } $result */
        $result = Cache::remember($cacheKey, now()->addDay(), function () use ($latitude, $longitude) {
            $response = Http::get("{$this->baseUrl}/elevation/json", [
                'locations' => "{$latitude},{$longitude}",
                'key' => $this->apiKey,
            ]);

            if (!$response->successful() || 'OK' !== $response->json('status')) {
                throw new \RuntimeException('Failed to get elevation data');
            }

            return $response->json();
        });

        return $result;
    }

    /**
     * Ottiene la matrice delle distanze per stringhe.
     *
     * @return array{
     *     destination_addresses: array<string>,
     *     origin_addresses: array<string>,
     *     rows: array<array{
     *         elements: array<array{
     *             distance?: array{text: string, value: int},
     *             duration?: array{text: string, value: int},
     *             status: string
     *         }>
     *     }>,
     *     status: string
     * }|null
     */
    public function getDistanceMatrixByStrings(string $origins, string $destinations): ?array
    {
        $cacheKey = "distance_matrix:{$origins}:{$destinations}";

        /** @var array{
         *     destination_addresses: array<string>,
         *     origin_addresses: array<string>,
         *     rows: array<array{
         *         elements: array<array{
         *             distance?: array{text: string, value: int},
         *             duration?: array{text: string, value: int},
         *             status: string
         *         }>
         *     }>,
         *     status: string
         * }|null $result */
        $result = Cache::remember($cacheKey, now()->addDay(), function () use ($origins, $destinations) {
            $response = Http::get("{$this->baseUrl}/distancematrix/json", [
                'origins' => $origins,
                'destinations' => $destinations,
                'key' => $this->apiKey,
            ]);

            if (!$response->successful() || 'OK' !== $response->json('status')) {
                return null;
            }

            return $response->json();
        });

        return $result;
    }

    /**
     * Ottiene le coordinate per un indirizzo.
     *
     * @return array{lat: float, lng: float}|null
     */
    public function getCoordinatesByAddress(string $address): ?array
    {
        $cacheKey = 'geocode:'.md5($address);

        /** @var array{lat: float, lng: float}|null $result */
        $result = Cache::remember($cacheKey, now()->addWeek(), function () use ($address) {
            $response = Http::get("{$this->baseUrl}/geocode/json", [
                'address' => $address,
                'key' => $this->apiKey,
            ]);

            if (!$response->successful()
                || 'OK' !== $response->json('status')
                || empty($response->json('results'))) {
                return null;
            }

            /** @var array{results: array<array{geometry: array{location: array{lat: float, lng: float}}}>} $data */
            $data = $response->json();

            if (empty($data['results'][0]['geometry']['location'])) {
                return null;
            }

            return $data['results'][0]['geometry']['location'];
        });

        return $result;
    }
}
