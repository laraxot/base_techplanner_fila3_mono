{{-- Bootstrap Italia Modal Component --}}
{{-- 
    Componente modal conforme alle specifiche Bootstrap Italia
    Supporta modali accessibili, focus trapping e animazioni
--}}
@props([
    'id' => null,
    'title' => null,
    'size' => 'md', // 'sm', 'md', 'lg', 'xl', 'fullscreen'
    'scrollable' => false,
    'centered' => false,
    'staticBackdrop' => false,
    'focus' => true,
    'keyboard' => true,
    'show' => false,
    'showClose' => true,
    'closeLabel' => 'Chiudi',
    'headerClass' => '',
    'bodyClass' => '',
    'footerClass' => '',
])

@php
$modalId = $id ?? 'modal-' . uniqid();
$backdropId = $modalId . '-backdrop';

// Classi per dimensioni
$sizeClasses = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg', 
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
    'fullscreen' => 'sm:max-w-full h-full m-0'
];

// Classi per modal dialog
$dialogClasses = [
    'relative',
    'w-full',
    'max-h-full',
    $sizeClasses[$size],
    $scrollable ? 'overflow-hidden' : '',
    $centered ? 'sm:my-8' : ''
];

// Classi per modal content
$contentClasses = [
    'relative',
    'bg-white',
    'rounded-lg',
    'shadow-xl',
    'transform',
    'transition-all',
    $scrollable ? 'flex flex-col max-h-full' : ''
];

// Classi per header
$headerClasses = [
    'flex',
    'items-start',
    'justify-between',
    'p-6',
    'border-b',
    'border-gray-200',
    'rounded-t-lg',
    $headerClass
];

// Classi per body
$bodyClasses = [
    'relative',
    'p-6',
    'flex-auto',
    $scrollable ? 'overflow-y-auto' : '',
    $bodyClass
];

// Classi per footer  
$footerClasses = [
    'flex',
    'flex-wrap',
    'items-center',
    'justify-end',
    'p-6',
    'border-t',
    'border-gray-200',
    'rounded-b-lg',
    'space-x-3',
    $footerClass
];
@endphp

<div 
    x-data="modalManager()" 
    x-init="initModal('{{ $modalId }}')"
    wire:key="{{ $modalId }}"
    wire:ignore
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="{{ $modalId }}-title"
    aria-describedby="{{ $modalId }}-description"
    aria-modal="true"
    role="dialog"
    x-show="isVisible"
    x-cloak
