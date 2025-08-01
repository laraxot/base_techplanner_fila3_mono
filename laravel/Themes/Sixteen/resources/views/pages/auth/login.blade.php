<?php

declare(strict_types=1);

use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');

?>

<x-layouts.guest>
    <x-slot name="title">
        {{ __('auth.login.title') }}
    </x-slot>

    <!-- Login Card AGID-Compliant (Componente Corretto) -->
    <x-pub_theme::blocks.forms.login-card 
        title="{{ __('auth.login.title') }}"
        subtitle="{{ __('auth.login.description', ['service' => config('app.name')]) }}"
        livewire-component="\Modules\User\Http\Livewire\Auth\Login"
    />

    <!-- Registration Link (if enabled) -->
    @if (Route::has('register'))
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                {{ __('auth.login.no_account') }}
                <a href="{{ route('register') }}" 
                   class="text-blue-600 hover:text-blue-800 underline font-medium">
                    {{ __('auth.login.create_account') }}
                </a>
            </p>
        </div>
    @endif
</x-layouts.guest>
