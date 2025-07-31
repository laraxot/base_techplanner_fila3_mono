<?php

declare(strict_types=1);

namespace Modules\Geo\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Classe base per i servizi geografici.
 */
abstract class BaseGeoService
{
    /**
     * Nome del servizio per la configurazione.
     */
    abstract protected function getServiceName(): string;

    /**
     * Ottiene la chiave API dal file di configurazione.
     *
     * @throws \RuntimeException Se la chiave API non è configurata
     */
    protected function getApiKey(): string
    {
        /** @var string|null $apiKey */
        $apiKey = config("geo.api_keys.{$this->getServiceName()}");

        if (empty($apiKey)) {
            throw new \RuntimeException("API key non configurata per {$this->getServiceName()}");
        }

        return $apiKey;
    }

    /**
     * Esegue una richiesta HTTP con rate limiting, cache e retry.
     *
     * @param string               $method   Metodo HTTP (GET, POST, etc.)
     * @param string               $url      URL della richiesta
     * @param array<string, mixed> $params   Parametri della richiesta
     * @param bool                 $useCache Se utilizzare la cache
     *
     * @throws \RuntimeException Se la richiesta fallisce
     *
     * @return array<string, mixed>
     */
    protected function makeRequest(string $method, string $url, array $params = [], bool $useCache = true): array
    {
        $cacheKey = $this->getCacheKey($method, $url, $params);

        if ($useCache && config('geo.cache.enabled')) {
            /** @var array<string, mixed>|null $cached */
            $cached = Cache::get($cacheKey);
            if (null !== $cached) {
                return $cached;
            }
        }

        // Rate limiting
        /** @var int $maxAttempts */
        $maxAttempts = config("geo.rate_limits.{$this->getServiceName()}.requests_per_second", 50);
        RateLimiter::attempt(
            $this->getServiceName(),
            $maxAttempts,
            function () {
                // Rate limit exceeded
                throw new \RuntimeException('Rate limit exceeded');
            }
        );

        // Esegui la richiesta
        $response = Http::timeout(config('geo.timeout', 30))
            ->retry(config('geo.retry_attempts', 3), config('geo.retry_delay', 1000))
            ->$method($url, $params);

        if (!$response->successful()) {
            throw new \RuntimeException("HTTP request failed: {$response->status()}");
        }

        /** @var array<string, mixed> $data */
        $data = $response->json();

        // Cache del risultato
        if ($useCache && config('geo.cache.enabled')) {
            Cache::put($cacheKey, $data, config('geo.cache.ttl', 3600));
        }

        return $data;
    }

    /**
     * Genera una chiave di cache univoca per la richiesta.
     */
    protected function getCacheKey(string $method, string $url, array $params): string
    {
        return "geo_{$this->getServiceName()}_" . md5($method . $url . serialize($params));
    }
}
