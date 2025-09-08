{{-- Back to Top (AGID compliant) --}}
@props([
    'label' => __('Torna su'),
    'target' => '#top',
])

<a href="{{ $target }}"
   class="fixed bottom-6 right-6 inline-flex items-center justify-center rounded-full bg-italia-blue-500 hover:bg-italia-blue-600 text-white shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/30 w-12 h-12"
   aria-label="{{ $label }}">
    <span aria-hidden="true">▲</span>
    <span class="sr-only">{{ $label }}</span>
</a>



