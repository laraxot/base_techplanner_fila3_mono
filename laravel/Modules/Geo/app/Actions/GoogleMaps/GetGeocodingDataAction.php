<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Modules\Geo\Datas\GeocodingData;
use Webmozart\Assert\Assert;

use function Safe\json_decode;

/**
 * Action per ottenere i dati di geocodifica da Google Maps.
 */
class GetGeocodingDataAction
{
    private const API_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    public function __construct(
        private readonly Client $client,
    ) {}

    /**
     * Ottiene i dati di geocodifica per un indirizzo.
     *
     * @throws \RuntimeException Se la richiesta fallisce o la risposta non è valida
     */
    public function execute(string $address): GeocodingData
    {
        $this->validateInput($address);

        try {
            $response = $this->makeApiRequest($address);
            $parsedResponse = $this->parseResponse($response);

            return $parsedResponse;
        } catch (GuzzleException $e) {
            Log::error('Errore nella geocodifica', [
                'error' => $e->getMessage(),
                'address' => $address,
            ]);

            return GeocodingData::error('REQUEST_FAILED');
        }
    }

    /**
     * Valida i dati di input.
     *
     * @throws \RuntimeException Se i dati non sono validi
     */
    private function validateInput(string $address): void
    {
        // $apiKey = config('services.google_maps.api_key');
        $apiKey = config('services.google.maps_api_key');
        Assert::notEmpty($apiKey, 'Chiave API Google Maps non configurata!');
        Assert::notEmpty($address, 'Indirizzo non può essere vuoto');
        Assert::maxLength($address, 1000, 'Indirizzo troppo lungo');
    }

    /**
     * @throws GuzzleException
     */
    private function makeApiRequest(string $address): string
    {
        $response = $this->client->get(self::API_URL, [
            'query' => [
                'address' => $address,
                'key' => config('geo.google_maps.api_key'),
                'language' => config('geo.google_maps.language', 'it'),
                'region' => config('geo.google_maps.region', 'IT'),
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @throws \RuntimeException Se la risposta non è nel formato atteso
     */
    private function parseResponse(string $response): GeocodingData
    {
        /** @var array{
         *     status: string,
         *     results?: array<array{
         *         geometry: array{
         *             location: array{
         *                 lat: float,
         *                 lng: float
         *             }
         *         },
         *         formatted_address: string,
         *         address_components: array<array{
         *             long_name: string,
         *             short_name: string,
         *             types: array<string>
         *         }>
         *     }>,
         *     error_message?: string
         * } $data */
        $data = json_decode($response, true);

        if ($data['status'] !== 'OK' || empty($data['results'])) {
            Log::warning('Geocodifica fallita', [
                'status' => $data['status'],
                'error' => $data['error_message'] ?? 'Nessun risultato trovato',
            ]);

            return GeocodingData::error($data['status']);
        }

        return GeocodingData::fromGoogleResponse($data);
    }
}
