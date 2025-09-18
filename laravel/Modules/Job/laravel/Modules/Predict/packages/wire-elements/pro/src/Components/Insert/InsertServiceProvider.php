<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Livewire\Livewire;

class InsertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap Insert component.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerInsertLivewireComponent();
        $this->registerInsertComponentDirective();
    }

    protected function registerInsertLivewireComponent(): void
    {
        Livewire::component('insert-pro', Insert::class);
    }

    protected function registerInsertComponentDirective(): void
    {
        Blade::directive('insert', function ($types) {
            $types = Str::of($types)
                ->explode(',')
                ->map(fn ($s) => Str::of($s)->replace(["'", '"'], '')->squish())
                ->toJson();

            return sprintf(
                '%s;',
                'x-data="SupportsWepInsert({ types: '.e($types).' })" x-bind="insertInput"'
            );
        });
    }
}