>
    {{-- Backdrop --}}
    <div 
        x-show="isVisible"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
        @click="!staticBackdrop && close()"
    ></div>

    {{-- Modal Container --}}
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        {{-- Modal Dialog --}}
        <div 
            x-show="isVisible"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @class($dialogClasses)
            @if($staticBackdrop) @click.stop @endif
        >
            {{-- Modal Content --}}
            <div @class($contentClasses)>
                {{-- Header --}}
                @if($title || $showClose)
                    <div @class($headerClasses)>
                        @if($title)
                            <div class="flex-1">
                                <h3 
                                    id="{{ $modalId }}-title" 
                                    class="text-lg font-semibold text-gray-900"
                                >
                                    {{ $title }}
                                </h3>
                                
                                {{-- Sottotitolo opzionale --}}
                                @if(isset($subtitle))
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $subtitle }}
                                    </p>
                                @endif
                            </div>
                        @endif
                        
                        @if($showClose)
                            <button
                                type="button"
                                @click="close()"
                                class="ml-4 flex-shrink-0 rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-italia-blue-500 focus:ring-offset-2"
                                :aria-label="'{{ $closeLabel }}'"
                            >
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @endif

                {{-- Body --}}
                <div 
                    id="{{ $modalId }}-description"
                    @class($bodyClasses)
                >
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                @if(isset($footer))
                    <div @class($footerClasses)>
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function modalManager() {
    return {
        isVisible: {{ $show ? 'true' : 'false' }},
        staticBackdrop: {{ $staticBackdrop ? 'true' : 'false' }},
        focus: {{ $focus ? 'true' : 'false' }},
        keyboard: {{ $keyboard ? 'true' : 'false' }},
        
        initModal(id) {
            // Inizializzazione modal
            if (this.isVisible) {
                this.lockBodyScroll();
                if (this.focus) {
                    this.focusFirstElement();
                }
            }
            
            // Gestione eventi globali
            this.setupEventListeners();
        },
        
        setupEventListeners() {
            // Evento per aprire modal
            window.addEventListener('open-modal', (event) => {
                if (event.detail === '{{ $modalId }}') {
                    this.open();
                }
            });
            
            // Evento per chiudere modal
            window.addEventListener('close-modal', (event) => {
                if (event.detail === '{{ $modalId }}') {
                    this.close();
                }
            });
            
            // Gestione tastiera
            if (this.keyboard) {
                document.addEventListener('keydown', this.handleKeydown.bind(this));
            }
        },
        
        handleKeydown(event) {
            if (this.isVisible) {
                // ESC per chiudere
                if (event.key === 'Escape') {
                    event.preventDefault();
                    this.close();
                }
                
                // Tab trapping
                if (event.key === 'Tab') {
                    this.handleTabKey(event);
                }
            }
        },
        
        handleTabKey(event) {
            const focusableElements = this.getFocusableElements();
            
            if (focusableElements.length === 0) {
                event.preventDefault();
                return;
            }
            
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            if (event.shiftKey) {
                // Shift + Tab
                if (document.activeElement === firstElement) {
                    event.preventDefault();
                    lastElement.focus();
                }
            } else {
                // Tab
                if (document.activeElement === lastElement) {
                    event.preventDefault();
                    firstElement.focus();
                }
            }
        },
        
        getFocusableElements() {
            const selector = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
            return Array.from(this.$el.querySelectorAll(selector))
                .filter(el => !el.disabled && el.offsetParent !== null);
        },
        
        focusFirstElement() {
            setTimeout(() => {
                const focusableElements = this.getFocusableElements();
                if (focusableElements.length > 0) {
                    focusableElements[0].focus();
                }
            }, 100);
        },
        
        lockBodyScroll() {
            document.body.style.overflow = 'hidden';
            document.body.style.paddingRight = this.getScrollbarWidth() + 'px';
        },
        
        unlockBodyScroll() {
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        },
        
        getScrollbarWidth() {
            return window.innerWidth - document.documentElement.clientWidth;
        },
        
        open() {
            this.isVisible = true;
            this.lockBodyScroll();
            
            if (this.focus) {
                this.focusFirstElement();
            }
            
            // Evento personalizzato
            this.$el.dispatchEvent(new CustomEvent('modal-opened', {
                detail: { modalId: '{{ $modalId }}' }
            }));
        },
        
        close() {
            if (this.staticBackdrop) {
                // Verifica se il click è sul backdrop
                return;
            }
            
            this.isVisible = false;
            this.unlockBodyScroll();
            
            // Evento personalizzato
            this.$el.dispatchEvent(new CustomEvent('modal-closed', {
                detail: { modalId: '{{ $modalId }}' }
            }));
        },
        
        toggle() {
            if (this.isVisible) {
                this.close();
            } else {
                this.open();
            }
        }
    };
}
</script>
@endpush

{{-- 
Utilizzo:

<!-- Modal base -->
<x-bootstrap-italia.modal 
    id="example-modal"
    title="Titolo Modal"
    size="lg"
    :show="$showModal"
>
    <p>Contenuto del modal qui...</p>
    
    <x-slot name="footer">
        <button type="button" @click="$showModal = false" class="btn btn-secondary">
            Annulla
        </button>
        <button type="button" class="btn btn-primary">
            Conferma
        </button>
    </x-slot>
</x-bootstrap-italia.modal>

<!-- Modal scrollabile -->
<x-bootstrap-italia.modal 
    title="Contenuto Lungo"
    size="xl"
    :scrollable="true"
    :centered="true"
>
    <div class="h-96">
        <!-- Contenuto lungo scrollabile -->
    </div>
</x-bootstrap-italia.modal>

<!-- Modal fullscreen -->
<x-bootstrap-italia.modal 
    title="Modal a Schermo Intero"
    size="fullscreen"
    :static-backdrop="true"
>
    <div class="h-full">
        <!-- Contenuto fullscreen -->
    </div>
</x-bootstrap-italia.modal>

<!-- Modal con controllo Livewire -->
<x-bootstrap-italia.modal 
    :show="$showUserModal"
    wire:key="user-modal"
>
    <livewire:user-form :user="$selectedUser" />
</x-bootstrap-italia.modal>

<!-- Apertura/chiusura programmatica -->
<button @click="$dispatch('open-modal', 'example-modal')">
    Apri Modal
</button>

<button @click="$dispatch('close-modal', 'example-modal')">
    Chiudi Modal
</button>

Accessibilità:
- Focus trapping completo
- Navigazione da tastiera
- Supporto screen reader
- ARIA attributes completi
- Gestione scroll body

Browser Support:
- Chrome, Firefox, Safari, Edge
- Mobile browsers
- Screen readers
- Keyboard navigation
--}}