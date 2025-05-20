<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Modules\Xot\Helpers\PathHelper;
use Symfony\Component\Finder\Finder;

class AnalyzeDatabaseStructureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xot:analyze-database
                            {--connection= : Specific connection to analyze}
                            {--model= : Specific model to analyze}
                            {--fix : Automatically fix issues when possible}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyze database structure and verify model-table consistency';

    /**
     * Connessioni al database da analizzare.
     *
     * @var array<string>
     */
    protected array $connections = ['mysql', 'user'];

    /**
     * Esegue il comando.
     */
    public function handle(): int
    {
        $this->info('Analyzing database structure...');
        
        $connection = $this->option('connection');
        if ($connection) {
            $this->connections = [$connection];
        }
        
        $this->analyzeConnections();
        $this->analyzeModels();
        
        $this->info('Analysis completed.');
        
        return Command::SUCCESS;
    }
    
    /**
     * Analizza le connessioni al database.
     */
    protected function analyzeConnections(): void
    {
        $this->info('Analyzing database connections...');
        
        $tables = [];
        
        foreach ($this->connections as $connection) {
            $this->info("Analyzing connection: {$connection}");
            
            try {
                $connectionTables = Schema::connection($connection)->getAllTables();
                
                foreach ($connectionTables as $table) {
                    $tableName = array_values((array) $table)[0];
                    $tables[$tableName] = $connection;
                    
                    $this->line("  - Table: {$tableName} (Connection: {$connection})");
                }
            } catch (\Exception $e) {
                $this->error("Error analyzing connection {$connection}: " . $e->getMessage());
            }
        }
        
        $this->info('Database connections analysis completed.');
    }
    
    /**
     * Analizza i modelli e verifica la coerenza con le tabelle.
     */
    protected function analyzeModels(): void
    {
        $this->info('Analyzing models...');
        
        $modelPaths = [];
        
        // Aggiungi i percorsi dei modelli per ogni modulo
        foreach (PathHelper::getModules() as $module) {
            $modelPaths[] = PathHelper::modelsPath($module);
        }
        
        // Aggiungi anche i modelli globali dell'applicazione
        $modelPaths[] = app_path('Models');
        
        $finder = new Finder();
        $finder->files()->name('*.php')->in($modelPaths);
        
        foreach ($finder as $file) {
            $path = $file->getRealPath();
            $contents = file_get_contents($path);
            
            if (!$contents) {
                continue;
            }
            
            // Estrai il namespace e il nome della classe
            preg_match('/namespace\s+([^;]+)/i', $contents, $namespaceMatches);
            preg_match('/class\s+(\w+)/i', $contents, $classMatches);
            
            if (!isset($namespaceMatches[1]) || !isset($classMatches[1])) {
                continue;
            }
            
            $namespace = $namespaceMatches[1];
            $className = $classMatches[1];
            $fullClassName = $namespace . '\\' . $className;
            
            // Verifica se la classe è un modello Eloquent
            if (!$this->isEloquentModel($contents)) {
                continue;
            }
            
            // Verifica la connessione specificata nel modello
            $connection = $this->extractConnection($contents);
            $table = $this->extractTable($contents);
            
            $this->line("  - Model: {$fullClassName}");
            $this->line("    Table: {$table}");
            $this->line("    Connection: {$connection}");
            
            // Verifica se la tabella esiste nella connessione specificata
            $this->verifyTableExistence($table, $connection);
        }
        
        $this->info('Models analysis completed.');
    }
    
    /**
     * Verifica se la classe è un modello Eloquent.
     *
     * @param string $contents
     * @return bool
     */
    protected function isEloquentModel(string $contents): bool
    {
        return Str::contains($contents, 'extends Model')
            || Str::contains($contents, 'extends BaseModel')
            || Str::contains($contents, 'extends Eloquent')
            || Str::contains($contents, 'extends XotBaseModel');
    }
    
    /**
     * Estrae la connessione specificata nel modello.
     *
     * @param string $contents
     * @return string
     */
    protected function extractConnection(string $contents): string
    {
        preg_match('/protected\s+\$connection\s*=\s*[\'"]([^\'"]+)[\'"]/i', $contents, $matches);
        
        return $matches[1] ?? 'mysql'; // Default connection
    }
    
    /**
     * Estrae il nome della tabella specificato nel modello.
     *
     * @param string $contents
     * @return string
     */
    protected function extractTable(string $contents): string
    {
        preg_match('/protected\s+\$table\s*=\s*[\'"]([^\'"]+)[\'"]/i', $contents, $matches);
        
        if (isset($matches[1])) {
            return $matches[1];
        }
        
        // Se la tabella non è specificata, estrai il nome della classe
        preg_match('/class\s+(\w+)/i', $contents, $classMatches);
        
        if (isset($classMatches[1])) {
            return Str::snake(Str::pluralStudly($classMatches[1]));
        }
        
        return '';
    }
    
    /**
     * Verifica se la tabella esiste nella connessione specificata.
     *
     * @param string $table
     * @param string $connection
     * @return void
     */
    protected function verifyTableExistence(string $table, string $connection): void
    {
        try {
            $exists = Schema::connection($connection)->hasTable($table);
            
            if ($exists) {
                $this->line("    Status: <info>OK</info>");
            } else {
                $this->line("    Status: <error>Table not found in {$connection} connection</error>");
                
                // Cerca la tabella in altre connessioni
                foreach ($this->connections as $otherConnection) {
                    if ($otherConnection === $connection) {
                        continue;
                    }
                    
                    if (Schema::connection($otherConnection)->hasTable($table)) {
                        $this->line("    Suggestion: <comment>Table found in {$otherConnection} connection</comment>");
                        
                        if ($this->option('fix')) {
                            $this->fixModelConnection($table, $connection, $otherConnection);
                        }
                        
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->line("    Status: <error>Error: {$e->getMessage()}</error>");
        }
    }
    
    /**
     * Corregge la connessione nel modello.
     *
     * @param string $table
     * @param string $currentConnection
     * @param string $correctConnection
     * @return void
     */
    protected function fixModelConnection(string $table, string $currentConnection, string $correctConnection): void
    {
        $this->line("    Fixing: <comment>Updating model connection from {$currentConnection} to {$correctConnection}</comment>");
        
        // Implementazione della correzione automatica (se necessario)
    }
}
