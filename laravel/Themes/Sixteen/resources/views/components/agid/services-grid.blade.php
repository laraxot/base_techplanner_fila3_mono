{{-- Griglia Servizi Digitali AGID Compliant --}}
@props([
    'services' => [],
    'title' => 'Servizi Digitali',
    'description' => 'Accedi a tutti i servizi digitali del comune',
    'columns' => 3,
    'category' => null,
])

@php
    $gridClasses = [
        1 => 'grid-cols-1',
        2 => 'grid-cols-1 md:grid-cols-2',
        3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
        4 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
    ][$columns] ?? 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
    
    $filteredServices = $category 
        ? array_filter($services, fn($service) => $service['category'] === $category)
        : $services;
@endphp

<section 
    class="agid-services-grid py-12 bg-gray-50"
    aria-labelledby="services-grid-heading"
>
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 
                id="services-grid-heading"
                class="text-3xl font-bold text-gray-900 mb-4"
            >
                {{ $title }}
            </h2>
            
            @if($description)
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Category Filter --}}
        @if(!$category && count(array_unique(array_column($services, 'category'))) > 1)
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <button
                        @click="activeCategory = null"
                        :class="{ 
                            'bg-blue-600 text-white': activeCategory === null,
                            'bg-white text-gray-700 hover:bg-gray-50': activeCategory !== null
                        }"
                        class="px-4 py-2 rounded-lg border border-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Tutti i servizi
                    </button>
                    
                    @foreach(array_unique(array_column($services, 'category')) as $serviceCategory)
                        <button
                            @click="activeCategory = '{{ $serviceCategory }}'"
                            :class="{ 
                                'bg-blue-600 text-white': activeCategory === '{{ $serviceCategory }}',
                                'bg-white text-gray-700 hover:bg-gray-50': activeCategory !== '{{ $serviceCategory }}'
                            }"
                            class="px-4 py-2 rounded-lg border border-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            {{ ucfirst($serviceCategory) }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Services Grid --}}
        <div 
            x-data="{ activeCategory: null }"
            class="agid-services-container"
        >
            <div 
                class="grid {{ $gridClasses }} gap-6"
                role="list"
                aria-label="Elenco servizi digitali"
            >
                @foreach($filteredServices as $service)
                    <div 
                        role="listitem"
                        x-show="!activeCategory || '{{ $service['category'] }}' === activeCategory"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                    >
                        <x-agid.service-card
                            :title="$service['title'] ?? 'Servizio'"
                            :description="$service['description'] ?? ''"
                            :icon="$service['icon'] ?? 'heroicon-o-cog'"
                            :url="$service['url'] ?? '#'"
                            :category="$service['category'] ?? 'servizio'"
                            :status="$service['status'] ?? 'active'"
                            :requiresAuth="$service['requiresAuth'] ?? false"
                            :external="$service['external'] ?? false"
                            :badge="$service['badge'] ?? null"
                        />
                    </div>
                @endforeach
            </div>

            {{-- No Services Message --}}
            <div 
                x-show="activeCategory && $filteredServices.filter(s => s.category === activeCategory).length === 0"
                class="text-center py-12"
            >
                <div class="bg-white rounded-lg border border-gray-200 p-8">
                    <x-heroicon-o-magnifying-glass class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Nessun servizio trovato</h3>
                    <p class="text-gray-600">
                        Non ci sono servizi disponibili per la categoria selezionata.
                    </p>
                </div>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="text-center mt-12">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Non trovi il servizio che cerchi?</h3>
                <p class="text-gray-600 mb-4">
                    Contatta l'URP per maggiori informazioni o assistenza.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a 
                        href="{{ route('pages.view', ['slug' => 'urp']) }}" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <x-heroicon-o-phone class="w-5 h-5 mr-2" />
                        Contatta URP
                    </a>
                    <a 
                        href="{{ route('pages.view', ['slug' => 'assistenza']) }}" 
                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    >
                        <x-heroicon-o-lifebuoy class="w-5 h-5 mr-2" />
                        Assistenza Tecnica
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.agid-services-grid {
    scroll-margin-top: 2rem;
}

.agid-services-container [role="list"] {
    list-style: none;
    margin: 0;
    padding: 0;
}

.agid-services-container [role="listitem"] {
    margin: 0;
}

/* Focus styles for filter buttons */
.agid-services-grid button:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .agid-services-grid {
        border: 2px solid currentColor;
    }
    
    .agid-services-grid button {
        border: 2px solid currentColor;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .agid-services-grid * {
        transition: none !important;
    }
    
    .agid-services-container [role="listitem"] {
        x-transition: none !important;
    }
}

/* Mobile optimization */
@media (max-width: 768px) {
    .agid-services-grid {
        padding: 2rem 1rem;
    }
    
    .agid-services-grid .text-center h2 {
        font-size: 1.5rem;
    }
    
    .agid-services-grid .flex-wrap {
        justify-content: center;
    }
    
    .agid-services-grid .flex-wrap button {
        flex: 1;
        min-width: 120px;
        text-align: center;
    }
    
    .agid-services-grid .flex.flex-wrap.gap-4 {
        flex-direction: column;
        gap: 1rem;
    }
    
    .agid-services-grid .flex.flex-wrap.gap-4 a {
        justify-content: center;
    }
}

/* Print styles */
@media print {
    .agid-services-grid {
        background: none !important;
    }
    
    .agid-services-grid .bg-blue-50 {
        background: #f0f4f8 !important;
        border: 1px solid #000 !important;
    }
    
    .agid-services-grid button {
        display: none;
    }
}

/* Accessibility: Ensure proper focus management */
.agid-services-grid:focus-within {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* Support for keyboard navigation */
.agid-services-container [role="listitem"]:focus-within {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
    border-radius: 0.5rem;
}
</style>