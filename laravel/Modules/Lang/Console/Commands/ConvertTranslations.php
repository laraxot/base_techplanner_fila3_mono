<?php

namespace Modules\Lang\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ConvertTranslations extends Command
{
    protected $signature = 'translations:convert 
                            {from : Current format (php|json)}
                            {to : Target format (php|json)}
                            {locale=it : Locale to convert}
                            {--path= : Custom path to translations}';

    protected $description = 'Convert translation files between PHP and JSON formats';

    public function handle()
    {
        $from = strtolower($this->argument('from'));
        $to = strtolower($this->argument('to'));
        $locale = $this->argument('locale');
        $path = $this->option('path') ?: lang_path($locale);

        if (!in_array($from, ['php', 'json']) || !in_array($to, ['php', 'json'])) {
            $this->error('Invalid format. Use "php" or "json"');
            return 1;
        }

        if ($from === $to) {
            $this->info('Source and target formats are the same. Nothing to do.');
            return 0;
        }

        if (!File::exists($path)) {
            $this->error("Directory not found: {$path}");
            return 1;
        }

        try {
            if ($from === 'php' && $to === 'json') {
                $this->phpToJson($path, $locale);
            } else {
                $this->jsonToPhp($path, $locale);
            }
            
            $this->info('\nConversion completed successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error("Error during conversion: " . $e->getMessage());
            return 1;
        }
    }

    protected function phpToJson($path, $locale)
    {
        $translations = [];
        $files = File::files($path);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php' && $file->getFilename() !== 'validation.php') {
                $key = $file->getFilenameWithoutExtension();
                $translations[$key] = require $file->getPathname();
            }
        }

        // Flatten the array
        $flattened = $this->flattenArray($translations);
        
        // Save to JSON
        $jsonPath = lang_path("{$locale}.json");
        File::put($jsonPath, json_encode($flattened, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        $this->info("Converted PHP files to {$jsonPath}");
    }

    protected function jsonToPhp($path, $locale)
    {
        $jsonFile = lang_path("{$locale}.json");
        
        if (!File::exists($jsonFile)) {
            $this->error("JSON file not found: {$jsonFile}");
            return;
        }

        $translations = json_decode(File::get($jsonFile), true);
        $nested = [];

        foreach ($translations as $key => $value) {
            $this->setNestedValue($nested, $key, $value);
        }

        // Save PHP files
        foreach ($nested as $file => $content) {
            $filePath = lang_path("{$locale}/{$file}.php");
            
            $content = "<?php\n\nreturn " . $this->varExport($content, true) . ";\n";
            File::ensureDirectoryExists(dirname($filePath));
            File::put($filePath, $content);
            
            $this->info("Created: {$filePath}");
        }
    }

    protected function flattenArray($array, $prefix = '')
    {
        $result = [];
        
        foreach ($array as $key => $value) {
            $newKey = $prefix ? "{$prefix}.{$key}" : $key;
            
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenArray($value, $newKey));
            } else {
                $result[$newKey] = $value;
            }
        }
        
        return $result;
    }

    protected function setNestedValue(&$array, $key, $value)
    {
        $keys = explode('.', $key);
        $current = &$array;
        
        foreach ($keys as $k) {
            if (!isset($current[$k])) {
                $current[$k] = [];
            }
            $current = &$current[$k];
        }
        
        $current = $value;
    }
    
    protected function varExport($var, $return = false)
    {
        if (is_array($var)) {
            $toImplode = [];
            $isAssoc = array_keys($var) !== range(0, count($var) - 1);
            
            foreach ($var as $key => $value) {
                $key = $isAssoc ? "\n    '" . addcslashes($key, "'\\") . "' => " : '';
                $toImplode[] = $key . $this->varExport($value, true);
            }
            
            $code = "[" . implode(", ", $toImplode) . "\n]";
            return $code;
        } else {
            $export = var_export($var, true);
            return $export;
        }
    }
}
