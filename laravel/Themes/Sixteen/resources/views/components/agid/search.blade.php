{{-- Componente Ricerca AGID Compliant --}}
<div 
    x-data="{
        query: '',
        results: [],
        isLoading: false,
        isOpen: false,
        selectedIndex: -1,
        
        async search() {
            if (this.query.length < 2) {
                this.results = [];
                this.isOpen = false;
                return;
            }
            
            this.isLoading = true;
            
            try {
                const response = await fetch(`{{ route('search.suggest') }}?q=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                
                this.results = data.results || [];
                this.isOpen = this.results.length > 0;
                this.selectedIndex = -1;
            } catch (error) {
                console.error('Search error:', error);
                this.results = [];
                this.isOpen = false;
            } finally {
                this.isLoading = false;
            }
        },
        
        onSubmit() {
            if (this.query.trim()) {
                window.location.href = `{{ route('search.results') }}?q=${encodeURIComponent(this.query)}`;
            }
        },
        
        onArrowDown() {
            if (this.results.length > 0) {
                this.selectedIndex = Math.min(this.selectedIndex + 1, this.results.length - 1);
                this.scrollToSelected();
            }
        },
        
        onArrowUp() {
            if (this.results.length > 0) {
                this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
                this.scrollToSelected();
            }
        },
        
        onEnter() {
            if (this.selectedIndex >= 0 && this.selectedIndex < this.results.length) {
                window.location.href = this.results[this.selectedIndex].url;
            } else {
                this.onSubmit();
            }
        },
        
        scrollToSelected() {
            if (this.selectedIndex >= 0) {
                const selectedElement = this.$refs.results.children[this.selectedIndex];
                if (selectedElement) {
                    selectedElement.scrollIntoView({ block: 'nearest' });
                }
            }
        },
        
        closeResults() {
            this.isOpen = false;
            this.selectedIndex = -1;
        }
    }"
    @click.away="closeResults()"
    @keydown.escape="closeResults()"
    class="agid-search relative"
    role="search"
    aria-labelledby="search-label"
>
    <label id="search-label" for="search-input" class="sr-only">Cerca nel sito</label>
    
    <div class="relative">
        {{-- Search Input --}}
        <input
            id="search-input"
            type="text"
            x-model="query"
            @input.debounce.300ms="search()"
            @keydown.down="onArrowDown()"
            @keydown.up="onArrowUp()"
            @keydown.enter="onEnter()"
            placeholder="Cerca nel sito..."
            aria-autocomplete="list"
            :aria-expanded="isOpen.toString()"
            aria-controls="search-results"
            :aria-activedescendant="selectedIndex >= 0 ? 'search-result-' + selectedIndex : null"
            class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
        />
        
        {{-- Search Icon --}}
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <button
                @click="onSubmit()"
                class="p-1 text-gray-400 hover:text-blue-600 transition-colors"
                aria-label="Esegui ricerca"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
        
        {{-- Loading Indicator --}}
        <div 
            x-show="isLoading"
            class="absolute right-12 top-1/2 transform -translate-y-1/2"
        >
            <div class="animate-spin rounded-full h-4 w-4 border-2 border-blue-600 border-t-transparent"></div>
        </div>
    </div>

    {{-- Search Results Dropdown --}}
    <div
        x-show="isOpen && results.length > 0"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        id="search-results"
        class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto"
        role="listbox"
        aria-labelledby="search-label"
    >
        <div x-ref="results" class="py-2">
            <template x-for="(result, index) in results" :key="result.id">
                <a
                    :href="result.url"
                    :id="'search-result-' + index"
                    :class="{
                        'bg-blue-50 text-blue-900': selectedIndex === index,
                        'text-gray-900 hover:bg-gray-50': selectedIndex !== index
                    }"
                    class="block px-4 py-3 transition-colors"
                    role="option"
                    :aria-selected="selectedIndex === index"
                >
                    <div class="flex items-center justify-between">
                        <span class="font-medium" x-text="result.title"></span>
                        <span class="text-sm text-gray-500 capitalize" x-text="result.type"></span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1" x-text="result.description"></p>
                </a>
            </template>
        </div>
        
        {{-- View All Results --}}
        <div class="border-t border-gray-200 p-3 bg-gray-50">
            <a
                :href="`{{ route('search.results') }}?q=${encodeURIComponent(query)}`"
                class="block text-center text-blue-600 hover:text-blue-800 font-medium"
            >
                Visualizza tutti i risultati per "<span x-text="query"></span>"
            </a>
        </div>
    </div>

    {{-- No Results Message --}}
    <div
        x-show="isOpen && results.length === 0 && query.length >= 2 && !isLoading"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50 p-4"
    >
        <p class="text-gray-600 text-center">
            Nessun risultato trovato per "<span x-text="query" class="font-medium"></span>"
        </p>
    </div>
</div>

<style>
.agid-search {
    min-width: 300px;
}

#search-input {
    font-size: 16px;
    min-height: 48px;
}

#search-input:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

.agid-search button {
    min-height: 44px;
    min-width: 44px;
}

.agid-search [role="listbox"] {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

.agid-search [role="listbox"]::-webkit-scrollbar {
    width: 6px;
}

.agid-search [role="listbox"]::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.agid-search [role="listbox"]::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.agid-search [role="listbox"]::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

.agid-search [role="option"] {
    border-bottom: 1px solid #f1f5f9;
}

.agid-search [role="option"]:last-child {
    border-bottom: none;
}

.agid-search [role="option"]:focus {
    outline: 2px solid #0066CC;
    outline-offset: -2px;
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .agid-search {
        border: 2px solid currentColor;
    }
    
    #search-input {
        border: 2px solid currentColor;
    }
    
    .agid-search [role="listbox"] {
        border: 2px solid currentColor;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .agid-search * {
        transition: none !important;
        animation: none !important;
    }
}

/* Mobile optimization */
@media (max-width: 640px) {
    .agid-search {
        min-width: auto;
        width: 100%;
    }
    
    .agid-search [role="listbox"] {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90vw;
        max-width: 400px;
        max-height: 60vh;
    }
}

/* Focus styles for accessibility */
.agid-search button:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* Loading animation for reduced motion */
@media (prefers-reduced-motion: reduce) {
    .animate-spin {
        animation: none;
        border: 2px solid #cbd5e1;
        border-top: 2px solid #0066CC;
    }
}
</style>