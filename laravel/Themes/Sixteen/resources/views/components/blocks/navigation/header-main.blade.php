{{--
/**
 * Header Main Block - AGID Compliant
 * Main institutional header with logo and branding
 * 
 * @props string $variant - Header variant (default, primary, secondary)
 * @props string $logo-src - Logo image source
 * @props string $logo-alt - Logo alt text
 * @props string $ente-name - Institution name
 * @props string $service-tagline - Service tagline
 * @props string $home-url - Home page URL
 * @props bool $show-navigation - Show main navigation
 * @props string $position - Position (static, sticky)
 */
--}}

@props([
    'variant' => 'default',
    'logo-src' => '/images/logo.svg',
    'logo-alt' => 'Logo Ente',
    'ente-name' => 'Nome Ente',
    'service-tagline' => 'Servizi digitali per i cittadini',
    'home-url' => '/',
    'show-navigation' => false,
    'position' => 'static'
])

@php
$baseClasses = 'bg-white border-b border-gray-200 py-4';

$positionClasses = [
    'static' => '',
    'sticky' => 'sticky top-0 z-40'
];

$headerClasses = collect([
    $baseClasses,
    $positionClasses[$position] ?? ''
])->filter()->implode(' ');
@endphp

<div class="{{ $headerClasses }}">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ $home-url }}" class="flex items-center space-x-4 group">
                    @if($logo-src)
                        <img src="{{ $logo-src }}" 
                             alt="{{ $logo-alt }}" 
                             class="h-12 w-auto transition-transform group-hover:scale-105">
                    @endif
                    
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                            {{ $ente-name }}
                        </h1>
                        @if($service-tagline)
                            <p class="text-gray-600 text-sm">{{ $service-tagline }}</p>
                        @endif
                    </div>
                </a>
            </div>
            
            @if($show-navigation)
                <nav role="navigation" aria-label="Navigazione principale" class="hidden md:flex items-center space-x-6">
                    {{ $slot }}
                </nav>
            @endif
        </div>
    </div>
</div>
