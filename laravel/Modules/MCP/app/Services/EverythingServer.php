<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

class EverythingServer
{
    protected FileSystemServer $filesystem;
    protected MemoryServer $memory;
    protected FetchServer $fetch;

    public function __construct(array $config)
    {
        $this->filesystem = new FileSystemServer($config['filesystem'] ?? []);
        $this->memory = new MemoryServer($config['memory'] ?? []);
        $this->fetch = new FetchServer($config['fetch'] ?? []);
    }

    public function filesystem(): FileSystemServer
    {
        return $this->filesystem;
    }

    public function memory(): MemoryServer
    {
        return $this->memory;
    }

    public function fetch(): FetchServer
    {
        return $this->fetch;
    }

    public function storeFile(string $path, mixed $content): bool
    {
        return $this->filesystem->store($path, $content);
    }

    public function retrieveFile(string $path): mixed
    {
        return $this->filesystem->retrieve($path);
    }

    public function storeInMemory(string $key, mixed $value, ?int $ttl = null): bool
    {
        return $this->memory->store($key, $value, $ttl);
    }

    public function retrieveFromMemory(string $key, mixed $default = null): mixed
    {
        return $this->memory->retrieve($key, $default);
    }

    public function fetchUrl(string $url, array $query = [], array $headers = []): \Illuminate\Http\Client\Response
    {
        return $this->fetch->get($url, $query, $headers);
    }

    public function fetchAndStore(string $url, string $path, array $query = [], array $headers = []): bool
    {
        $response = $this->fetch->get($url, $query, $headers);
        if ($response->successful()) {
            return $this->filesystem->store($path, $response->body());
        }
        return false;
    }

    public function fetchAndCache(string $url, string $key, ?int $ttl = null, array $query = [], array $headers = []): bool
    {
        $response = $this->fetch->get($url, $query, $headers);
        if ($response->successful()) {
            return $this->memory->store($key, $response->json(), $ttl);
        }
        return false;
    }

    public function getCachedOrFetch(string $url, string $key, ?int $ttl = null, array $query = [], array $headers = []): mixed
    {
        if ($this->memory->exists($key)) {
            return $this->memory->retrieve($key);
        }

        $response = $this->fetch->get($url, $query, $headers);
        if ($response->successful()) {
            $data = $response->json();
            $this->memory->store($key, $data, $ttl);
            return $data;
        }

        return null;
    }

    public function getCachedOrFile(string $key, string $path, ?int $ttl = null): mixed
    {
        if ($this->memory->exists($key)) {
            return $this->memory->retrieve($key);
        }

        if ($this->filesystem->exists($path)) {
            $data = $this->filesystem->retrieve($path);
            $this->memory->store($key, $data, $ttl);
            return $data;
        }

        return null;
    }
}
