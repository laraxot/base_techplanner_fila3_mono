<?php

declare(strict_types=1);

use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');

?>

<x-layouts.guest-agid>
    <x-slot name="title">
        Accesso - {{ config('app.name') }}
    </x-slot>

    <!-- Login Card AGID-Compliant -->
    <x-blocks.forms.login-card-agid 
        title="Accedi ai servizi digitali"
        subtitle="Utilizza le tue credenziali per accedere all'area riservata dei servizi online"
        livewire-component="\Modules\User\Http\Livewire\Auth\Login"
    />
</x-layouts.guest-agid>
