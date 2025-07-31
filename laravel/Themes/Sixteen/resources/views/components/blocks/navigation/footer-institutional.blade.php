{{--
/**
 * Footer Institutional Block - AGID Compliant
 * Institutional footer with mandatory PA links
 * 
 * @props string $variant - Footer variant (default, minimal, expanded)
 * @props string $logo-src - Footer logo source
 * @props string $logo-alt - Footer logo alt text
 * @props string $ente-name - Institution name
 * @props string $ente-description - Institution description
 * @props bool $show-links - Show institutional links
 * @props string $background - Background variant
 * @props array $custom-links - Additional custom links
 */
--}}

@props([
    'variant' => 'default',
    'logo-src' => '/images/logo-white.svg',
    'logo-alt' => 'Logo Ente',
    'ente-name' => 'Nome Ente',
    'ente-description' => 'Servizi digitali per i cittadini',
    'show-links' => true,
    'background' => 'dark',
    'custom-links' => []
])

@php
$baseClasses = 'py-8';

$backgroundClasses = [
    'dark' => 'bg-gray-900 text-white',
    'primary' => 'bg-blue-600 text-white',
    'light' => 'bg-gray-100 text-gray-900'
];

$footerClasses = collect([
    $baseClasses,
    $backgroundClasses[$background] ?? $backgroundClasses['dark']
])->filter()->implode(' ');

$defaultLinks = [
    ['title' => 'Privacy', 'url' => '/privacy'],
    ['title' => 'Note legali', 'url' => '/note-legali'],
    ['title' => 'Dichiarazione di accessibilità', 'url' => '/accessibilita'],
    ['title' => 'Assistenza', 'url' => '/help']
];

$allLinks = array_merge($defaultLinks, $custom-links);
@endphp

<footer role="contentinfo" class="{{ $footerClasses }}">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Institution Info -->
            <div class="flex items-center space-x-4">
                @if($logo-src)
                    <img src="{{ $logo-src }}" 
                         alt="{{ $logo-alt }}" 
                         class="h-10 w-auto">
                @endif
                
                <div>
                    <h3 class="text-lg font-semibold">{{ $ente-name }}</h3>
                    @if($ente-description)
                        <p class="text-sm opacity-80 mt-1">{{ $ente-description }}</p>
                    @endif
                </div>
            </div>
            
            <!-- Institutional Links -->
            @if($show-links && count($allLinks) > 0)
                <div>
                    <h4 class="text-lg font-semibold mb-4">Link utili</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach($allLinks as $link)
                            <li>
                                <a href="{{ $link['url'] }}" 
                                   class="opacity-80 hover:opacity-100 transition-opacity focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1"
                                   @if(Str::startsWith($link['url'], 'http')) 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                   @endif>
                                    {{ $link['title'] }}
                                    @if(Str::startsWith($link['url'], 'http'))
                                        <svg class="w-3 h-3 inline ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                                            <path d="M5 5a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2v-2a1 1 0 10-2 0v2H5V7h2a1 1 0 000-2H5z"></path>
                                        </svg>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        <!-- Additional Content Slot -->
        @if($slot->isNotEmpty())
            <div class="mt-8 pt-8 border-t border-gray-700">
                {{ $slot }}
            </div>
        @endif
        
        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm opacity-80">
            <p>&copy; {{ date('Y') }} {{ $ente-name }}. Tutti i diritti riservati.</p>
        </div>
    </div>
</footer>
