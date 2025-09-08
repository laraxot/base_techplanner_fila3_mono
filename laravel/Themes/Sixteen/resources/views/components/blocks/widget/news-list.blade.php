{{-- News List (AGID) --}}
@props([
    'items' => [], // array<array{title:string, href:string, date:?string, category:?string, excerpt:?string, image:?string}>
    'empty' => __('Nessuna notizia disponibile'),
    'cols' => 3,
])

@php
    $grid = [1 => 'grid-cols-1', 2 => 'grid-cols-2', 3 => 'grid-cols-3', 4 => 'grid-cols-4'][$cols] ?? 'grid-cols-3';
@endphp

<div class="grid {{ $grid }} gap-6">
    @forelse($items as $item)
        <x-pub_theme::blocks.cards.news-card
            :title="$item['title'] ?? ''"
            :href="$item['href'] ?? '#'"
            :date="$item['date'] ?? null"
            :category="$item['category'] ?? null"
            :excerpt="$item['excerpt'] ?? null"
            :image="$item['image'] ?? null"
        />
    @empty
        <div class="col-span-full text-gray-600">{{ $empty }}</div>
    @endforelse
    {{ $slot }}
    {{-- Slot opzionale per elementi aggiuntivi --}}
</div>



