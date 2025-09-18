<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<div>
>>>>>>> de0f89b5 (.)
=======
<div>
>>>>>>> 2e199498 (.)
=======
<div>
>>>>>>> eaeb6531 (.)
    <x-filament::section></x-filament::section>
    <x-filament::section>
        <x-slot name="title">Schedule Status</x-slot>
        <x-slot name="txt">
            <pre>{!! $out !!}</pre>
        </x-slot>
        <x-slot name="footer">
            @foreach ($acts as $act)
                <button class="btn btn-primary" wire:click="artisan('{{ $act->name }}')">{{ $act->name }}
                </button>
            @endforeach
        </x-slot>
    </x-filament::section>

</div>
