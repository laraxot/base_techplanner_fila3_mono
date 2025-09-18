<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use WireElements\Pro\Components\Spotlight\Actions\DispatchEvent;
use WireElements\Pro\Components\Spotlight\Actions\JumpTo;
use WireElements\Pro\Components\Spotlight\Actions\ReplaceQuery;

class SpotlightServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap Spotlight component.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSpotlightLivewireComponent();
        $this->registerSpotlightDefaultActions();
        $this->registerSpotlightDefaultGroups();
    }

    protected function registerSpotlightLivewireComponent(): void
    {
        Livewire::component('spotlight-pro', Spotlight::class);
    }

    protected function registerSpotlightDefaultActions(): void
    {
        Spotlight::setup(function () {
            Spotlight::registerAction('jump_to', JumpTo::class);
            Spotlight::registerAction('replace_query', ReplaceQuery::class);
            Spotlight::registerAction('emit_event', DispatchEvent::class);
            Spotlight::registerAction('dispatch_event', DispatchEvent::class);
        }, 'default_actions');
    }

    protected function registerSpotlightDefaultGroups(): void
    {
        Spotlight::setup(function () {
            Spotlight::registerGroup('results', __('Results'));
        }, 'default_groups');
    }
}
