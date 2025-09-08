{{-- Sitemap / Indice contenuti (semplice) --}}
@props([
    'sections' => [], // array<array{title:string, links: array<array{label:string, href:string}>>>
])

<nav aria-label="{{ __('Mappa del sito') }}" class="grid md:grid-cols-3 gap-6">
    @foreach($sections as $section)
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $section['title'] ?? '' }}</h3>
            <ul class="space-y-2">
                @foreach(($section['links'] ?? []) as $link)
                    <li>
                        <a href="{{ $link['href'] ?? '#' }}" class="text-italia-blue-600 hover:underline">{{ $link['label'] ?? '' }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</nav>



