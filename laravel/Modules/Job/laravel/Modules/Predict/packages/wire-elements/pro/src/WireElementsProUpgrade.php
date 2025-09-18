<?php

declare(strict_types=1);

namespace WireElements\Pro;

use Livewire\Features\SupportConsoleCommands\Commands\Upgrade\UpgradeStep;
use Livewire\Features\SupportConsoleCommands\Commands\UpgradeCommand;

class WireElementsProUpgrade extends UpgradeStep
{
    public function handle(UpgradeCommand $console, \Closure $next)
    {
        $this->interactiveReplacement(
            console: $console,
            title: 'The $dispatch helper expects named arguments.',
            before: '$dispatch(\'modal.open\', \'component-name\', {user: 1})',
            after: '$dispatch(\'modal.open\', {component: \'component-name\', arguments: {user: 1}})',
            pattern: '/\$(?:dispatch|emit)\(\'modal\.open\'(?:,\s?)([^,|\)]*)(?:,\s?)?((?:(?:.|\s)*?).*)\)/',
            replacement: function ($matches) {
                $component = $matches[1];
                $arguments = $matches[2];
                if (empty($arguments)) {
                    return "\$dispatch('modal.open', { component: $component })";
                }

                return "\$dispatch('modal.open', { component: $component, arguments: $arguments })";
            },
            directories: 'resources'
        );

        $this->interactiveReplacement(
            console: $console,
            title: 'The Livewire.dispatch helper expects named arguments.',
            before: 'Livewire.dispatch(\'modal.open\', \'component-name\', {user: 1})',
            after: 'Livewire.dispatch(\'modal.open\', {component: \'component-name\', arguments: {user: 1}})',
            pattern: '/Livewire.(?:dispatch|emit)\(\'modal\.open\'(?:,\s?)([^,|\)]*)(?:,\s?)?((?:(?:.|\s)*?).*)\)/',
            replacement: function ($matches) {
                $component = $matches[1];
                $arguments = $matches[2];
                if (empty($arguments)) {
                    return "Livewire.dispatch('modal.open', { component: $component })";
                }

                return "Livewire.dispatch('modal.open', { component: $component, arguments: $arguments })";
            },
            directories: 'resources'
        );

        $this->interactiveReplacement(
            console: $console,
            title: 'The $this->dispatch helper expects named arguments.',
            before: "\$this->dispatch('modal.open', 'component-name', ['user' => 1])",
            after: "\$this->dispatch('modal.open', component: 'component-name', arguments: ['user' => 1]])",
            pattern: '/\$this->(?:dispatch|emit)\(\'modal\.open\'(?:,\s?)([^,|\)]*)(?:,\s?)?((?:(?:.|\s)*?).*)\)/',
            replacement: function ($matches) {
                $component = $matches[1];
                $arguments = $matches[2];
                if (empty($arguments)) {
                    return "\$this->dispatch('modal.open', component: $component)";
                }

                return "\$this->dispatch('modal.open', component: $component, arguments: $arguments)";
            },
            directories: 'app'
        );

        $this->patternReplacement(
            pattern: '/\$emit\(\'modal\.close\'\)/',
            replacement: "\$dispatch('modal.close')",
            directories: 'resources'
        );

        return $next($console);
    }
}
