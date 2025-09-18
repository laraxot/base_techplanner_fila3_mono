<?php

declare(strict_types=1);

?>
<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Test Invio Email
        </x-slot>

        <x-slot name="description">
            Utilizza questo form per testare l'invio di email tramite diversi provider e configurazioni.
        </x-slot>

        
        <x-filament-panels::form wire:submit="sendEmail()">
            {{ $this->emailForm }}
            {{ $error_message ?? '--' }}
            <x-filament-panels::form.actions :actions="$this->getEmailFormActions()" />
    
            <x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="sendEmail()"/>
    
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-panels::page>
