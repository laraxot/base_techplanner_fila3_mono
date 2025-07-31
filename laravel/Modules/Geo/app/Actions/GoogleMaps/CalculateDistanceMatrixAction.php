<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\GoogleMaps\GoogleMapsApiException;

/**
 * Classe per calcolare la matrice delle distanze tra punti usando Google Maps.
 */
class CalculateDistanceMatrixAction
{
    private const BASE_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    /**
     * Calcola la matrice delle distanze tra origini e destinazioni.
     *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @param Collection<int, LocationData> $origins      Punti di origine
     * @param Collection<int, LocationData> $destinations Punti di destinazione
=======
     * @param Collection<LocationData> $origins      Punti di origine
     * @param Collection<LocationData> $destinations Punti di destinazione
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
     * @param Collection<LocationData> $origins      Punti di origine
     * @param Collection<LocationData> $destinations Punti di destinazione
=======
     * @param Collection<int, LocationData> $origins      Punti di origine
     * @param Collection<int, LocationData> $destinations Punti di destinazione
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
     * @param Collection<int, LocationData> $origins      Punti di origine
     * @param Collection<int, LocationData> $destinations Punti di destinazione
>>>>>>> 6f0eea5 (.)
     *
     * @throws GoogleMapsApiException Se la richiesta fallisce o i dati non sono validi
     *
     * @return array<array<array{
     *     distance: array{text: string, value: int},
     *     duration: array{text: string, value: int},
     *     status: string
     * }>>
     */
    public function execute(Collection $origins, Collection $destinations): array
    {
        $apiKey = $this->getApiKey();

        $response = Http::get(self::BASE_URL, [
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'origins' => $origins->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
=======
            'origins' => $origins->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            'origins' => $origins->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
=======
            'origins' => $origins->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            'origins' => $origins->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
>>>>>>> 6f0eea5 (.)
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            throw GoogleMapsApiException::requestFailed((string) $response->status());
        }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array{status?: string, rows?: array<int, array{elements?: array<int, array{distance?: array{text: string, value: int}, duration?: array{text: string, value: int}, status?: string}>}>} $data */
        $data = $response->json();

        if (!is_array($data) || 'OK' !== ($data['status'] ?? null)) {
=======
        $data = $response->json();

        if ('OK' !== ($data['status'] ?? null)) {
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        $data = $response->json();

        if ('OK' !== ($data['status'] ?? null)) {
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var array{status?: string, rows?: array<int, array{elements?: array<int, array{distance?: array{text: string, value: int}, duration?: array{text: string, value: int}, status?: string}>}>} $data */
        $data = $response->json();

        if (!is_array($data) || 'OK' !== ($data['status'] ?? null)) {
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
            throw GoogleMapsApiException::requestFailed('Stato della risposta non valido: '.($data['status'] ?? 'sconosciuto'));
        }

        if (empty($data['rows'])) {
            throw GoogleMapsApiException::noResultsFound();
        }

        return array_map(
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            fn (array $row): array => array_map(
                fn (array $element): array => [
=======
            fn (array $row) => array_map(
                fn (array $element) => [
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            fn (array $row) => array_map(
                fn (array $element) => [
=======
            fn (array $row): array => array_map(
                fn (array $element): array => [
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            fn (array $row): array => array_map(
                fn (array $element): array => [
>>>>>>> 6f0eea5 (.)
                    'distance' => $element['distance'] ?? ['text' => '0 km', 'value' => 0],
                    'duration' => $element['duration'] ?? ['text' => '0 min', 'value' => 0],
                    'status' => $element['status'] ?? 'ZERO_RESULTS',
                ],
                $row['elements'] ?? []
            ),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $data['rows'] ?? []
=======
            $data['rows']
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            $data['rows']
=======
            $data['rows'] ?? []
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            $data['rows'] ?? []
>>>>>>> 6f0eea5 (.)
        );
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
}
