<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Facades\Cache;

class MemoryServer
{
    protected array $config;
    protected string $prefix;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->prefix = $config['prefix'] ?? 'mcp:';
    }

    public function store(string $key, mixed $value, ?int $ttl = null): bool
    {
        return Cache::put($this->prefix . $key, $value, $ttl);
    }

    public function retrieve(string $key, mixed $default = null): mixed
    {
        return Cache::get($this->prefix . $key, $default);
    }

    public function exists(string $key): bool
    {
        return Cache::has($this->prefix . $key);
    }

    public function delete(string $key): bool
    {
        return Cache::forget($this->prefix . $key);
    }

    public function increment(string $key, int $value = 1): int
    {
        return Cache::increment($this->prefix . $key, $value);
    }

    public function decrement(string $key, int $value = 1): int
    {
        return Cache::decrement($this->prefix . $key, $value);
    }

    public function remember(string $key, int $ttl, callable $callback): mixed
    {
        return Cache::remember($this->prefix . $key, $ttl, $callback);
    }

    public function rememberForever(string $key, callable $callback): mixed
    {
        return Cache::rememberForever($this->prefix . $key, $callback);
    }

    public function flush(): bool
    {
        return Cache::flush();
    }

    public function getMultiple(array $keys, mixed $default = null): array
    {
        $prefixedKeys = array_map(fn ($key) => $this->prefix . $key, $keys);
        return Cache::many($prefixedKeys);
    }

    public function setMultiple(array $values, ?int $ttl = null): bool
    {
        $prefixedValues = [];
        foreach ($values as $key => $value) {
            $prefixedValues[$this->prefix . $key] = $value;
        }
        return Cache::putMany($prefixedValues, $ttl);
    }

    public function deleteMultiple(array $keys): bool
    {
        $prefixedKeys = array_map(fn ($key) => $this->prefix . $key, $keys);
        return Cache::forget($prefixedKeys);
    }
}
