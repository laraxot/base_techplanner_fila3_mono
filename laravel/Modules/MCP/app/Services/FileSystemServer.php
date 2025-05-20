<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileSystemServer
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function store(string $path, mixed $content): bool
    {
        return Storage::put($path, $content);
    }

    public function retrieve(string $path): mixed
    {
        return Storage::get($path);
    }

    public function exists(string $path): bool
    {
        return Storage::exists($path);
    }

    public function delete(string $path): bool
    {
        return Storage::delete($path);
    }

    public function list(string $directory): array
    {
        return Storage::files($directory);
    }

    public function makeDirectory(string $path): bool
    {
        return Storage::makeDirectory($path);
    }

    public function deleteDirectory(string $path): bool
    {
        return Storage::deleteDirectory($path);
    }

    public function move(string $from, string $to): bool
    {
        return Storage::move($from, $to);
    }

    public function copy(string $from, string $to): bool
    {
        return Storage::copy($from, $to);
    }

    public function getSize(string $path): int
    {
        return Storage::size($path);
    }

    public function getLastModified(string $path): int
    {
        return Storage::lastModified($path);
    }

    public function getMimeType(string $path): string
    {
        return Storage::mimeType($path);
    }
}
