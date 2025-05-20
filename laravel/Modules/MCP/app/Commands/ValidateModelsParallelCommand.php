<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\MCPServer;
use Spatie\Async\Pool;

class ValidateModelsParallelCommand extends Command
{
    protected $signature = 'mcp:validate-parallel {--model= : Nome del modello da verificare} {--processes=4 : Numero di processi}';
    protected $description = 'Verifica in parallel il contesto dei modelli';

    public function handle(MCPServer $mcp): int
    {
        $model = $this->option('model');
        $processes = (int) $this->option('processes');

        if ($model) {
            $this->info("Avvio della validazione in parallel per il modello {$model}...");
            $this->validateModel($mcp, $model);
            return 0;
        }

        $this->info('Avvio della validazione in parallel per tutti i modelli...');
        $models = $mcp->getAllModels();
        $pool = Pool::create();

        foreach ($models as $model) {
            $pool->add(function () use ($mcp, $model) {
                return $this->validateModel($mcp, $model);
            });
        }

        $results = $pool->wait();
        $this->info('Validazione in parallel completata.');

        return 0;
    }

    protected function validateModel(MCPServer $mcp, string $model): array
    {
        $this->line("Validazione del modello {$model}...");

        $violations = $mcp->validateModelContext($model);

        if (empty($violations)) {
            $this->info("✓ {$model}");
            return ['model' => $model, 'valid' => true];
        }

        $this->error("✗ {$model}");
        foreach ($violations as $violation) {
            $this->line("  - {$violation}");
        }

        return ['model' => $model, 'valid' => false, 'violations' => $violations];
    }
}
