<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\MCPServer;

class ValidateModelsBatchCommand extends Command
{
    protected $signature = 'mcp:validate-batch {--model= : Nome del modello da verificare} {--batch-size=100 : Dimensione del batch}';
    protected $description = 'Verifica in batch il contesto dei modelli';

    public function handle(MCPServer $mcp): int
    {
        $model = $this->option('model');
        $batchSize = (int) $this->option('batch-size');

        if ($model) {
            $this->info("Avvio della validazione in batch per il modello {$model}...");
            $this->validateModel($mcp, $model);
            return 0;
        }

        $this->info('Avvio della validazione in batch per tutti i modelli...');
        $models = $mcp->getAllModels();
        $batches = array_chunk($models, $batchSize);

        foreach ($batches as $index => $batch) {
            $this->info("Elaborazione batch " . ($index + 1) . " di " . count($batches) . "...");

            foreach ($batch as $model) {
                $this->validateModel($mcp, $model);
            }
        }

        $this->info('Validazione in batch completata.');
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
