<?php

declare(strict_types=1);

namespace Modules\MCP\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\MCP\Services\ContextValidator;
use Modules\MCP\Commands\CheckContextCommand;
use Modules\MCP\Commands\UpdateContextCommand;
use Modules\MCP\Commands\ShowContextViolationsCommand;
use Modules\MCP\Commands\FixContextCommand;

class MCPServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadContextRules();
        $this->registerCommands();
        $this->setupValidation();
    }

    protected function loadContextRules(): void
    {
        $rules = $this->getContextRules();
        config(['mcp.context_rules' => $rules]);
    }

    protected function registerCommands(): void
    {
        $this->commands([
            CheckContextCommand::class,
            UpdateContextCommand::class,
            ShowContextViolationsCommand::class,
            FixContextCommand::class,
        ]);
    }

    protected function setupValidation(): void
    {
        $this->app->singleton(ContextValidator::class, function ($app) {
            return new ContextValidator(config('mcp.context_rules'));
        });
    }

    protected function getContextRules(): array
    {
        return [
            'models' => [
                'must_extend' => 'XotBaseModel',
                'forbidden_methods' => ['save', 'delete'],
                'required_methods' => ['getContext'],
            ],
            'relationships' => [
                'must_use' => 'XotBaseRelationship',
                'forbidden_methods' => ['create', 'update'],
                'required_methods' => ['validateContext'],
            ],
            'context' => [
                'required_files' => ['context.php'],
                'forbidden_direct_access' => true,
            ],
        ];
    }
}
