{{-- 
/**
 * Bottom Navigation Component - Bootstrap Italia Compliant
 * 
 * Mobile-first bottom navigation bar for quick access to main sections
 * Typically used for mobile interfaces and progressive web apps
 * 
 * @param string $id Unique ID for the bottom navigation
 * @param array $items Navigation items with labels, icons, and URLs
 * @param bool $fixed Whether to use fixed positioning
 * @param bool $badges Whether to show badge indicators on items
 * @param string $theme Theme variant: 'light' or 'dark'
 * @param bool $hiddenOnDesktop Whether to hide on desktop viewports
 */
--}}

@props([
    'id' => 'bottom-nav-' . uniqid(),
    'items' => [],
    'fixed' => true,
    'badges' => false,
    'theme' => 'light', // 'light' or 'dark'
    'hiddenOnDesktop' => true
])

@php
    $navClasses = collect(['bottom-nav']);
    
    if ($fixed) {
        $navClasses->push('fixed-bottom');
    }
    
    if ($theme === 'dark') {
        $navClasses->push('bg-dark', 'navbar-dark');
    } else {
        $navClasses->push('bg-white', 'border-top');
    }
    
    if ($hiddenOnDesktop) {
        $navClasses->push('d-lg-none');
    }
@endphp

<nav 
    class="{{ $navClasses->implode(' ') }}" 
    id="{{ $id }}"
    role="navigation"
    aria-label="Navigazione principale mobile"
>
    <div class="container-fluid">
        @if(!empty($items))
            <ul class="nav nav-fill w-100" role="menubar">
                @foreach($items as $index => $item)
                    @php
                        $itemClasses = collect(['nav-item']);
                        $linkClasses = collect(['nav-link', 'text-center', 'd-flex', 'flex-column', 'align-items-center', 'justify-content-center']);
                        
                        if (isset($item['active']) && $item['active']) {
                            $linkClasses->push('active');
                            $itemClasses->push('active');
                        }
                        
                        if (isset($item['disabled']) && $item['disabled']) {
                            $linkClasses->push('disabled');
                        }
                    @endphp
                    
                    <li class="{{ $itemClasses->implode(' ') }}" role="none">
                        @if(isset($item['disabled']) && $item['disabled'])
                            <span 
                                class="{{ $linkClasses->implode(' ') }}" 
                                role="menuitem"
                                aria-disabled="true"
                            >
                                @if(isset($item['icon']))
                                    <svg class="icon icon-sm mb-1" aria-hidden="true">
                                        <use href="#{{ $item['icon'] }}"></use>
                                    </svg>
                                @endif
                                
                                <small class="bottom-nav-label">
                                    {{ $item['label'] }}
                                    @if($badges && isset($item['badge']))
                                        <span class="badge badge-sm bg-danger ms-1">{{ $item['badge'] }}</span>
                                    @endif
                                </small>
                            </span>
                        @else
                            <a 
                                href="{{ $item['url'] ?? '#' }}" 
                                class="{{ $linkClasses->implode(' ') }}"
                                role="menuitem"
                                @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
                                @if(isset($item['title'])) title="{{ $item['title'] }}" @endif
                                @if(isset($item['active']) && $item['active']) aria-current="page" @endif
                            >
                                @if(isset($item['icon']))
                                    <svg class="icon icon-sm mb-1" aria-hidden="true">
                                        <use href="#{{ $item['icon'] }}"></use>
                                    </svg>
                                @endif
                                
                                <small class="bottom-nav-label">
                                    {{ $item['label'] }}
                                    @if($badges && isset($item['badge']) && $item['badge'] > 0)
                                        <span class="badge badge-sm bg-danger ms-1" aria-label="{{ $item['badge'] }} {{ $item['badgeLabel'] ?? 'notifiche' }}">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </small>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            {{-- Slot-based content --}}
            <div class="nav nav-fill w-100">
                {{ $slot }}
            </div>
        @endif
    </div>
</nav>

{{-- Custom Styles for Bottom Navigation --}}
<style>
.bottom-nav {
    min-height: 64px;
    z-index: 1030;
    box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
}

.bottom-nav .nav-link {
    padding: 8px 4px;
    min-height: 56px;
    font-size: 0.75rem;
    line-height: 1;
    border: none;
    background: transparent;
    transition: all 0.2s ease;
}

.bottom-nav .nav-link:hover,
.bottom-nav .nav-link:focus {
    background-color: rgba(0,123,255,0.1);
}

.bottom-nav .nav-link.active {
    color: #0066CC;
    font-weight: 600;
}

.bottom-nav .nav-link.active .icon {
    color: #0066CC;
}

.bottom-nav .nav-link.disabled {
    opacity: 0.5;
    pointer-events: none;
}

.bottom-nav .icon {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
}

.bottom-nav .bottom-nav-label {
    display: block;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

.bottom-nav .badge {
    position: relative;
    top: -2px;
}

/* Dark theme styles */
.bottom-nav.bg-dark .nav-link:hover,
.bottom-nav.bg-dark .nav-link:focus {
    background-color: rgba(255,255,255,0.1);
}

.bottom-nav.bg-dark .nav-link.active {
    color: #66B3FF;
}

.bottom-nav.bg-dark .nav-link.active .icon {
    color: #66B3FF;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .bottom-nav .bottom-nav-label {
        font-size: 0.65rem;
    }
    
    .bottom-nav .icon {
        width: 20px;
        height: 20px;
    }
}
</style>

