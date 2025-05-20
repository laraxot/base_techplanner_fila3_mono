<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class VerifyPathsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xot:verify-paths
                            {--fix : Tenta di correggere automaticamente i percorsi errati}
                            {--module= : Verifica solo un modulo specifico}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica che i percorsi nel codice siano corretti secondo le convenzioni del progetto';

    /**
     * Percorso base corretto del progetto.
     *
     * @var string
     */
    protected string $correctBasePath = '/var/www/html/saluteora/laravel/Modules/';

    /**
     * Percorsi base errati da cercare.
     *
     * @var array<string>
     */
    protected array $wrongBasePaths = [
        '/var/www/html/saluteora/Modules/',
        '/var/www/html/Modules/',
    ];

    /**
     * Esegue il comando.
     */
    public function handle(): int
    {
        $this->info('Verifica dei percorsi nel codice...');
        
        $module = $this->option('module');
        $fix = $this->option('fix');
        
        $modulesPath = base_path('Modules');
        
        if (!File::exists($modulesPath)) {
            $this->error("Directory dei moduli non trovata: {$modulesPath}");
            return Command::FAILURE;
        }
        
        $modules = $module 
            ? [$module] 
            : collect(File::directories($modulesPath))->map(fn($path) => basename($path))->toArray();
        
        $totalErrors = 0;
        $fixedErrors = 0;
        
        foreach ($modules as $moduleName) {
            $modulePath = "{$modulesPath}/{$moduleName}";
            
            if (!File::exists($modulePath)) {
                $this->error("Modulo non trovato: {$moduleName}");
                continue;
            }
            
            $this->info("Analisi del modulo: {$moduleName}");
            
            $finder = new Finder();
            $finder->files()
                ->name('*.php')
                ->in($modulePath)
                ->exclude(['vendor', 'node_modules']);
            
            foreach ($finder as $file) {
                $path = $file->getRealPath();
                $content = file_get_contents($path);
                
                if (!$content) {
                    continue;
                }
                
                $errors = $this->findPathErrors($content);
                
                if (count($errors) > 0) {
                    $this->line("  File: <comment>{$path}</comment>");
                    
                    foreach ($errors as $error) {
                        $this->line("    - <error>{$error['wrong']}</error> dovrebbe essere <info>{$error['correct']}</info>");
                        $totalErrors++;
                        
                        if ($fix) {
                            $newContent = str_replace($error['wrong'], $error['correct'], $content);
                            
                            if ($newContent !== $content) {
                                File::put($path, $newContent);
                                $this->line("      <info>Corretto!</info>");
                                $fixedErrors++;
                                $content = $newContent;
                            }
                        }
                    }
                }
            }
        }
        
        if ($totalErrors === 0) {
            $this->info('Nessun errore di percorso trovato!');
        } else {
            $this->info("Trovati {$totalErrors} errori di percorso.");
            
            if ($fix) {
                $this->info("Corretti {$fixedErrors} errori.");
            } else {
                $this->info("Esegui il comando con l'opzione --fix per tentare di correggere automaticamente gli errori.");
            }
        }
        
        return Command::SUCCESS;
    }
    
    /**
     * Trova gli errori di percorso nel contenuto.
     *
     * @param string $content
     * @return array<array{wrong: string, correct: string}>
     */
    protected function findPathErrors(string $content): array
    {
        $errors = [];
        
        foreach ($this->wrongBasePaths as $wrongBasePath) {
            // Cerca percorsi errati in stringhe
            preg_match_all('/[\'"](' . preg_quote($wrongBasePath, '/') . '[^\'"]*)[\'"]/i', $content, $matches);
            
            if (isset($matches[1]) && count($matches[1]) > 0) {
                foreach ($matches[1] as $wrongPath) {
                    $correctPath = $this->correctPath($wrongPath);
                    
                    if ($wrongPath !== $correctPath) {
                        $errors[] = [
                            'wrong' => $wrongPath,
                            'correct' => $correctPath,
                        ];
                    }
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Corregge un percorso errato.
     *
     * @param string $path
     * @return string
     */
    protected function correctPath(string $path): string
    {
        foreach ($this->wrongBasePaths as $wrongBasePath) {
            if (Str::startsWith($path, $wrongBasePath)) {
                $relativePath = Str::after($path, $wrongBasePath);
                return $this->correctBasePath . $relativePath;
            }
        }
        
        return $path;
    }
}
