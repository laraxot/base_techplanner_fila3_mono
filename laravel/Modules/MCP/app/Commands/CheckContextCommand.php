<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\ContextValidator;
use Illuminate\Support\Facades\File;

class CheckContextCommand extends Command
{
    protected $signature = 'mcp:check-context {--path= : Percorso specifico da controllare}';
    protected $description = 'Verifica il contesto dei modelli nel progetto';

    public function handle(ContextValidator $validator): int
    {
        $this->info('Verifica contesto modelli in corso...');

        $path = $this->option('path') ?? base_path('laravel/Modules');
        $violations = $this->checkDirectory($validator, $path);

        if (empty($violations)) {
            $this->info('✅ Tutti i modelli rispettano il contesto!');
            return 0;
        }

        $this->error('❌ Violazioni di contesto trovate:');
        foreach ($violations as $model => $modelViolations) {
            $this->line("\nModello: {$model}");
            foreach ($modelViolations as $violation) {
                $this->line("- {$violation}");
            }
        }

        return 1;
    }

    protected function checkDirectory(ContextValidator $validator, string $path): array
    {
        $violations = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $content = file_get_contents($file->getPathname());
            if (preg_match('/namespace\s+([^;]+);.*?class\s+(\w+)/s', $content, $matches)) {
                $className = $matches[1] . '\\' . $matches[2];

                if (class_exists($className)) {
                    $reflection = new \ReflectionClass($className);
                    if ($reflection->isSubclassOf('Illuminate\Database\Eloquent\Model')) {
                        $modelViolations = $validator->checkModelContext($className);
                        if (!empty($modelViolations)) {
                            $violations[$className] = $modelViolations;
                        }
                    }
                }
            }
        }

        return $violations;
    }
}
