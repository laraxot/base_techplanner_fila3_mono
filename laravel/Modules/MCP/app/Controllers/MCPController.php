<?php

declare(strict_types=1);

namespace Modules\MCP\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\MCP\Services\MCPServer;

class MCPController extends Controller
{
    protected MCPServer $mcp;

    public function __construct(MCPServer $mcp)
    {
        $this->mcp = $mcp;
    }

    public function validateModel(string $model): JsonResponse
    {
        $violations = $this->mcp->validateModelContext($model);

        if (empty($violations)) {
            return response()->json([
                'status' => 'success',
                'message' => "Il modello {$model} è valido",
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => "Violazioni trovate per il modello {$model}",
            'violations' => $violations,
        ], 422);
    }

    public function getModelContext(string $model): JsonResponse
    {
        $context = $this->mcp->getModelContext($model);

        if (!$context) {
            return response()->json([
                'status' => 'error',
                'message' => "Contesto non trovato per il modello {$model}",
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'context' => $context,
        ]);
    }

    public function getRelatedModels(string $model): JsonResponse
    {
        $related = $this->mcp->getRelatedModels($model);

        return response()->json([
            'status' => 'success',
            'related_models' => $related,
        ]);
    }

    public function storeModelData(string $model, string $key, mixed $data): JsonResponse
    {
        $stored = $this->mcp->memory()->store("model:{$model}:{$key}", $data);

        if (!$stored) {
            return response()->json([
                'status' => 'error',
                'message' => "Impossibile memorizzare i dati per il modello {$model}",
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Dati memorizzati per il modello {$model}",
        ]);
    }

    public function retrieveModelData(string $model, string $key): JsonResponse
    {
        $data = $this->mcp->memory()->retrieve("model:{$model}:{$key}");

        if ($data === null) {
            return response()->json([
                'status' => 'error',
                'message' => "Dati non trovati per il modello {$model}",
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function fetchExternalData(string $model, string $url): JsonResponse
    {
        $data = $this->mcp->getCachedOrFetch(
            $url,
            "model:{$model}:external",
            3600
        );

        if ($data === null) {
            return response()->json([
                'status' => 'error',
                'message' => "Impossibile recuperare i dati esterni per il modello {$model}",
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
