<?php

declare(strict_types=1);

namespace Modules\MCP\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\MCP\Events\ModelContextViolated;
use Modules\MCP\Services\MCPServer;

class ValidateModelContext implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $model
    ) {
    }

    public function handle(MCPServer $mcp): void
    {
        $violations = $mcp->validateModelContext($this->model);

        if (!empty($violations)) {
            event(new ModelContextViolated($this->model, $violations));
        }
    }
}
