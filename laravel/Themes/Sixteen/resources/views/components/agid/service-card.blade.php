{{-- Componente Card Servizio AGID Compliant --}}
@props([
    'title',
    'description',
    'icon' => 'heroicon-o-cog',
    'url' => '#',
    'category' => 'servizio',
    'status' => 'active',
    'requiresAuth' => false,
    'external' => false,
    'badge' => null,
])

@php
    $statusColors = [
        'active' => 'bg-green-100 text-green-800',
        'maintenance' => 'bg-yellow-100 text-yellow-800',
        'down' => 'bg-red-100 text-red-800',
        'beta' => 'bg-blue-100 text-blue-800',
    ];
    
    $statusIcons = [
        'active' => 'heroicon-o-check-circle',
        'maintenance' => 'heroicon-o-exclamation-circle',
        'down' => 'heroicon-o-x-circle',
        'beta' => 'heroicon-o-beaker',
    ];
    
    $statusLabels = [
        'active' => 'Attivo',
        'maintenance' => 'Manutenzione',
        'down' => 'Non disponibile',
        'beta' => 'Beta',
    ];
    
    $categoryIcons = [
        'servizio' => 'heroicon-o-user-group',
        'anagrafe' => 'heroicon-o-document-text',
        'tributi' => 'heroicon-o-currency-euro',
        'urbanistica' => 'heroicon-o-building-office',
        'sociale' => 'heroicon-o-heart',
        'ambiente' => 'heroicon-o-leaf',
        'mobilita' => 'heroicon-o-truck',
        'cultura' => 'heroicon-o-book-open',
        'sport' => 'heroicon-o-trophy',
        'scuola' => 'heroicon-o-academic-cap',
    ];
@endphp

<a
    href="{{ $url }}"
    @if($external) target="_blank" rel="noopener noreferrer" @endif
    class="agid-service-card group block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
    :class="{
        'opacity-60 cursor-not-allowed': $status === 'down',
        'border-yellow-300': $status === 'maintenance',
        'border-blue-300': $status === 'beta'
    }"
    @if($status === 'down') aria-disabled="true" @endif
    role="article"
    aria-labelledby="service-title-{{ Str::slug($title) }}"
>
    {{-- Card Header --}}
    <div class="flex items-start justify-between mb-4">
        {{-- Service Icon --}}
        <div class="flex-shrink-0">
            <div class="p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                <x-dynamic-component 
                    :component="$categoryIcons[$category] ?? 'heroicon-o-cog'" 
                    class="w-6 h-6 text-blue-600"
                />
            </div>
        </div>
        
        {{-- Status Badge --}}
        <div class="flex items-center space-x-2">
            @if($badge)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $badge }}
                </span>
            @endif
            
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
                <x-dynamic-component 
                    :component="$statusIcons[$status]" 
                    class="w-3 h-3 mr-1"
                />
                {{ $statusLabels[$status] }}
            </span>
        </div>
    </div>

    {{-- Card Content --}}
    <div class="flex-1">
        <h3 
            id="service-title-{{ Str::slug($title) }}"
            class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors"
        >
            {{ $title }}
        </h3>
        
        <p class="text-gray-600 text-sm leading-relaxed mb-4">
            {{ $description }}
        </p>
    </div>

    {{-- Card Footer --}}
    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
        <div class="flex items-center space-x-2">
            @if($requiresAuth)
                <span class="inline-flex items-center text-xs text-gray-500">
                    <x-heroicon-o-lock-closed class="w-3 h-3 mr-1" />
                    Accesso autenticato
                </span>
            @else
                <span class="inline-flex items-center text-xs text-green-600">
                    <x-heroicon-o-lock-open class="w-3 h-3 mr-1" />
                    Accesso libero
                </span>
            @endif
            
            @if($external)
                <span class="inline-flex items-center text-xs text-gray-500">
                    <x-heroicon-o-arrow-top-right-on-square class="w-3 h-3 mr-1" />
                    Esterno
                </span>
            @endif
        </div>
        
        <span class="inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-800 transition-colors">
            Accedi al servizio
            <x-heroicon-o-arrow-right class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" />
        </span>
    </div>
    
    {{-- Maintenance Warning --}}
    @if($status === 'maintenance')
        <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
            <div class="flex items-center">
                <x-heroicon-o-exclamation-triangle class="w-4 h-4 text-yellow-600 mr-2" />
                <span class="text-sm text-yellow-700">
                    Servizio in manutenzione. Potrebbero verificarsi interruzioni.
                </span>
            </div>
        </div>
    @endif
    
    {{-- Service Down Warning --}}
    @if($status === 'down')
        <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <x-heroicon-o-x-circle class="w-4 h-4 text-red-600 mr-2" />
                <span class="text-sm text-red-700">
                    Servizio temporaneamente non disponibile.
                </span>
            </div>
        </div>
    @endif
</a>

<style>
.agid-service-card {
    min-height: 220px;
    display: flex;
    flex-direction: column;
}

.agid-service-card:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

.agid-service-card[aria-disabled="true"] {
    pointer-events: none;
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .agid-service-card {
        border: 2px solid currentColor;
    }
    
    .agid-service-card:hover {
        border: 2px solid #0066CC;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .agid-service-card {
        transition: none;
    }
    
    .group-hover\:translate-x-1 {
        transform: none;
    }
}

/* Mobile optimization */
@media (max-width: 640px) {
    .agid-service-card {
        min-height: auto;
        padding: 1rem;
    }
    
    .agid-service-card .flex.items-start {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .agid-service-card .flex.items-center.space-x-2 {
        flex-wrap: wrap;
        gap: 0.25rem;
    }
}

/* Focus styles for interactive elements */
.agid-service-card .inline-flex:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .agid-service-card {
        border: 1px solid #000;
        box-shadow: none;
    }
    
    .agid-service-card:hover {
        box-shadow: none;
    }
}
</style>