{{-- 
Usage Examples:

1. Basic bottom navigation:
<x-pub_theme::bootstrap-italia.bottom-nav 
    :items="[
        ['label' => 'Home', 'url' => '/', 'icon' => 'it-home', 'active' => true],
        ['label' => 'Servizi', 'url' => '/servizi', 'icon' => 'it-settings'],
        ['label' => 'Notizie', 'url' => '/notizie', 'icon' => 'it-file'],
        ['label' => 'Contatti', 'url' => '/contatti', 'icon' => 'it-mail']
    ]" />

2. Bottom nav with badges:
<x-pub_theme::bootstrap-italia.bottom-nav 
    :badges="true"
    :items="[
        ['label' => 'Home', 'url' => '/', 'icon' => 'it-home'],
        ['label' => 'Messaggi', 'url' => '/messaggi', 'icon' => 'it-comment', 'badge' => 3, 'badgeLabel' => 'messaggi non letti'],
        ['label' => 'Notifiche', 'url' => '/notifiche', 'icon' => 'it-bell', 'badge' => 12, 'badgeLabel' => 'notifiche'],
        ['label' => 'Profilo', 'url' => '/profilo', 'icon' => 'it-user']
    ]" />

3. Dark theme bottom navigation:
<x-pub_theme::bootstrap-italia.bottom-nav 
    theme="dark"
    :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'it-chart-line'],
        ['label' => 'Documenti', 'url' => '/documenti', 'icon' => 'it-folder'],
        ['label' => 'Scadenze', 'url' => '/scadenze', 'icon' => 'it-calendar'],
        ['label' => 'Impostazioni', 'url' => '/impostazioni', 'icon' => 'it-settings']
    ]" />

4. Non-fixed bottom navigation (visible on desktop):
<x-pub_theme::bootstrap-italia.bottom-nav 
    :fixed="false"
    :hidden-on-desktop="false"
    :items="[
        ['label' => 'Panoramica', 'url' => '/panoramica', 'icon' => 'it-chart-bar'],
        ['label' => 'Statistiche', 'url' => '/statistiche', 'icon' => 'it-chart-line'],
        ['label' => 'Report', 'url' => '/report', 'icon' => 'it-file'],
        ['label' => 'Esporta', 'url' => '/esporta', 'icon' => 'it-download']
    ]" />

5. Bottom nav with mixed states:
<x-pub_theme::bootstrap-italia.bottom-nav 
    :items="[
        ['label' => 'Principale', 'url' => '/', 'icon' => 'it-home', 'active' => true],
        ['label' => 'Ricerca', 'url' => '/ricerca', 'icon' => 'it-search'],
        ['label' => 'In arrivo', 'url' => '#', 'icon' => 'it-plus-circle', 'disabled' => true, 'title' => 'Funzionalità in arrivo'],
        ['label' => 'Menu', 'url' => '/menu', 'icon' => 'it-burger']
    ]" />

6. Custom content with slot:
<x-pub_theme::bootstrap-italia.bottom-nav>
    <a href="/" class="nav-link text-center d-flex flex-column align-items-center active">
        <svg class="icon icon-sm mb-1">
            <use href="#it-home"></use>
        </svg>
        <small>Home</small>
    </a>
    
    <a href="/custom" class="nav-link text-center d-flex flex-column align-items-center">
        <svg class="icon icon-sm mb-1">
            <use href="#it-star-outline"></use>
        </svg>
        <small>Custom</small>
    </a>
    
    <button class="nav-link text-center d-flex flex-column align-items-center" onclick="openModal()">
        <svg class="icon icon-sm mb-1">
            <use href="#it-plus"></use>
        </svg>
        <small>Azione</small>
    </button>
</x-pub_theme::bootstrap-italia.bottom-nav>

7. Administrative area navigation:
<x-pub_theme::bootstrap-italia.bottom-nav 
    :badges="true"
    :items="[
        ['label' => 'Dashboard', 'url' => '/admin', 'icon' => 'it-chart-bar', 'active' => true],
        ['label' => 'Pratiche', 'url' => '/admin/pratiche', 'icon' => 'it-file', 'badge' => 5, 'badgeLabel' => 'pratiche in sospeso'],
        ['label' => 'Cittadini', 'url' => '/admin/cittadini', 'icon' => 'it-user'],
        ['label' => 'Sistema', 'url' => '/admin/sistema', 'icon' => 'it-settings']
    ]" />

Responsive Behavior:
- By default, bottom navigation is hidden on desktop (lg breakpoint and above)
- Use :hidden-on-desktop="false" to show on all screen sizes
- Icons and text size adjust for smaller screens
- Touch-friendly hit targets (minimum 44px)

Accessibility Features:
- Proper ARIA roles and labels
- Screen reader friendly badge announcements
- Keyboard navigation support
- Active state indication with aria-current
- Disabled state with aria-disabled

Bootstrap Italia Integration:
- Uses standard Bootstrap Italia icon set
- Follows PA color schemes and accessibility guidelines
- Compatible with Bootstrap Italia navigation patterns
- Supports both light and dark themes
--}}
