<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\MCPServer;

class ValidateModelsRealtimeCommand extends Command
{
    protected $signature = 'mcp:validate-realtime {--model= : Nome del modello da verificare}';
    protected $description = 'Verifica in real-time il contesto dei modelli';

    public function handle(MCPServer $mcp): int
    {
        $model = $this->option('model');

        if ($model) {
            $this->info("Avvio della validazione in real-time per il modello {$model}...");
            $this->validateModel($mcp, $model);
            return 0;
        }

        $this->info('Avvio della validazione in real-time per tutti i modelli...');
        $models = $mcp->getAllModels();

        foreach ($models as $model) {
            $this->validateModel($mcp, $model);
        }

        $this->info('Validazione in real-time completata.');
        return 0;
    }

    protected function validateModel(MCPServer $mcp, string $model): void
    {
        $this->line("Validazione del modello {$model}...");

        $violations = $mcp->validateModelContext($model);

        if (empty($violations)) {
            $this->info("✓ {$model}");
            return;
        }

        $this->error("✗ {$model}");
        foreach ($violations as $violation) {
            $this->line("  - {$violation}");
        }
    }
}
