{{-- Offices List (AGID) --}}
@props([
    'items' => [], // array<array{name:string, href:?string, phone:?string, email:?string, address:?string, hours:?string}>
    'empty' => __('Nessun ufficio disponibile'),
])

<div class="space-y-4">
    @forelse($items as $item)
        <article class="bg-white rounded-lg border border-gray-200 shadow-sm p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                @if(($item['href'] ?? null))
                    <a href="{{ $item['href'] }}" class="hover:text-italia-blue-600">{{ $item['name'] ?? '' }}</a>
                @else
                    {{ $item['name'] ?? '' }}
                @endif
            </h3>
            <div class="grid md:grid-cols-2 gap-3 text-gray-700">
                @if(($item['address'] ?? null))
                    <div>📍 {{ $item['address'] }}</div>
                @endif
                @if(($item['hours'] ?? null))
                    <div>🕒 {{ $item['hours'] }}</div>
                @endif
                @if(($item['phone'] ?? null))
                    <div>📞 <a class="text-italia-blue-600 hover:underline" href="tel:{{ $item['phone'] }}">{{ $item['phone'] }}</a></div>
                @endif
                @if(($item['email'] ?? null))
                    <div>✉️ <a class="text-italia-blue-600 hover:underline" href="mailto:{{ $item['email'] }}">{{ $item['email'] }}</a></div>
                @endif
            </div>
        </article>
    @empty
        <div class="text-gray-600">{{ $empty }}</div>
    @endforelse
    {{ $slot }}
</div>



