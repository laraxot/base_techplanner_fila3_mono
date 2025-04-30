<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\LocationIQ;

use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\AddressData;

/**
 * Classe per ottenere i dati dell'indirizzo dal servizio LocationIQ.
 */
class GetAddressFromLocationIQAction
{
    private const BASE_URL = 'https://eu1.locationiq.com/v1';

    /**
     * Esegue la ricerca dell'indirizzo su LocationIQ.
     *
     * @param string $address L'indirizzo da cercare
     *
     * @throws \Exception Se la chiave API non è configurata
     *
     * @return AddressData|null I dati dell'indirizzo trovato o null se non trovato
     */
    public function execute(string $address): ?AddressData
    {
        $apiKey = config('services.locationiq.key');

        if (empty($apiKey)) {
            throw new \Exception('LocationIQ API key not configured');
        }

        $response = Http::get(self::BASE_URL.'/search', [
            'key' => $apiKey,
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
            'addressdetails' => 1,
        ]);

        if (! $response->successful()) {
            return null;
        }

        /** @var array<int, array{lat?: string, lon?: string, address?: array{country?: string, city?: string, town?: string, village?: string, country_code?: string, postcode?: string, suburb?: string, county?: string, road?: string, house_number?: string, state?: string}}> $data */
        $data = $response->json();

        if (empty($data[0])) {
            return null;
        }

        $result = $data[0];
        $address = $result['address'] ?? [];

        return AddressData::from([
            'latitude' => (float) ($result['lat'] ?? 0),
            'longitude' => (float) ($result['lon'] ?? 0),
            'country' => $address['country'] ?? 'Italia',
            'city' => $address['city'] ?? $address['town'] ?? $address['village'] ?? '',
            'country_code' => $address['country_code'] ?? 'IT',
            'postal_code' => (int) ($address['postcode'] ?? 0),
            'locality' => $address['suburb'] ?? '',
            'county' => $address['county'] ?? '',
            'street' => $address['road'] ?? '',
            'street_number' => $address['house_number'] ?? '',
            'district' => $address['suburb'] ?? '',
            'state' => $address['state'] ?? '',
        ]);
    }
}
