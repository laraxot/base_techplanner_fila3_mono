<?php

declare(strict_types=1);

use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');

?>

<x-layouts.app>
    <x-slot name="title">
        {{ __('Login') }}
    </x-slot>
    @livewire(Modules\User\Filament\Widgets\Auth\LoginWidget::class)
   
</x-layouts.app>
