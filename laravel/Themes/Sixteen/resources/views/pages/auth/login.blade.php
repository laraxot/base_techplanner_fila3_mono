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

    <!-- Beautiful Login Page Section -->
    <section class="login-page-bg flex items-center justify-center p-4">
        @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
    </section>
</x-layouts.app>
