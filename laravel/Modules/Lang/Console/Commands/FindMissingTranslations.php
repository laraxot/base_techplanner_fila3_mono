<?php

namespace Modules\Lang\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FindMissingTranslations extends Command
{
    protected $signature = 'translations:missing 
                            {locale : The locale to check for missing translations}
                            {--path= : Path to scan for translations}
                            {--json : Output as JSON}';

    protected $description = 'Find missing translations in the application';

    public function handle()
    {
        $locale = $this->argument('locale');
        $path = $this->option('path') ?: app()->langPath("$locale");
        
        if (!File::exists($path)) {
            $this->error("Translation directory not found: {$path}");
            return 1;
        }

        $missing = $this->findMissingTranslations($path, $locale);
        
        if ($this->option('json')) {
            $this->output->write(json_encode($missing, JSON_PRETTY_PRINT));
            return 0;
        }

        if (empty($missing)) {
            $this->info("No missing translations found in {$locale}.");
            return 0;
        }

        $this->info("Missing translations in {$locale}:");
        $this->table(['Key', 'File', 'Occurrences'], $missing);
        
        return 0;
    }

    protected function findMissingTranslations($path, $locale)
    {
        $missing = [];
        $files = $this->getPhpFiles($path);
        
        foreach ($files as $file) {
            $relativePath = Str::after($file, $path . DIRECTORY_SEPARATOR);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '.', $relativePath);
            $namespace = str_replace('.php', '', $relativePath);
            
            $translations = require $file;
            $missing = array_merge(
                $missing,
                $this->checkArrayForMissing($translations, $namespace, $file)
            );
        }
        
        return $missing;
    }
    
    protected function checkArrayForMissing($array, $namespace, $file, $parentKey = '')
    {
        $missing = [];
        
        foreach ($array as $key => $value) {
            $currentKey = $parentKey ? "{$parentKey}.{$key}" : $key;
            
            if (is_array($value)) {
                $missing = array_merge(
                    $missing,
                    $this->checkArrayForMissing($value, $namespace, $file, $currentKey)
                );
            } elseif ($value === '' || $value === null) {
                $missing[] = [
                    'key' => $namespace . '.' . $currentKey,
                    'file' => $file,
                    'occurrences' => $this->findOccurrences($namespace . '.' . $currentKey)
                ];
            }
        }
        
        return $missing;
    }
    
    protected function findOccurrences($key)
    {
        $pattern = "__('" . str_replace('.', '\\.', $key) . "')";
        $command = "grep -r \"{$pattern}\" " . base_path() . " --include=\"*.php\" --include=\"*.blade.php\"";
        
        try {
            $result = shell_exec($command);
            return $result ? count(explode("\n", trim($result))) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    protected function getPhpFiles($path)
    {
        return File::allFiles($path, function ($file) {
            return $file->getExtension() === 'php' && 
                   $file->getFilename() !== 'validation.php';
        });
    }
}
