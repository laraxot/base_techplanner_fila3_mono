<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
lament-widgets::widget>
=======
<x-filament-widgets::widget>
>>>>>>> de0f89b5 (.)
=======
<x-filament-widgets::widget>
>>>>>>> 2e199498 (.)
=======
<x-filament-widgets::widget>
>>>>>>> eaeb6531 (.)
    <x-filament::section>
        {{-- Widget content --}}

        <x-filament::button wire:click="begin">Start/Stop</x-filament::button>

        <h1>Time: <span wire:stream="count">{{ $time }}</span></h1>
    </x-filament::section>
</x-filament-widgets::widget>
