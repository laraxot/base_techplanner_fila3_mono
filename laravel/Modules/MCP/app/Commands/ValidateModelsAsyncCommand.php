<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Jobs\ValidateModelContext;
use Modules\MCP\Services\MCPServer;

class ValidateModelsAsyncCommand extends Command
{
    protected $signature = 'mcp:validate-async {--model= : Nome del modello da verificare}';
    protected $description = 'Verifica asincronamente il contesto dei modelli';

    public function handle(MCPServer $mcp): int
    {
        $model = $this->option('model');

        if ($model) {
            $this->info("Avvio della validazione asincrona per il modello {$model}...");
            ValidateModelContext::dispatch($model);
            $this->info('Job di validazione inviato alla coda.');
            return 0;
        }

        $this->info('Avvio della validazione asincrona per tutti i modelli...');
        $models = $mcp->getAllModels();

        foreach ($models as $model) {
            ValidateModelContext::dispatch($model);
            $this->line("Job di validazione inviato per {$model}");
        }

        $this->info('Tutti i job di validazione sono stati inviati alla coda.');
        return 0;
    }
}
