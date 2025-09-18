<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\SlideOver;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use WireElements\Pro\Components\SlideOver\Foundation\SlideOver;

class SlideOverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap Slide-over component.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSlideOverLivewireComponent();
    }

    protected function registerSlideOverLivewireComponent(): void
    {
        Livewire::component('slide-over-pro', SlideOver::class);
    }
}
