<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FixPathStructureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xot:fix-path-structure
                            {--dry-run : Mostra solo le operazioni che verrebbero eseguite senza applicarle}
                            {--module= : Corregge solo un modulo specifico}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corregge la struttura dei percorsi spostando i file dalla struttura errata a quella corretta';

    /**
     * Percorso base errato.
     *
     * @var string
     */
    protected string $wrongBasePath = '/var/www/html/saluteora/Modules';

    /**
     * Percorso base corretto.
     *
     * @var string
     */
    protected string $correctBasePath = '/var/www/html/saluteora/laravel/Modules';

    /**
     * Esegue il comando.
     */
    public function handle(): int
    {
        $this->info('Correzione della struttura dei percorsi...');
        
        $dryRun = $this->option('dry-run');
        $module = $this->option('module');
        
        if ($dryRun) {
            $this->info('Modalità dry-run: le operazioni verranno solo mostrate, non applicate.');
        }
        
        if (!File::exists($this->wrongBasePath)) {
            $this->error("Directory errata non trovata: {$this->wrongBasePath}");
            return Command::FAILURE;
        }
        
        $modules = $module 
            ? [$module] 
            : collect(File::directories($this->wrongBasePath))->map(fn($path) => basename($path))->toArray();
        
        $totalFiles = 0;
        $movedFiles = 0;
        
        foreach ($modules as $moduleName) {
            $wrongModulePath = "{$this->wrongBasePath}/{$moduleName}";
            $correctModulePath = "{$this->correctBasePath}/{$moduleName}";
            
            if (!File::exists($wrongModulePath)) {
                $this->error("Modulo non trovato nella struttura errata: {$moduleName}");
                continue;
            }
            
            $this->info("Analisi del modulo: {$moduleName}");
            
            // Ottieni tutti i file nel percorso errato
            $files = $this->getAllFiles($wrongModulePath);
            $totalFiles += count($files);
            
            foreach ($files as $file) {
                $relativePath = Str::after($file, $wrongModulePath);
                $targetPath = $correctModulePath . $relativePath;
                $targetDir = dirname($targetPath);
                
                $this->line("  File: <comment>{$file}</comment>");
                $this->line("    -> <info>{$targetPath}</info>");
                
                if (!$dryRun) {
                    // Crea la directory di destinazione se non esiste
                    if (!File::exists($targetDir)) {
                        File::makeDirectory($targetDir, 0755, true);
                    }
                    
                    // Copia il file nella struttura corretta
                    if (File::copy($file, $targetPath)) {
                        $this->line("    <info>Copiato!</info>");
                        $movedFiles++;
                    } else {
                        $this->line("    <error>Errore durante la copia!</error>");
                    }
                }
            }
        }
        
        if ($totalFiles === 0) {
            $this->info('Nessun file trovato nella struttura errata.');
        } else {
            $this->info("Trovati {$totalFiles} file nella struttura errata.");
            
            if (!$dryRun) {
                $this->info("Copiati {$movedFiles} file nella struttura corretta.");
                $this->info("IMPORTANTE: I file originali nella struttura errata NON sono stati eliminati.");
                $this->info("            Verificare che tutto funzioni correttamente prima di eliminarli manualmente.");
            }
        }
        
        return Command::SUCCESS;
    }
    
    /**
     * Ottiene tutti i file in una directory e nelle sue sottodirectory.
     *
     * @param string $directory
     * @return array<string>
     */
    protected function getAllFiles(string $directory): array
    {
        $files = [];
        
        if (!File::exists($directory)) {
            return $files;
        }
        
        // Ottieni tutti i file nella directory
        foreach (File::files($directory) as $file) {
            $files[] = $file->getPathname();
        }
        
        // Ottieni tutti i file nelle sottodirectory
        foreach (File::directories($directory) as $subDirectory) {
            $files = array_merge($files, $this->getAllFiles($subDirectory));
        }
        
        return $files;
    }
}
