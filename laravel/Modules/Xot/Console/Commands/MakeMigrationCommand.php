<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Helpers\PathHelper;

class MakeMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xot:make-migration
                            {name : The name of the migration}
                            {--module= : The name of the module}
                            {--table= : The name of the table}
                            {--create : Create a new table}
                            {--update : Update an existing table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration following project standards';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $module = $this->option('module');
        $table = $this->option('table') ?? Str::snake(Str::pluralStudly(class_basename($name)));
        $create = $this->option('create');
        $update = $this->option('update');
        
        if (!$module) {
            $this->error('Module name is required');
            return Command::FAILURE;
        }
        
        // Verifica se il modulo esiste
        if (!PathHelper::moduleExists($module)) {
            $this->error("Module [{$module}] does not exist");
            return Command::FAILURE;
        }
        
        $modulePath = PathHelper::modulePath($module);
        
        // Crea la directory delle migrazioni se non esiste
        $migrationsPath = PathHelper::migrationsPath($module);
        if (!File::exists($migrationsPath)) {
            File::makeDirectory($migrationsPath, 0755, true);
        }
        
        // Genera il nome del file di migrazione
        $timestamp = date('Y_m_d_His');
        $filename = "{$timestamp}_{$name}.php";
        $path = "{$migrationsPath}/{$filename}";
        
        // Ottieni il contenuto del template
        $stubPath = PathHelper::modulePath('Xot') . '/stubs/migration.stub';
        if (!File::exists($stubPath)) {
            $this->error('Migration stub not found');
            return Command::FAILURE;
        }
        
        $stub = File::get($stubPath);
        
        // Sostituisci i placeholder
        $stub = str_replace('$TABLE_NAME$', $table, $stub);
        $description = $create ? "creazione della tabella {$table}" : ($update ? "aggiornamento della tabella {$table}" : "migrazione per {$table}");
        $stub = str_replace('$DESCRIPTION$', $description, $stub);
        
        // Se è un aggiornamento, rimuovi la sezione tableCreate
        if ($update) {
            $stub = preg_replace('/\s*\/\/ -- CREATE --\s*\$this->tableCreate\(\s*static function \(Blueprint \$table\): void \{\s*.*?\s*\}\s*\);\s*/s', '', $stub);
        }
        
        // Se è una creazione, rimuovi la sezione tableUpdate
        if ($create) {
            $stub = preg_replace('/\s*\/\/ -- UPDATE --\s*\$this->tableUpdate\(\s*function \(Blueprint \$table\): void \{\s*.*?\s*\}\s*\);\s*/s', '', $stub);
        }
        
        // Scrivi il file di migrazione
        File::put($path, $stub);
        
        $this->info("Migration [{$filename}] created successfully");
        
        // Mostra la checklist
        $this->info('');
        $this->info('Migration Checklist:');
        $this->info('- [ ] Ho documentato la struttura della tabella');
        $this->info('- [ ] Ho verificato se la tabella esiste già');
        $this->info('- [ ] Ho identificato il database corretto per la tabella');
        $this->info('- [ ] Ho specificato la connessione corretta nel modello');
        $this->info('- [ ] Ho gestito correttamente le relazioni tra tabelle in database diversi');
        $this->info('');
        $this->info('See /docs/migration-checklist.md for more details');
        
        return Command::SUCCESS;
    }
}
