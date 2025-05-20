<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionMethod;

class RuleValidator
{
    protected array $rules;
    protected array $violations = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function checkFile(string $filePath): array
    {
        $this->violations = [];

        if (!file_exists($filePath)) {
            return ['File non trovato: ' . $filePath];
        }

        $content = file_get_contents($filePath);
        $className = $this->getClassNameFromFile($content);

        if (!$className) {
            return ['Classe non trovata nel file: ' . $filePath];
        }

        $this->checkClass($className);
        return $this->violations;
    }

    protected function checkClass(string $className): void
    {
        if (!class_exists($className)) {
            $this->violations[] = "Classe non trovata: {$className}";
            return;
        }

        $reflection = new ReflectionClass($className);

        // Verifica estensione per Resources
        if (str_contains($className, '\\Resources\\')) {
            $this->checkResourceClass($reflection);
        }

        // Verifica estensione per Pages
        if (str_contains($className, '\\Pages\\')) {
            $this->checkPageClass($reflection);
        }

        // Verifica estensione per Widgets
        if (str_contains($className, '\\Widgets\\')) {
            $this->checkWidgetClass($reflection);
        }

        // Verifica metodi
        $this->checkMethods($reflection);
    }

    protected function checkResourceClass(ReflectionClass $reflection): void
    {
        $mustExtend = $this->rules['filament']['resources']['must_extend'];
        if (!$reflection->isSubclassOf($mustExtend)) {
            $this->violations[] = "Resource {$reflection->getName()} deve estendere {$mustExtend}";
        }
    }

    protected function checkPageClass(ReflectionClass $reflection): void
    {
        $mustExtend = $this->rules['filament']['pages']['must_extend'];
        if (!$reflection->isSubclassOf($mustExtend)) {
            $this->violations[] = "Page {$reflection->getName()} deve estendere {$mustExtend}";
        }
    }

    protected function checkWidgetClass(ReflectionClass $reflection): void
    {
        $mustExtend = $this->rules['filament']['widgets']['must_extend'];
        if (!$reflection->isSubclassOf($mustExtend)) {
            $this->violations[] = "Widget {$reflection->getName()} deve estendere {$mustExtend}";
        }
    }

    protected function checkMethods(ReflectionClass $reflection): void
    {
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            // Verifica metodi vietati
            if (in_array($method->getName(), $this->rules['filament']['resources']['forbidden_methods'])) {
                $this->violations[] = "Metodo vietato {$method->getName()} in {$reflection->getName()}";
            }

            // Verifica metodi richiesti
            if (in_array($method->getName(), $this->rules['filament']['resources']['required_methods'])) {
                if (!$reflection->hasMethod($method->getName())) {
                    $this->violations[] = "Metodo richiesto {$method->getName()} mancante in {$reflection->getName()}";
                }
            }
        }
    }

    protected function getClassNameFromFile(string $content): ?string
    {
        if (preg_match('/namespace\s+([^;]+);.*?class\s+(\w+)/s', $content, $matches)) {
            return $matches[1] . '\\' . $matches[2];
        }
        return null;
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}
