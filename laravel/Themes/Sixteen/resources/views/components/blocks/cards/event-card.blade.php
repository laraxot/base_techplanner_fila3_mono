{{-- Event Card (AGID) --}}
@props([
    'title' => '',
    'href' => '#',
    'date' => null, // Carbon|string (YYYY-MM-DD)
    'time' => null, // string (HH:MM)
    'location' => null,
    'excerpt' => null,
    'image' => null,
    'imageAlt' => '',
])

<article {{ $attributes->merge(['class' => 'bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden h-full flex flex-col']) }}>
    @if($image)
        <a href="{{ $href }}" class="block">
            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-44 object-cover">
        </a>
    @endif
    <div class="p-5 flex-1 flex flex-col">
        <div class="text-sm text-gray-500 flex items-center gap-3 mb-2">
            @if($date)
                <time datetime="{{ is_string($date) ? $date : $date->toDateString() }}">{{ is_string($date) ? $date : $date->translatedFormat('d MMM yyyy') }}</time>
            @endif
            @if($time)
                <span aria-label="{{ __('Orario') }}">⏰ {{ $time }}</span>
            @endif
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
            <a href="{{ $href }}" class="hover:text-italia-blue-600">{{ $title }}</a>
        </h3>
        @if($location)
            <p class="text-gray-700 mb-2">📍 {{ $location }}</p>
        @endif
        @if($excerpt)
            <p class="text-gray-700 mb-4">{{ $excerpt }}</p>
        @endif
        <div class="mt-auto">
            <a href="{{ $href }}" class="inline-flex items-center gap-2 text-italia-blue-600 hover:underline font-medium">
                <span>{{ __('Scopri di più') }}</span>
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</article>
