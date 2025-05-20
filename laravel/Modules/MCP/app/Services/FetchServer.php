<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class FetchServer
{
    protected array $config;
    protected array $defaultHeaders;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->defaultHeaders = $config['headers'] ?? [];
    }

    public function get(string $url, array $query = [], array $headers = []): Response
    {
        return Http::withHeaders(array_merge($this->defaultHeaders, $headers))
            ->get($url, $query);
    }

    public function post(string $url, array $data = [], array $headers = []): Response
    {
        return Http::withHeaders(array_merge($this->defaultHeaders, $headers))
            ->post($url, $data);
    }

    public function put(string $url, array $data = [], array $headers = []): Response
    {
        return Http::withHeaders(array_merge($this->defaultHeaders, $headers))
            ->put($url, $data);
    }

    public function patch(string $url, array $data = [], array $headers = []): Response
    {
        return Http::withHeaders(array_merge($this->defaultHeaders, $headers))
            ->patch($url, $data);
    }

    public function delete(string $url, array $data = [], array $headers = []): Response
    {
        return Http::withHeaders(array_merge($this->defaultHeaders, $headers))
            ->delete($url, $data);
    }

    public function withHeaders(array $headers): self
    {
        $this->defaultHeaders = array_merge($this->defaultHeaders, $headers);
        return $this;
    }

    public function withBasicAuth(string $username, string $password): self
    {
        $this->defaultHeaders['Authorization'] = 'Basic ' . base64_encode($username . ':' . $password);
        return $this;
    }

    public function withToken(string $token, string $type = 'Bearer'): self
    {
        $this->defaultHeaders['Authorization'] = $type . ' ' . $token;
        return $this;
    }

    public function withTimeout(int $seconds): self
    {
        Http::timeout($seconds);
        return $this;
    }

    public function withRetry(int $times, int $sleep = 100): self
    {
        Http::retry($times, $sleep);
        return $this;
    }

    public function withOptions(array $options): self
    {
        Http::withOptions($options);
        return $this;
    }

    public function getDefaultHeaders(): array
    {
        return $this->defaultHeaders;
    }
}
