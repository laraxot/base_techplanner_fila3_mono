{{-- Regolatore Dimensione Caratteri - Accessibilità WCAG --}}
@props([
    'storageKey' => 'fontSizePreference',
    'minSize' => 0.8,
    'maxSize' => 1.4,
    'step' => 0.1,
    'defaultSize' => 1,
])

<div 
    x-data="{
        fontSize: localStorage.getItem('{{ $storageKey }}') || {{ $defaultSize }},
        
        increase() {
            if (this.fontSize < {{ $maxSize }}) {
                this.fontSize = Math.round((this.fontSize + {{ $step }}) * 10) / 10;
                this.updateFontSize();
            }
        },
        
        decrease() {
            if (this.fontSize > {{ $minSize }}) {
                this.fontSize = Math.round((this.fontSize - {{ $step }}) * 10) / 10;
                this.updateFontSize();
            }
        },
        
        reset() {
            this.fontSize = {{ $defaultSize }};
            this.updateFontSize();
        },
        
        updateFontSize() {
            localStorage.setItem('{{ $storageKey }}', this.fontSize);
            document.documentElement.style.fontSize = this.fontSize + 'rem';
            this.$dispatch('font-size-changed', { size: this.fontSize });
        },
        
        init() {
            this.updateFontSize();
        }
    }"
    class="flex items-center space-x-2"
    role="group"
    aria-label="{{ __('sixteen::accessibility.font_size_adjuster') }}"
>
    <span class="sr-only">
        {{ __('sixteen::accessibility.current_font_size') }}: 
        <span x-text="Math.round(fontSize * 100)"></span>%
    </span>
    
    <button
        @click="decrease"
        :disabled="fontSize <= {{ $minSize }}"
        :class="{
            'text-gray-400 cursor-not-allowed': fontSize <= {{ $minSize }},
            'text-gray-700 hover:text-blue-600': fontSize > {{ $minSize }},
        }"
        class="p-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :aria-label="__('sixteen::accessibility.decrease_font_size')"
        :aria-disabled="fontSize <= {{ $minSize }}"
    >
        <x-filament::icon name="heroicon-o-minus" class="w-4 h-4" />
    </button>
    
    <span 
        class="text-sm font-medium min-w-[3rem] text-center"
        aria-live="polite"
        aria-atomic="true"
    >
        <span x-text="Math.round(fontSize * 100)"></span>%
    </span>
    
    <button
        @click="increase"
        :disabled="fontSize >= {{ $maxSize }}"
        :class="{
            'text-gray-400 cursor-not-allowed': fontSize >= {{ $maxSize }},
            'text-gray-700 hover:text-blue-600': fontSize < {{ $maxSize }},
        }"
        class="p-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :aria-label="__('sixteen::accessibility.increase_font_size')"
        :aria-disabled="fontSize >= {{ $maxSize }}"
    >
        <x-filament::icon name="heroicon-o-plus" class="w-4 h-4" />
    </button>
    
    <button
        @click="reset"
        :disabled="fontSize === {{ $defaultSize }}"
        :class="{
            'text-gray-400 cursor-not-allowed': fontSize === {{ $defaultSize }},
            'text-gray-700 hover:text-blue-600': fontSize !== {{ $defaultSize }},
        }"
        class="p-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :aria-label="__('sixteen::accessibility.reset_font_size')"
        :aria-disabled="fontSize === {{ $defaultSize }}"
    >
        <x-filament::icon name="heroicon-o-arrow-path" class="w-4 h-4" />
    </button>
</div>

{{-- Stili base per il reset del font size --}}
<style>
html {
    font-size: 100%;
}

/* Supporto per preferenze sistema */
@media (prefers-contrast: more) {
    html {
        --contrast-bg: #000000;
        --contrast-text: #ffffff;
    }
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>