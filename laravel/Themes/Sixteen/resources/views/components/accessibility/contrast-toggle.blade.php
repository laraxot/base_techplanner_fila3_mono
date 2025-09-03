{{-- Toggle Alto Contrasto - Conforme WCAG e Legge Stanca --}}
@props([
    'storageKey' => 'highContrastMode',
    'iconOn' => 'heroicon-o-eye',
    'iconOff' => 'heroicon-o-eye-slash',
])

<div 
    x-data="{
        enabled: localStorage.getItem('{{ $storageKey }}') === 'true',
        
        toggle() {
            this.enabled = !this.enabled;
            localStorage.setItem('{{ $storageKey }}', this.enabled);
            this.updateDocumentClass();
            this.$dispatch('contrast-changed', { enabled: this.enabled });
        },
        
        updateDocumentClass() {
            if (this.enabled) {
                document.documentElement.classList.add('high-contrast');
            } else {
                document.documentElement.classList.remove('high-contrast');
            }
        },
        
        init() {
            this.updateDocumentClass();
            
            // Listen for system preference changes
            const mediaQuery = window.matchMedia('(prefers-contrast: more)');
            const handleChange = (e) => {
                if (e.matches && !this.enabled) {
                    this.enabled = true;
                    localStorage.setItem('{{ $storageKey }}', 'true');
                    this.updateDocumentClass();
                }
            };
            
            mediaQuery.addEventListener('change', handleChange);
            
            // Cleanup
            this._cleanup = () => {
                mediaQuery.removeEventListener('change', handleChange);
            };
        },
        
        destroy() {
            if (this._cleanup) {
                this._cleanup();
            }
        }
    }"
    class="inline-block"
    role="switch"
    :aria-checked="enabled"
    :aria-label="enabled ? '{{ __('pub_theme::accessibility.disable_high_contrast') }}' : '{{ __('pub_theme::accessibility.enable_high_contrast') }}'"
>
    <button
        @click="toggle"
        :class="{
            'bg-blue-600': enabled,
            'bg-gray-300': !enabled,
        }"
        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :aria-pressed="enabled"
    >
        <span class="sr-only">
            <span x-show="!enabled">{{ __('pub_theme::accessibility.enable_high_contrast') }}</span>
            <span x-show="enabled">{{ __('pub_theme::accessibility.disable_high_contrast') }}</span>
        </span>
        
        <span
            :class="{
                'translate-x-6': enabled,
                'translate-x-1': !enabled,
            }"
            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
        >
            <span class="flex items-center justify-center">
                <x-filament::icon 
                    :name="enabled ? iconOn : iconOff" 
                    class="w-3 h-3"
                    :class="{
                        'text-blue-600': enabled,
                        'text-gray-400': !enabled,
                    }"
                />
            </span>
        </span>
    </button>
</div>

{{-- Stili alto contrasto --}}
<style>
.high-contrast {
    --contrast-bg: #000000;
    --contrast-text: #ffffff;
    --contrast-primary: #ffff00;
    --contrast-border: #ffffff;
}

.high-contrast body {
    background-color: var(--contrast-bg) !important;
    color: var(--contrast-text) !important;
}

.high-contrast a {
    color: var(--contrast-primary) !important;
    text-decoration: underline !important;
}

.high-contrast button,
.high-contrast .btn {
    background-color: var(--contrast-bg) !important;
    color: var(--contrast-text) !important;
    border: 2px solid var(--contrast-border) !important;
}

.high-contrast input,
.high-contrast select,
.high-contrast textarea {
    background-color: var(--contrast-bg) !important;
    color: var(--contrast-text) !important;
    border: 2px solid var(--contrast-border) !important;
}

.high-contrast .bg-gray-100 { background-color: #000000 !important; }
.high-contrast .bg-white { background-color: #000000 !important; }
.high-contrast .text-gray-700 { color: #ffffff !important; }
.high-contrast .text-gray-500 { color: #cccccc !important; }
.high-contrast .border-gray-300 { border-color: #ffffff !important; }

/* Mantenere focus visibile */
.high-contrast .focus\:ring-2:focus {
    box-shadow: 0 0 0 3px var(--contrast-primary) !important;
}
</style>