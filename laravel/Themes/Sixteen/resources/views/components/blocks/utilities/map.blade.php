{{-- Map Embed (OSM) --}}
@props([
    'lat' => null,
    'lng' => null,
    'zoom' => 14,
    'title' => __('Mappa'),
    'height' => '320px',
    'src' => null, // custom iframe src
])

@php
    $computedSrc = $src;
    if (!$computedSrc && $lat && $lng) {
        // OSM embed
        $computedSrc = 'https://www.openstreetmap.org/export/embed.html?bbox=' . ($lng - 0.01) . '%2C' . ($lat - 0.01) . '%2C' . ($lng + 0.01) . '%2C' . ($lat + 0.01) . '&layer=mapnik&marker=' . $lat . '%2C' . $lng;
    }
@endphp

<div class="w-full border border-gray-200 rounded-lg overflow-hidden" aria-label="{{ $title }}">
    @if($computedSrc)
        <iframe title="{{ $title }}" src="{{ $computedSrc }}" style="width:100%;height: {{ $height }}" loading="lazy"></iframe>
    @else
        <div class="p-4 text-gray-600">{{ __('Mappa non disponibile') }}</div>
    @endif
</div>



