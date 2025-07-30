<?php

declare(strict_types=1);

use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');

?>

<x-pub_theme::layouts.main>
    <x-slot name="title">
        {{ __('auth.login.title') }}
    </x-slot>

    <div class="flex flex-col items-center justify-center min-h-screen py-10">
        
        <div class="w-full max-w-md">
            <x-pub_theme::ui.logo class="w-auto h-10 text-gray-700 fill-current dark:text-gray-100 mx-auto mb-6" />

            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">
                {{ __('auth.login.title') }}
            </h2>
            <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>{{ __('auth.login.or') }}</span>
                <x-pub_theme::ui.text-link href="{{ url('/' . app()->getLocale() . '/auth/register') }}">
                    {{ __('auth.login.create_account') }}
                </x-pub_theme::ui.text-link>
            </div>
        </div>

        <div class="mt-8 w-full max-w-md">
            <div class="px-10 py-8 bg-white dark:bg-gray-950/50 border border-gray-200/60 dark:border-gray-200/10 rounded-lg shadow-sm">
                @livewire(\Modules\User\Http\Livewire\Auth\Login::class)
            </div>
        </div>

    </div>
</x-pub_theme::layouts.main>
