<?php

declare(strict_types=1);

namespace Modules\MCP\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelContextViolated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $model,
        public array $violations
    ) {
    }
}
