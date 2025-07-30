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
     * @param Collection<LocationData> $origins      Punti di origine
     * @param Collection<LocationData> $destinations Punti di destinazione
=======
     * @param Collection<int, LocationData> $origins      Punti di origine
     * @param Collection<int, LocationData> $destinations Punti di destinazione
>>>>>>> 3c5e1ea (.)
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
            'origins' => $origins->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location) => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
=======
            'origins' => $origins->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
>>>>>>> 3c5e1ea (.)
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            throw GoogleMapsApiException::requestFailed((string) $response->status());
        }

<<<<<<< HEAD
        $data = $response->json();

        if ('OK' !== ($data['status'] ?? null)) {
=======
        /** @var array{status?: string, rows?: array<int, array{elements?: array<int, array{distance?: array{text: string, value: int}, duration?: array{text: string, value: int}, status?: string}>}>} $data */
        $data = $response->json();

        if (!is_array($data) || 'OK' !== ($data['status'] ?? null)) {
>>>>>>> 3c5e1ea (.)
            throw GoogleMapsApiException::requestFailed('Stato della risposta non valido: '.($data['status'] ?? 'sconosciuto'));
        }

        if (empty($data['rows'])) {
            throw GoogleMapsApiException::noResultsFound();
        }

        return array_map(
<<<<<<< HEAD
            fn (array $row) => array_map(
                fn (array $element) => [
=======
            fn (array $row): array => array_map(
                fn (array $element): array => [
>>>>>>> 3c5e1ea (.)
                    'distance' => $element['distance'] ?? ['text' => '0 km', 'value' => 0],
                    'duration' => $element['duration'] ?? ['text' => '0 min', 'value' => 0],
                    'status' => $element['status'] ?? 'ZERO_RESULTS',
                ],
                $row['elements'] ?? []
            ),
<<<<<<< HEAD
            $data['rows']
=======
            $data['rows'] ?? []
>>>>>>> 3c5e1ea (.)
        );
    }

    private function getApiKey(): string
    {
        $apiKey = config('services.google.maps_api_key');

<<<<<<< HEAD
        if (empty($apiKey)) {
=======
        if (empty($apiKey) || !is_string($apiKey)) {
>>>>>>> 3c5e1ea (.)
            throw GoogleMapsApiException::missingApiKey();
        }

        return $apiKey;
    }
}
