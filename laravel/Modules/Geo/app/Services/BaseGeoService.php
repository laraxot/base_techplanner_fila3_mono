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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var string|null $apiKey */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
        /** @var string|null $apiKey */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        /** @var string|null $apiKey */
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            /** @var array<string, mixed>|null $cached */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
            /** @var array<string, mixed>|null $cached */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            /** @var array<string, mixed>|null $cached */
>>>>>>> 6f0eea5 (.)
            $cached = Cache::get($cacheKey);
            if (null !== $cached) {
                return $cached;
            }
        }

        // Rate limiting
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var int $maxAttempts */
        $maxAttempts = config("geo.rate_limits.{$this->getServiceName()}.requests_per_second", 50);
        RateLimiter::attempt(
            $this->getServiceName(),
            $maxAttempts,
=======
        RateLimiter::attempt(
            $this->getServiceName(),
            config("geo.rate_limits.{$this->getServiceName()}.requests_per_second", 50),
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        RateLimiter::attempt(
            $this->getServiceName(),
            config("geo.rate_limits.{$this->getServiceName()}.requests_per_second", 50),
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var int $maxAttempts */
        $maxAttempts = config("geo.rate_limits.{$this->getServiceName()}.requests_per_second", 50);
        RateLimiter::attempt(
            $this->getServiceName(),
            $maxAttempts,
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
            function () {
                return true;
            }
        );

        try {
            $response = $this->buildHttpClient()
                ->{strtolower($method)}($url, $params);

            if (! $response->successful()) {
                throw new \RuntimeException("Richiesta fallita a {$this->getServiceName()}: ".$response->status());
            }

            $data = $response->json();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            
            // Validazione tipo di ritorno per PHPStan level 9 compliance
            if (!is_array($data)) {
                throw new \RuntimeException("Risposta API non valida: atteso array, ricevuto " . gettype($data));
            }
            
            // Assicura che sia array<string, mixed> come richiesto dalla signature
            /** @var array<string, mixed> $validatedData */
            $validatedData = $data;

            if ($useCache && config('geo.cache.enabled')) {
                /** @var int $ttl */
                $ttl = config('geo.cache.ttl', 86400);
                Cache::put($cacheKey, $validatedData, $ttl);
            }

            return $validatedData;
=======
=======
>>>>>>> 0e7ec50 (.)

            if ($useCache && config('geo.cache.enabled')) {
                Cache::put($cacheKey, $data, config('geo.cache.ttl', 86400));
            }

            return $data;
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
            
            // Validazione tipo di ritorno per PHPStan level 9 compliance
            if (!is_array($data)) {
                throw new \RuntimeException("Risposta API non valida: atteso array, ricevuto " . gettype($data));
            }
            
            // Assicura che sia array<string, mixed> come richiesto dalla signature
            /** @var array<string, mixed> $validatedData */
            $validatedData = $data;

            if ($useCache && config('geo.cache.enabled')) {
                /** @var int $ttl */
                $ttl = config('geo.cache.ttl', 86400);
                Cache::put($cacheKey, $validatedData, $ttl);
            }

            return $validatedData;
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
        } catch (\Throwable $e) {
            throw new \RuntimeException("Errore durante la richiesta a {$this->getServiceName()}: ".$e->getMessage(), 0, $e);
        }
    }

    /**
     * Costruisce il client HTTP con timeout e retry configurati.
     */
    protected function buildHttpClient(): PendingRequest
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var float $timeout */
        $timeout = config('geo.http_client.timeout', 5.0);
        /** @var int $retryTimes */
        $retryTimes = config('geo.http_client.retry.times', 3);
        /** @var int $retrySleep */
        $retrySleep = config('geo.http_client.retry.sleep', 100);
        /** @var array<string> $whenTypes */
        $whenTypes = config('geo.http_client.retry.when', []);

        return Http::timeout($timeout)
            ->retry(
                $retryTimes,
                $retrySleep,
                function ($exception) use ($whenTypes) {
=======
=======
>>>>>>> 0e7ec50 (.)
        return Http::timeout(config('geo.http_client.timeout', 5.0))
            ->retry(
                config('geo.http_client.retry.times', 3),
                config('geo.http_client.retry.sleep', 100),
                function ($exception) {
                    $whenTypes = config('geo.http_client.retry.when', []);

<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var float $timeout */
        $timeout = config('geo.http_client.timeout', 5.0);
        /** @var int $retryTimes */
        $retryTimes = config('geo.http_client.retry.times', 3);
        /** @var int $retrySleep */
        $retrySleep = config('geo.http_client.retry.sleep', 100);
        /** @var array<string> $whenTypes */
        $whenTypes = config('geo.http_client.retry.when', []);

        return Http::timeout($timeout)
            ->retry(
                $retryTimes,
                $retrySleep,
                function ($exception) use ($whenTypes) {
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
                    foreach ($whenTypes as $type) {
                        if (is_a($exception, "\\GuzzleHttp\\Exception\\{$type}")) {
                            return true;
                        }
                    }

                    return false;
                }
            );
    }

    /**
     * Genera una chiave di cache per la richiesta.
     *
     * @param string               $method Metodo HTTP
     * @param string               $url    URL della richiesta
     * @param array<string, mixed> $params Parametri della richiesta
     */
    protected function getCacheKey(string $method, string $url, array $params): string
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var string $prefix */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
        /** @var string $prefix */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        /** @var string $prefix */
>>>>>>> 6f0eea5 (.)
        $prefix = config('geo.cache.prefix', 'geo_');
        $hash = md5($method.$url.serialize($params));

        return "{$prefix}{$this->getServiceName()}_{$hash}";
    }
}
