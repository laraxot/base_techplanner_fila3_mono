<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionMethod;

class ContextValidator
{
    protected array $rules;
    protected array $violations = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function checkModelContext(string $modelClass): array
    {
        $this->violations = [];

        if (!class_exists($modelClass)) {
            return ['Modello non trovato: ' . $modelClass];
        }

        $reflection = new ReflectionClass($modelClass);
        $this->checkModelClass($reflection);
        $this->checkModelMethods($reflection);
        $this->checkModelRelationships($reflection);

        return $this->violations;
    }

    protected function checkModelClass(ReflectionClass $reflection): void
    {
        $mustExtend = $this->rules['models']['must_extend'];
        if (!$reflection->isSubclassOf($mustExtend)) {
            $this->violations[] = "Modello {$reflection->getName()} deve estendere {$mustExtend}";
        }
    }

    protected function checkModelMethods(ReflectionClass $reflection): void
    {
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            // Verifica metodi vietati
            if (in_array($method->getName(), $this->rules['models']['forbidden_methods'])) {
                $this->violations[] = "Metodo vietato {$method->getName()} in {$reflection->getName()}";
            }

            // Verifica metodi richiesti
            if (in_array($method->getName(), $this->rules['models']['required_methods'])) {
                if (!$reflection->hasMethod($method->getName())) {
                    $this->violations[] = "Metodo richiesto {$method->getName()} mancante in {$reflection->getName()}";
                }
            }
        }
    }

    protected function checkModelRelationships(ReflectionClass $reflection): void
    {
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            if ($this->isRelationshipMethod($method)) {
                $this->checkRelationshipMethod($method);
            }
        }
    }

    protected function isRelationshipMethod(ReflectionMethod $method): bool
    {
        $returnType = $method->getReturnType();
        if (!$returnType) {
            return false;
        }

        $returnTypeName = $returnType->getName();
        return str_contains($returnTypeName, 'Relation') ||
               str_contains($returnTypeName, 'HasOne') ||
               str_contains($returnTypeName, 'HasMany') ||
               str_contains($returnTypeName, 'BelongsTo') ||
               str_contains($returnTypeName, 'BelongsToMany');
    }

    protected function checkRelationshipMethod(ReflectionMethod $method): void
    {
        $mustUse = $this->rules['relationships']['must_use'];
        $returnType = $method->getReturnType();

        if ($returnType && !$returnType->getName() instanceof $mustUse) {
            $this->violations[] = "Relazione {$method->getName()} deve utilizzare {$mustUse}";
        }

        // Verifica metodi vietati nelle relazioni
        if (in_array($method->getName(), $this->rules['relationships']['forbidden_methods'])) {
            $this->violations[] = "Metodo vietato {$method->getName()} nella relazione";
        }

        // Verifica metodi richiesti nelle relazioni
        if (in_array($method->getName(), $this->rules['relationships']['required_methods'])) {
            if (!$method->getDeclaringClass()->hasMethod($method->getName())) {
                $this->violations[] = "Metodo richiesto {$method->getName()} mancante nella relazione";
            }
        }
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}
