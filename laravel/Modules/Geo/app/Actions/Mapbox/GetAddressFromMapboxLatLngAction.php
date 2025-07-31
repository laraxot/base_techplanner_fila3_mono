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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $data = $response->json();
        
        if (!is_array($data)) {
            throw InvalidLocationException::invalidData('Risposta di Mapbox non valida');
        }

        return $data;
=======
        return $response->json();
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        return $response->json();
=======
=======
>>>>>>> 6f0eea5 (.)
        $data = $response->json();
        
        if (!is_array($data)) {
            throw InvalidLocationException::invalidData('Risposta di Mapbox non valida');
        }

        return $data;
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
    }

    private function parseResponse(array $response): MapboxMapData
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array<int, array{center?: array{float, float}, text?: string, address?: string, context?: array<int, array{id?: string, text?: string, short_code?: string}>}> $features */
        $features = $response['features'] ?? [];
        $location = $features[0] ?? [];
=======
        $features = collect($response['features'] ?? []);
        $location = $features->first();
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        $features = collect($response['features'] ?? []);
        $location = $features->first();
=======
        /** @var array<int, array{center?: array{float, float}, text?: string, address?: string, context?: array<int, array{id?: string, text?: string, short_code?: string}>}> $features */
        $features = $response['features'] ?? [];
        $location = $features[0] ?? [];
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        /** @var array<int, array{center?: array{float, float}, text?: string, address?: string, context?: array<int, array{id?: string, text?: string, short_code?: string}>}> $features */
        $features = $response['features'] ?? [];
        $location = $features[0] ?? [];
>>>>>>> 6f0eea5 (.)

        if (empty($location)) {
            throw InvalidLocationException::invalidData('Nessun risultato trovato');
        }

        // Estrai il contesto dal risultato
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array<int, array{id?: string, text?: string, short_code?: string}> $contextItems */
        $contextItems = $location['context'] ?? [];
        
        $context = [];
        foreach ($contextItems as $item) {
=======
        $context = collect($location['context'] ?? [])->mapWithKeys(function (array $item) {
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        $context = collect($location['context'] ?? [])->mapWithKeys(function (array $item) {
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var array<int, array{id?: string, text?: string, short_code?: string}> $contextItems */
        $contextItems = $location['context'] ?? [];
        
        $context = [];
        foreach ($contextItems as $item) {
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
            $id = $item['id'] ?? '';
            $text = $item['text'] ?? '';
            $shortCode = $item['short_code'] ?? '';

            // Determina il tipo di contesto dal prefisso dell'ID
            $type = explode('.', $id)[0] ?? '';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            if (!empty($type)) {
                $context[$type] = [
                    'text' => $text,
                    'short_code' => $shortCode,
                ];
            }
        }

        // Costruisce la struttura dati richiesta da MapboxMapData
        $center = $location['center'] ?? [0.0, 0.0];
        
        // Validazione del tipo e dell'array center
        if (!is_array($center) || count($center) < 2) {
            $center = [0.0, 0.0];
        }
        
        /** @var array{center: array{float, float}, text: string, address: string|null, context: array{country: string|null, country_code: string|null, place: string|null, postcode: string|null, locality: string|null, region: string|null, neighborhood: string|null}} $mappedData */
        $mappedData = [
            'center' => [
                (float) ($center[0] ?? 0.0),
                (float) ($center[1] ?? 0.0)
            ],
            'text' => (string) ($location['text'] ?? ''),
            'address' => isset($location['address']) ? (string) $location['address'] : null,
            'context' => [
                'country' => $context['country']['text'] ?? null,
                'country_code' => $context['country']['short_code'] ?? 'it',
                'place' => $context['place']['text'] ?? null,
                'postcode' => $context['postcode']['text'] ?? null,
                'locality' => $context['locality']['text'] ?? null,
                'region' => $context['region']['text'] ?? null,
                'neighborhood' => $context['neighborhood']['text'] ?? null,
            ],
        ];

        return new MapboxMapData($mappedData);
=======
=======
>>>>>>> 0e7ec50 (.)
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
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
            if (!empty($type)) {
                $context[$type] = [
                    'text' => $text,
                    'short_code' => $shortCode,
                ];
            }
        }

        // Costruisce la struttura dati richiesta da MapboxMapData
        $center = $location['center'] ?? [0.0, 0.0];
        
        // Validazione del tipo e dell'array center
        if (!is_array($center) || count($center) < 2) {
            $center = [0.0, 0.0];
        }
        
        /** @var array{center: array{float, float}, text: string, address: string|null, context: array{country: string|null, country_code: string|null, place: string|null, postcode: string|null, locality: string|null, region: string|null, neighborhood: string|null}} $mappedData */
        $mappedData = [
            'center' => [
                (float) ($center[0] ?? 0.0),
                (float) ($center[1] ?? 0.0)
            ],
            'text' => (string) ($location['text'] ?? ''),
            'address' => isset($location['address']) ? (string) $location['address'] : null,
            'context' => [
                'country' => $context['country']['text'] ?? null,
                'country_code' => $context['country']['short_code'] ?? 'it',
                'place' => $context['place']['text'] ?? null,
                'postcode' => $context['postcode']['text'] ?? null,
                'locality' => $context['locality']['text'] ?? null,
                'region' => $context['region']['text'] ?? null,
                'neighborhood' => $context['neighborhood']['text'] ?? null,
            ],
        ];

        return new MapboxMapData($mappedData);
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
