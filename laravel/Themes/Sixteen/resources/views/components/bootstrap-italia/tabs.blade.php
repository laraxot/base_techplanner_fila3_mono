@props([
    'id' => 'tabs-' . uniqid(),
    'tabs' => [],
    'activeTab' => 0,
    'variant' => 'default',
    'justify' => 'start',
    'orientation' => 'horizontal'
])

@php
    $variants = [
        'default' => [
            'container' => '',
            'nav' => 'border-b border-gray-200',
            'tab' => 'py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all duration-200',
            'tabActive' => 'border-italia-blue-500 text-italia-blue-600',
            'content' => 'mt-4'
        ],
        'pills' => [
            'container' => '',
            'nav' => 'space-x-2',
            'tab' => 'px-4 py-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-all duration-200',
            'tabActive' => 'bg-italia-blue-100 text-italia-blue-800',
            'content' => 'mt-4'
        ],
        'underline' => [
            'container' => '',
            'nav' => 'border-b border-gray-200',
            'tab' => 'py-4 px-6 text-gray-500 hover:text-gray-700 transition-all duration-200 border-b-2 border-transparent',
            'tabActive' => 'text-italia-blue-600 border-italia-blue-500',
            'content' => 'mt-4'
        ]
    ];

    $justifyClasses = [
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
        'between' => 'justify-between',
        'around' => 'justify-around'
    ];

    $variantClasses = $variants[$variant] ?? $variants['default'];
    $justifyClass = $justifyClasses[$justify] ?? $justifyClasses['start'];
    $isHorizontal = $orientation === 'horizontal';
    
    $navClasses = $isHorizontal 
        ? "flex space-x-8 {$variantClasses['nav']} {$justifyClass}"
        : "flex flex-col space-y-1 {$variantClasses['nav']}";
        
    $contentClasses = $isHorizontal 
        ? $variantClasses['content']
        : 'ml-4';
@endphp

<div 
    {{ $attributes->merge(['class' => "tabs-container {$variantClasses['container']}"]) }}
    x-data="{
        activeTab: {{ $activeTab }},
        tabs: {{ count($tabs) }},
        
        setActiveTab(index) {
            this.activeTab = index;
        },
        
        isActive(index) {
            return this.activeTab === index;
        }
    }"
>
    <!-- Tabs Navigation -->
    <nav class="{{ $navClasses }}" role="tablist">
        @foreach($tabs as $index => $tab)
            @php
                $tabId = "{$id}-tab-{$index}";
                $panelId = "{$id}-panel-{$index}";
                $isActive = $index == $activeTab;
            @endphp
            
            <button
                id="{{ $tabId }}"
                class="tab-button {{ $variantClasses['tab'] }} {{ $isActive ? $variantClasses['tabActive'] : '' }}"
                :class="{ '{{ $variantClasses['tabActive'] }}': isActive({{ $index }}) }"
                @click="setActiveTab({{ $index }})"
                role="tab"
                :aria-selected="isActive({{ $index }}).toString()"
                aria-controls="{{ $panelId }}"
                type="button"
            >
                {{ $tab['label'] ?? "Tab " . ($index + 1) }}
            </button>
        @endforeach
    </nav>

    <!-- Tabs Content -->
    <div class="{{ $contentClasses }}">
        @foreach($tabs as $index => $tab)
            @php
                $panelId = "{$id}-panel-{$index}";
                $tabId = "{$id}-tab-{$index}";
            @endphp
            
            <div
                id="{{ $panelId }}"
                class="tab-panel"
                x-show="isActive({{ $index }})"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2"
                role="tabpanel"
                aria-labelledby="{{ $tabId }}"
                :aria-hidden="!isActive({{ $index }}).toString()"
            >
                {!! $tab['content'] ?? $tab !!}
            </div>
        @endforeach
    </div>
</div>