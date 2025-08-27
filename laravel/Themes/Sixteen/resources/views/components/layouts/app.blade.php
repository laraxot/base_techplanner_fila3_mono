<x-layouts.main>
<x-section slug="header"/>
    {{ $slot }}
<x-section slug="footer"/>
    {{ $_theme->footer() }}

</x-layouts.main>
