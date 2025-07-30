<x-layouts.main>
    {{--  
    <x-ui.marketing.header />
    --}}
    {{ $_theme->headernav() }}

    {{ $slot }}

    {{ $_theme->footer() }}

</x-layouts.main>
