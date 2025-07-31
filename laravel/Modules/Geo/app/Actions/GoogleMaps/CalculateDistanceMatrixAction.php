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
     * @param Collection<int, LocationData> $origins      Punti di origine
     * @param Collection<int, LocationData> $destinations Punti di destinazione
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
            'origins' => $origins->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'destinations' => $destinations->map(fn (LocationData $location): string => sprintf('%f,%f', $location->latitude, $location->longitude))->join('|'),
            'key' => $apiKey,
        ]);

        if (!$response->successful()) {
            throw GoogleMapsApiException::requestFailed((string) $response->status());
        }

        /** @var array{status?: string, rows?: array<int, array{elements?: array<int, array{distance?: array{text: string, value: int}, duration?: array{text: string, value: int}, status?: string}>}>} $data */
        $data = $response->json();

        if (!is_array($data) || 'OK' !== ($data['status'] ?? null)) {
            throw GoogleMapsApiException::requestFailed('Risposta API non valida');
        }

        return $this->parseResponse($data);
    }

    /**
     * Ottiene la chiave API di Google Maps.
     *
     * @throws GoogleMapsApiException Se la chiave API non è configurata
     */
    private function getApiKey(): string
    {
        $apiKey = config('services.google.maps_api_key');

        if (empty($apiKey)) {
            throw GoogleMapsApiException::missingApiKey();
        }

        return $apiKey;
    }

    /**
     * Parsa la risposta dell'API.
     *
     * @param array{status?: string, rows?: array<int, array{elements?: array<int, array{distance?: array{text: string, value: int}, duration?: array{text: string, value: int}, status?: string}>}>} $data
     * @return array<array<array{
     *     distance: array{text: string, value: int},
     *     duration: array{text: string, value: int},
     *     status: string
     * }>>
     */
    private function parseResponse(array $data): array
    {
        $rows = $data['rows'] ?? [];

        return array_map(function (array $row): array {
            $elements = $row['elements'] ?? [];

            return array_map(function (array $element): array {
                return [
                    'distance' => $element['distance'] ?? ['text' => '', 'value' => 0],
                    'duration' => $element['duration'] ?? ['text' => '', 'value' => 0],
                    'status' => $element['status'] ?? 'NOT_FOUND',
                ];
            }, $elements);
        }, $rows);
    }
}
