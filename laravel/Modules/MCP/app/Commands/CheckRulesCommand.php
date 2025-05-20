<?php

declare(strict_types=1);

namespace Modules\MCP\Commands;

use Illuminate\Console\Command;
use Modules\MCP\Services\RuleValidator;
use Illuminate\Support\Facades\File;

class CheckRulesCommand extends Command
{
    protected $signature = 'mcp:check {--path= : Percorso specifico da controllare}';
    protected $description = 'Verifica le regole MCP nel progetto';

    public function handle(RuleValidator $validator): int
    {
        $this->info('Verifica regole MCP in corso...');

        $path = $this->option('path') ?? base_path('laravel/Modules');
        $violations = $this->checkDirectory($validator, $path);

        if (empty($violations)) {
            $this->info('✅ Tutte le regole sono rispettate!');
            return 0;
        }

        $this->error('❌ Violazioni trovate:');
        foreach ($violations as $file => $fileViolations) {
            $this->line("\nFile: {$file}");
            foreach ($fileViolations as $violation) {
                $this->line("- {$violation}");
            }
        }

        return 1;
    }

    protected function checkDirectory(RuleValidator $validator, string $path): array
    {
        $violations = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $fileViolations = $validator->checkFile($file->getPathname());
            if (!empty($fileViolations)) {
                $violations[$file->getRelativePathname()] = $fileViolations;
            }
        }

        return $violations;
    }
}
