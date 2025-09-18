<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Modal;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use WireElements\Pro\Components\Modal\Foundation\Modal;

class ModalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap Modal component.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModalLivewireComponent();
    }

    protected function registerModalLivewireComponent(): void
    {
        Livewire::component('modal-pro', Modal::class);
        Livewire::component('modal-pro-confirmation', ConfirmationModal::class);
    }
}
