<?php

declare(strict_types=1);

/**
 * Script to fix PSR-4 autoloading compliance for test classes
 * Adds proper namespaces to test files that are missing them
 */

$basePath = __DIR__ . '/laravel/Modules';

// Define the modules and their test directories
$modules = [
    'Xot', 'Media', 'Employee', 'Cms', 'TechPlanner', 'Notify', 'UI', 'User', 'Activity', 'Job'
];

function addNamespaceToFile(string $filePath, string $namespace): bool
{
    $content = file_get_contents($filePath);
    if ($content === false) {
        echo "Failed to read file: $filePath\n";
        return false;
    }

    // Check if namespace already exists
    if (strpos($content, "namespace $namespace") !== false) {
        echo "Namespace already exists in: $filePath\n";
        return true;
    }

    // Find the position after declare(strict_types=1);
    $pattern = '/(<\?php\s*declare\s*\(\s*strict_types\s*=\s*1\s*\)\s*;\s*)/';
    if (preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
        $insertPosition = $matches[0][1] + strlen($matches[0][0]);
        
        // Insert namespace after declare statement
        $newContent = substr($content, 0, $insertPosition) . 
                     "\n\nnamespace $namespace;\n" . 
                     substr($content, $insertPosition);
        
        // Update use statements to use proper TestCase if needed
        $newContent = str_replace('use Tests\TestCase;', "use $namespace\TestCase;", $newContent);
        
        if (file_put_contents($filePath, $newContent) !== false) {
            echo "Added namespace to: $filePath\n";
            return true;
        } else {
            echo "Failed to write file: $filePath\n";
            return false;
        }
    } else {
        echo "Could not find declare statement in: $filePath\n";
        return false;
    }
}

function getNamespaceFromPath(string $filePath, string $basePath): string
{
    $relativePath = str_replace($basePath . '/', '', $filePath);
    $parts = explode('/', $relativePath);
    
    // Remove filename
    array_pop($parts);
    
    // Convert to namespace format
    $namespace = 'Modules\\' . implode('\\', array_map('ucfirst', $parts));
    
    // Replace 'tests' with 'Tests' for PSR-4 compliance
    $namespace = str_replace('\\tests\\', '\\Tests\\', $namespace);
    $namespace = str_replace('\\tests', '\\Tests', $namespace);
    
    return $namespace;
}

// Process each module
foreach ($modules as $module) {
    $moduleTestPath = "$basePath/$module/tests";
    
    if (!is_dir($moduleTestPath)) {
        echo "Test directory not found for module: $module\n";
        continue;
    }
    
    echo "Processing module: $module\n";
    
    // Find all PHP files in tests directory
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($moduleTestPath)
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $filePath = $file->getPathname();
            $namespace = getNamespaceFromPath($filePath, $basePath);
            
            addNamespaceToFile($filePath, $namespace);
        }
    }
}

echo "PSR-4 namespace fixing completed!\n";
