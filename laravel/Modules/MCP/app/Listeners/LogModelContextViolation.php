<?php

declare(strict_types=1);

namespace Modules\MCP\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\MCP\Events\ModelContextViolated;

class LogModelContextViolation
{
    public function handle(ModelContextViolated $event): void
    {
        Log::warning('Violazione del contesto MCP', [
            'model' => $event->model,
            'violations' => $event->violations,
        ]);
    }
}
