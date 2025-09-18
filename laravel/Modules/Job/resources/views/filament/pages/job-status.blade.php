<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
lament::page>
=======
<x-filament::page>
>>>>>>> de0f89b5 (.)
=======
<x-filament::page>
>>>>>>> 2e199498 (.)
=======
<x-filament::page>
>>>>>>> eaeb6531 (.)
    <x-filament::section>
        <pre>
        {!! $out !!}
        </pre>
    </x-filament::section>
    <x-filament::section>
        <x-slot name="heading">

        </x-slot>
        @foreach ($acts as $act)
            <x-filament::button wire:click="artisan('{{ $act->name }}')" tooltip="{{ $act->label }}">
                {{ Str::after($act->name, ':') }}
                <x-slot name="badge">
                    {{ Str::before($act->name, ':') }}
                </x-slot>
            </x-filament::button>
            &nbsp;
        @endforeach
    </x-filament::section>
    <x-filament::button wire:click="zibibbo()">
        zibibbo
    </x-filament::button>
</x-filament::page>
