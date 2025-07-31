@props([
    'brand' => null,
    'brand-href' => '/',
    'variant' => 'light',
    'sticky' => false,
    'expand' => 'lg',
    'container' => true,
    'items' => [],
    'separator' => '/',
    'aria-label' => 'Breadcrumb',
    'current-page' => 1,
    'total-pages' => 1,
    'base-url' => null,
    'size' => 'md',
    'show-first-last' => true,
    'show-prev-next' => true,
    'max-visible' => 5,
])

<nav 
    {{ $attributes->merge([
        'class' => 'py-4',
        'aria-label' => $aria-label
    ]) }}
>
    <ol class="flex items-center space-x-2 text-sm">
        @foreach($items as $index => $item)
            @if($index > 0)
                <li class="text-gray-400" aria-hidden="true">
                    {{ $separator }}
                </li>
            @endif
            
            <li>
                @if($index === count($items) - 1)
                    <!-- Current page -->
                    <span class="text-gray-700 font-medium" aria-current="page">
                        {{ $item['label'] }}
                    </span>
                @else
                    <!-- Link -->
                    <a 
                        href="{{ $item['href'] ?? '#' }}" 
                        class="text-blue-600 hover:text-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded"
                    >
                        {{ $item['label'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav> 