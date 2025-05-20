<?php

declare(strict_types=1);

namespace Modules\MCP\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\MCP\Services\MCPServer;
use Symfony\Component\HttpFoundation\Response;

class CheckModelContext
{
    protected MCPServer $mcp;

    public function __construct(MCPServer $mcp)
    {
        $this->mcp = $mcp;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $model = $request->route('model');

        if (!$model) {
            return $next($request);
        }

        $violations = $this->mcp->validateModelContext($model);

        if (!empty($violations)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Violazioni del contesto MCP',
                'violations' => $violations,
            ], 422);
        }

        return $next($request);
    }
}
