<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt;
use Modules\Xot\Datas\XotData;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $xot = XotData::make();
        Volt::mount([
            $xot->getPubThemeViewPath('livewire'),
            $xot->getPubThemeViewPath('pages'),
            // config('livewire.view_path', resource_path('views/livewire')),
            // resource_path('views/pages'),
        ]);
    }
}
