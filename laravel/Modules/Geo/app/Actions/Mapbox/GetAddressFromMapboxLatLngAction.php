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

        if (empty($apiKey)) {
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

        if (! $response->successful()) {
            throw InvalidLocationException::invalidData('Richiesta a Mapbox fallita');
        }

        return $response->json();
    }

    private function parseResponse(array $response): MapboxMapData
    {
        $features = collect($response['features'] ?? []);
        $location = $features->first();

        if (empty($location)) {
            throw InvalidLocationException::invalidData('Nessun risultato trovato');
        }

        // Estrai il contesto dal risultato
        $context = collect($location['context'] ?? [])->mapWithKeys(function (array $item) {
            $id = $item['id'] ?? '';
            $text = $item['text'] ?? '';
            $shortCode = $item['short_code'] ?? '';

            // Determina il tipo di contesto dal prefisso dell'ID
            $type = explode('.', $id)[0] ?? '';

            return [$type => [
                'text' => $text,
                'short_code' => $shortCode,
            ]];
        })->toArray();

        $location['context'] = [
            'country' => $context['country']['text'] ?? null,
            'country_code' => $context['country']['short_code'] ?? 'it',
            'place' => $context['place']['text'] ?? null,
            'postcode' => $context['postcode']['text'] ?? null,
            'locality' => $context['locality']['text'] ?? null,
            'region' => $context['region']['text'] ?? null,
            'neighborhood' => $context['neighborhood']['text'] ?? null,
        ];

        return new MapboxMapData($location);
    }

    private function mapResponseToAddressData(MapboxMapData $data): AddressData
    {
        $res = $data->toArray();

        return new AddressData(
            latitude: (float) ($res['center'][1] ?? 0),
            longitude: (float) ($res['center'][0] ?? 0),
            country: $res['context']['country'] ?? null,
            city: $res['context']['place'] ?? null,
            country_code: strtoupper($res['context']['country_code'] ?? 'IT'),
            postal_code: (int) ($res['context']['postcode'] ?? 0),
            locality: $res['context']['locality'] ?? null,
            county: $res['context']['region'] ?? null,
            street: $res['text'] ?? null,
            street_number: $res['address'] ?? null,
            district: $res['context']['neighborhood'] ?? null,
            state: $res['context']['region'] ?? null,
        );
    }
}
