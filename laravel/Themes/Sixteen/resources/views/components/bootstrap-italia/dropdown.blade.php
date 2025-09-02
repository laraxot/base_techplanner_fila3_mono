{{-- Bootstrap Italia Dropdown Component --}}
{{-- 
    Dropdown component conforme alle specifiche Bootstrap Italia
    Supporta keyboard navigation, ARIA attributes e stati multipli
--}}
@props([
    'id' => null,
    'size' => 'md', // 'sm', 'md', 'lg'
    'variant' => 'primary', // 'primary', 'secondary', 'outline-primary', 'outline-secondary'
    'split' => false,
    'disabled' => false,
    'right' => false, // Allineamento menu a destra
    'up' => false, // Dropdown che si apre verso l'alto
    'text' => null, // Testo del pulsante principale
    'icon' => null, // Icona del pulsante
    'menuClass' => null, // Classi aggiuntive per il menu
])

@php
$dropdownId = $id ?? 'dropdown-' . uniqid();

// Classi per dimensioni
$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg'
];

// Classi per varianti
$variantClasses = [
    'primary' => 'bg-italia-blue-500 hover:bg-italia-blue-600 text-white border-italia-blue-500',
    'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white border-gray-500',
    'outline-primary' => 'bg-transparent hover:bg-italia-blue-500 text-italia-blue-500 hover:text-white border-italia-blue-500',
    'outline-secondary' => 'bg-transparent hover:bg-gray-500 text-gray-500 hover:text-white border-gray-500',
];

$buttonClasses = [
    'inline-flex',
    'items-center',
    'justify-center',
    'border',
    'font-medium',
    'rounded-md',
    'transition-colors',
    'duration-200',
    'focus:outline-none',
    'focus:ring-2',
    'focus:ring-offset-2',
    'focus:ring-italia-blue-500',
    $sizeClasses[$size],
    $variantClasses[$variant],
    $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
];

$menuClasses = [
    'absolute',
    'z-10',
    'mt-2',
    'w-56',
    'rounded-md',
    'shadow-lg',
    'bg-white',
    'ring-1',
    'ring-black',
    'ring-opacity-5',
    'focus:outline-none',
    'divide-y',
    'divide-gray-100',
    $right ? 'right-0' : 'left-0',
    $up ? 'bottom-full mb-2' : 'top-full mt-2',
    $menuClass
];
@endphp

<div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
    @if($split)
        {{-- Split Button Dropdown --}}
        <div class="inline-flex rounded-md shadow-sm" role="group" aria-label="Split button dropdown">
            {{-- Main Button --}}
            <button
                type="button"
                @class([
                    ...$buttonClasses,
                    'rounded-r-none',
                    'border-r-0'
                ])
                @if($disabled) disabled @endif
                aria-label="{{ $text ?? 'Split button' }}"
            >
                @if($icon)
                    <x-filament::icon :name="$icon" class="w-5 h-5 mr-2" aria-hidden="true" />
                @endif
                {{ $text }}
            </button>
            
            {{-- Dropdown Toggle --}}
            <button
                type="button"
                @class([
                    ...$buttonClasses,
                    'rounded-l-none',
                    'border-l',
                    'px-2'
                ])
                @click="open = !open"
                @keydown.escape="open = false"
                @keydown.arrow-down.prevent="open = true; $nextTick(() => $refs.menu.focus())"
                :aria-expanded="open"
                aria-haspopup="true"
                :aria-controls="$id('{{ $dropdownId }}')"
                @if($disabled) disabled @endif
                aria-label="Apri menu dropdown"
            >
                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @else
        {{-- Standard Dropdown Button --}}
        <button
            type="button"
            @class($buttonClasses)
            @click="open = !open"
            @keydown.escape="open = false"
            @keydown.arrow-down.prevent="open = true; $nextTick(() => $refs.menu.focus())"
            :aria-expanded="open"
            aria-haspopup="true"
            :aria-controls="$id('{{ $dropdownId }}')"
            @if($disabled) disabled @endif
        >
            @if($icon)
                <x-filament::icon :name="$icon" class="w-5 h-5 mr-2" aria-hidden="true" />
            @endif
            {{ $text ?? $slot }}
            <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
    
    {{-- Dropdown Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        @class($menuClasses)
        x-ref="menu"
        tabindex="-1"
        role="menu"
        :aria-labelledby="$id('{{ $dropdownId }}')"
        @keydown.escape="open = false"
        @keydown.arrow-up.prevent="$event.target.previousElementSibling?.focus() || $event.target.parentElement.lastElementChild.focus()"
        @keydown.arrow-down.prevent="$event.target.nextElementSibling?.focus() || $event.target.parentElement.firstElementChild.focus()"
    >
        <div class="py-1" role="none">
            {{ $slot }}
        </div>
    </div>
</div>

{{-- 
Utilizzo:

<!-- Dropdown semplice -->
<x-bootstrap-italia.dropdown text="Menu Azioni">
    <x-bootstrap-italia.dropdown-item href="#" icon="heroicon-o-eye">
        Visualizza
    </x-bootstrap-italia.dropdown-item>
    <x-bootstrap-italia.dropdown-item href="#" icon="heroicon-o-pencil">
        Modifica
    </x-bootstrap-italia.dropdown-item>
    <x-bootstrap-italia.dropdown-divider />
    <x-bootstrap-italia.dropdown-item href="#" icon="heroicon-o-trash" variant="danger">
        Elimina
    </x-bootstrap-italia.dropdown-item>
</x-bootstrap-italia.dropdown>

<!-- Split button dropdown -->
<x-bootstrap-italia.dropdown 
    text="Azione Principale" 
    split 
    variant="primary"
    size="lg"
    icon="heroicon-o-plus"
>
    <x-bootstrap-italia.dropdown-item href="#">
        Opzione 1
    </x-bootstrap-italia.dropdown-item>
    <x-bootstrap-italia.dropdown-item href="#">
        Opzione 2
    </x-bootstrap-italia.dropdown-item>
</x-bootstrap-italia.dropdown>

<!-- Dropdown allineato a destra -->
<x-bootstrap-italia.dropdown text="Menu" right variant="outline-primary">
    <x-bootstrap-italia.dropdown-item href="#">
        Profilo
    </x-bootstrap-italia.dropdown-item>
    <x-bootstrap-italia.dropdown-item href="#">
        Impostazioni
    </x-bootstrap-italia.dropdown-item>
    <x-bootstrap-italia.dropdown-divider />
    <x-bootstrap-italia.dropdown-item href="#" variant="danger">
        Logout
    </x-bootstrap-italia.dropdown-item>
</x-bootstrap-italia.dropdown>
--}}