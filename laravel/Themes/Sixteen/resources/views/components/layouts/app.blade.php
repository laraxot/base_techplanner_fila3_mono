<x-layouts.main>
<x-section slug="header"/>
    {{ $slot }}
<x-section slug="footer"/>
    {{ $_theme->footer() }}

=======
    <x-section slug="header"/>
    {{ $slot }}
    <x-section slug="footer"/>
</x-layouts.main>
