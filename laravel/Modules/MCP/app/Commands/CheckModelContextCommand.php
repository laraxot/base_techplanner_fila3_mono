<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\MCPServer;

class CheckModelContextCommand extends Command
{
    protected $signature = 'mcp:check-model {model? : Nome del modello da verificare}';
    protected $description = 'Verifica il contesto di un modello';

    public function handle(MCPServer $mcp): int
    {
        $model = $this->argument('model');

        if ($model) {
            return $this->checkSingleModel($mcp, $model);
        }

        return $this->checkAllModels($mcp);
    }

    protected function checkSingleModel(MCPServer $mcp, string $model): int
    {
        $this->info("Verifica del contesto per il modello {$model}...");

        $violations = $mcp->validateModelContext($model);

        if (empty($violations)) {
            $this->info("✓ Il modello {$model} è valido");
            return 0;
        }

        $this->error("✗ Violazioni trovate per il modello {$model}:");
        foreach ($violations as $violation) {
            $this->line("  - {$violation}");
        }

        return 1;
    }

    protected function checkAllModels(MCPServer $mcp): int
    {
        $this->info('Verifica dei contesti per tutti i modelli...');

        $models = $mcp->getAllModels();
        $hasViolations = false;

        foreach ($models as $model) {
            $violations = $mcp->validateModelContext($model);

            if (empty($violations)) {
                $this->info("✓ {$model}");
                continue;
            }

            $hasViolations = true;
            $this->error("✗ {$model}");
            foreach ($violations as $violation) {
                $this->line("  - {$violation}");
            }
        }

        if (!$hasViolations) {
            $this->info('Tutti i modelli sono validi!');
            return 0;
        }

        return 1;
    }
}
