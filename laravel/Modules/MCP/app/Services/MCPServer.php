<?php

declare(strict_types=1);

namespace Modules\MCP\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class MCPServer
{
    protected array $config;
    protected array $servers = [];
    protected array $contexts = [];

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->initializeServers();
        $this->loadContexts();
    }

    protected function initializeServers(): void
    {
        foreach ($this->config['mcpServers'] as $name => $server) {
            $this->servers[$name] = $this->createServer($name, $server);
        }
    }

    protected function createServer(string $name, array $config): object
    {
        return match ($name) {
            'filesystem' => new FileSystemServer($config),
            'fetch' => new FetchServer($config),
            'memory' => new MemoryServer($config),
            'everything' => new EverythingServer($config),
            default => throw new \InvalidArgumentException("Server MCP non supportato: {$name}")
        };
    }

    protected function loadContexts(): void
    {
        $contextPath = base_path('laravel/Modules/MCP/contexts');
        if (File::exists($contextPath)) {
            foreach (File::files($contextPath) as $file) {
                $context = json_decode(File::get($file->getPathname()), true);
                $this->contexts[$file->getBasename('.json')] = $context;
            }
        }
    }

    public function getServer(string $name): object
    {
        if (!isset($this->servers[$name])) {
            throw new \InvalidArgumentException("Server MCP non trovato: {$name}");
        }
        return $this->servers[$name];
    }

    public function getContext(string $name): array
    {
        if (!isset($this->contexts[$name])) {
            throw new \InvalidArgumentException("Contesto non trovato: {$name}");
        }
        return $this->contexts[$name];
    }

    public function validateModelContext(string $modelClass, string $contextName): array
    {
        $context = $this->getContext($contextName);
        $violations = [];

        if (!class_exists($modelClass)) {
            return ['Modello non trovato: ' . $modelClass];
        }

        $reflection = new \ReflectionClass($modelClass);

        // Verifica estensione
        if (isset($context['extends']) && !$reflection->isSubclassOf($context['extends'])) {
            $violations[] = "Modello {$modelClass} deve estendere {$context['extends']}";
        }

        // Verifica trait
        if (isset($context['traits'])) {
            foreach ($context['traits'] as $trait) {
                if (!in_array($trait, $reflection->getTraitNames())) {
                    $violations[] = "Modello {$modelClass} deve utilizzare il trait {$trait}";
                }
            }
        }

        // Verifica relazioni
        if (isset($context['relationships'])) {
            foreach ($context['relationships'] as $relation) {
                if (!$reflection->hasMethod($relation)) {
                    $violations[] = "Modello {$modelClass} deve implementare la relazione {$relation}";
                }
            }
        }

        // Verifica validazioni
        if (isset($context['validations'])) {
            foreach ($context['validations'] as $validation) {
                if (!$reflection->hasMethod($validation)) {
                    $violations[] = "Modello {$modelClass} deve implementare la validazione {$validation}";
                }
            }
        }

        return $violations;
    }

    public function getModelContext(string $modelClass): ?array
    {
        foreach ($this->contexts as $name => $context) {
            if (isset($context['models']) && in_array($modelClass, $context['models'])) {
                return $context;
            }
        }
        return null;
    }

    public function getRelatedModels(string $modelClass): array
    {
        $context = $this->getModelContext($modelClass);
        if (!$context || !isset($context['relationships'])) {
            return [];
        }

        $related = [];
        foreach ($context['relationships'] as $relation) {
            if (isset($this->contexts[$relation])) {
                $related[] = $relation;
            }
        }

        return $related;
    }
}
