<?php

declare(strict_types=1);

namespace Modules\MCP\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\MCP\Services\MCPServer;

class ExampleModel extends Model
{
    protected $fillable = [
        'name',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            $mcp = app(MCPServer::class);
            $violations = $mcp->validateModelContext(static::class);

            if (!empty($violations)) {
                throw new \Exception('Violazioni del contesto MCP: ' . json_encode($violations));
            }
        });

        static::saved(function ($model) {
            $mcp = app(MCPServer::class);
            $context = $mcp->getModelContext(static::class);

            if ($context) {
                $mcp->memory()->store(
                    "model:" . static::class . ":context",
                    $context
                );
            }
        });
    }

    public function getContextData(): array
    {
        $mcp = app(MCPServer::class);
        return $mcp->memory()->retrieve(
            "model:" . static::class . ":context",
            []
        );
    }

    public function fetchExternalData(string $url): mixed
    {
        $mcp = app(MCPServer::class);
        return $mcp->getCachedOrFetch(
            $url,
            "model:" . static::class . ":external",
            3600
        );
    }

    public function storeData(string $key, mixed $data): bool
    {
        $mcp = app(MCPServer::class);
        return $mcp->memory()->store(
            "model:" . static::class . ":{$key}",
            $data
        );
    }

    public function retrieveData(string $key, mixed $default = null): mixed
    {
        $mcp = app(MCPServer::class);
        return $mcp->memory()->retrieve(
            "model:" . static::class . ":{$key}",
            $default
        );
    }
}
