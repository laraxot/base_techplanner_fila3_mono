{{-- 
/**
 * Tab Component - Bootstrap Italia Compliant
 * 
 * Tab navigation for content organization and switching
 * Supports horizontal/vertical orientation, icons, full-width, and accessibility
 * 
 * @param string $id Unique ID for the tab container
 * @param array $tabs Array of tab configurations
 * @param string $orientation Orientation: 'horizontal' or 'vertical'
 * @param bool $fullWidth Whether tabs should occupy full width (.auto class)
 * @param string $position Tab position: 'top', 'bottom', 'left', 'right'
 * @param bool $dark Whether to use dark background theme
 * @param bool $card Whether to use card-style tabs
 * @param string $activeTab ID of initially active tab
 * @param bool $fade Whether to use fade transition
 * @param bool $noScrollbar Whether to hide scrollbars on touch devices
 */
--}}

@props([
    'id' => 'tabs-' . uniqid(),
    'tabs' => [],
    'orientation' => 'horizontal', // 'horizontal' or 'vertical'
    'fullWidth' => false,
    'position' => 'top', // 'top', 'bottom', 'left', 'right'
    'dark' => false,
    'card' => false,
    'activeTab' => '',
    'fade' => true,
    'noScrollbar' => false
])

@php
    $navClasses = collect(['nav']);
    
    if ($card) {
        $navClasses->push('nav-tabs-card');
    } else {
        $navClasses->push('nav-tabs');
    }
    
    if ($fullWidth) {
        $navClasses->push('auto');
    }
    
    if ($dark) {
        $navClasses->push('nav-dark');
    }
    
    if ($noScrollbar) {
        $navClasses->push('nav-tabs-no-scroll');
    }
    
    // Orientation and position classes
    switch ($orientation) {
        case 'vertical':
            $navClasses->push('flex-column');
            if ($position === 'right') {
                $navClasses->push('nav-tabs-right');
            }
            break;
        case 'horizontal':
            if ($position === 'bottom') {
                $navClasses->push('nav-tabs-bottom');
            }
            break;
    }
    
    // Content container classes
    $contentClasses = collect(['tab-content']);
    if ($dark) {
        $contentClasses->push('tab-content-dark');
    }
    
    // Determine active tab
    $firstTab = !empty($tabs) ? array_key_first($tabs) : '';
    $activeTabId = $activeTab ?: $firstTab;
    
    // Generate unique IDs for tabs
    $tabsId = $id . '-tabs';
    $contentId = $id . '-content';
@endphp

@if($orientation === 'vertical' && ($position === 'left' || $position === 'right'))
    <div class="row">
        @if($position === 'left')
            <div class="col-3">
                @include.*pub_theme::bootstrap-italia.partials.tab-nav')
            </div>
            <div class="col-9">
                @include.*pub_theme::bootstrap-italia.partials.tab-content')
            </div>
        @else
            <div class="col-9">
                @include.*pub_theme::bootstrap-italia.partials.tab-content')
            </div>
            <div class="col-3">
                @include.*pub_theme::bootstrap-italia.partials.tab-nav')
                @include('pub_theme::bootstrap-italia.partials.tab-nav')
            </div>
            <div class="col-9">
                @include('pub_theme::bootstrap-italia.partials.tab-content')
            </div>
        @else
            <div class="col-9">
                @include('pub_theme::bootstrap-italia.partials.tab-content')
            </div>
            <div class="col-3">
                @include('pub_theme::bootstrap-italia.partials.tab-nav')
=======
            </div>
        @endif
    </div>
@else
    @if($position === 'bottom')
        @include.*pub_theme::bootstrap-italia.partials.tab-content')
        @include.*pub_theme::bootstrap-italia.partials.tab-nav')
    @else
        @include.*pub_theme::bootstrap-italia.partials.tab-nav')
        @include.*pub_theme::bootstrap-italia.partials.tab-content')
        @include('pub_theme::bootstrap-italia.partials.tab-content')
        @include('pub_theme::bootstrap-italia.partials.tab-nav')
    @else
        @include('pub_theme::bootstrap-italia.partials.tab-nav')
        @include('pub_theme::bootstrap-italia.partials.tab-content')
=======
    @endif
@endif

{{-- Tab Navigation Partial --}}
@php
$tabNavPartial = function() use ($navClasses, $tabsId, $tabs, $activeTabId) {
    echo '<ul class="' . $navClasses->implode(' ') . '" id="' . $tabsId . '" role="tablist">';
    
    foreach ($tabs as $tabId => $tab) {
        $isActive = $tabId === $activeTabId;
        $isDisabled = isset($tab['disabled']) && $tab['disabled'];
        
        $linkClasses = collect(['nav-link']);
        if ($isActive) {
            $linkClasses->push('active');
        }
        if ($isDisabled) {
            $linkClasses->push('disabled');
        }
        
        $linkId = $tabId . '-tab';
        $panelId = $tabId;
        
        echo '<li class="nav-item">';
        echo '<a class="' . $linkClasses->implode(' ') . '" 
                 id="' . $linkId . '" 
                 data-bs-toggle="tab" 
                 href="#' . $panelId . '" 
                 role="tab" 
                 aria-controls="' . $panelId . '" 
                 aria-selected="' . ($isActive ? 'true' : 'false') . '"';
        
        if ($isDisabled) {
            echo ' aria-disabled="true" tabindex="-1"';
        }
        
        echo '>';
        
        // Icon
        if (isset($tab['icon'])) {
            $iconSize = isset($tab['iconSize']) ? 'icon-' . $tab['iconSize'] : 'icon-sm';
            echo '<svg class="icon ' . $iconSize . '" aria-hidden="true">';
            echo '<use href="#' . $tab['icon'] . '"></use>';
            echo '</svg>';
        }
        
        // Label
        if (isset($tab['label'])) {
            echo '<span>' . $tab['label'] . '</span>';
        }
        
        echo '</a>';
        echo '</li>';
    }
    
    echo '</ul>';
};
@endphp

{{-- Tab Content Partial --}}
@php
$tabContentPartial = function() use ($contentClasses, $contentId, $tabs, $activeTabId, $fade) {
    echo '<div class="' . $contentClasses->implode(' ') . '" id="' . $contentId . '">';
    
    foreach ($tabs as $tabId => $tab) {
        $isActive = $tabId === $activeTabId;
        
        $paneClasses = collect(['tab-pane']);
        if (isset($tab['padding']) && $tab['padding']) {
            $paneClasses->push('p-4');
        }
        if ($fade) {
            $paneClasses->push('fade');
        }
        if ($isActive) {
            $paneClasses->push('show', 'active');
        }
        
        $linkId = $tabId . '-tab';
        
        echo '<div class="' . $paneClasses->implode(' ') . '" 
                 id="' . $tabId . '" 
                 role="tabpanel" 
                 aria-labelledby="' . $linkId . '">';
        
        if (isset($tab['content'])) {
            echo $tab['content'];
        }
        
        echo '</div>';
    }
    
    echo '</div>';
};
@endphp

{{-- Render the partials --}}
@if($orientation === 'vertical' && ($position === 'left' || $position === 'right'))
    <div class="row">
        @if($position === 'left')
            <div class="col-3">
                @php $tabNavPartial(); @endphp
            </div>
            <div class="col-9">
                @php $tabContentPartial(); @endphp
            </div>
        @else
            <div class="col-9">
                @php $tabContentPartial(); @endphp
            </div>
            <div class="col-3">
                @php $tabNavPartial(); @endphp
            </div>
        @endif
    </div>
@else
    @if($position === 'bottom')
        @php $tabContentPartial(); @endphp
        @php $tabNavPartial(); @endphp
    @else
        @php $tabNavPartial(); @endphp
        @php $tabContentPartial(); @endphp
    @endif
@endif

{{-- Additional slot content --}}
{{ $slot }}

{{-- 
Usage Examples:

1. Basic horizontal tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :tabs="[
        'tab1' => [
            'label' => 'Tab 1',
            'content' => 'Contenuto del primo tab',
            'padding' => true
        ],
        'tab2' => [
            'label' => 'Tab 2',
            'content' => 'Contenuto del secondo tab',
            'padding' => true
        ],
        'tab3' => [
            'label' => 'Tab 3',
            'content' => 'Contenuto del terzo tab',
            'padding' => true
        ]
    ]"
    active-tab="tab1" />

2. Full-width tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :full-width="true"
    :tabs="[
        'overview' => [
            'label' => 'Panoramica',
            'content' => '<h4>Panoramica del servizio</h4><p>Informazioni generali sul servizio offerto.</p>',
            'padding' => true
        ],
        'details' => [
            'label' => 'Dettagli',
            'content' => '<h4>Dettagli tecnici</h4><p>Informazioni tecniche dettagliate.</p>',
            'padding' => true
        ],
        'contacts' => [
            'label' => 'Contatti',
            'content' => '<h4>Informazioni di contatto</h4><p>Come raggiungerci per assistenza.</p>',
            'padding' => true
        ]
    ]" />

3. Tabs with icons:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :tabs="[
        'home' => [
            'label' => 'Home',
            'icon' => 'it-home',
            'content' => 'Contenuto della home page',
            'padding' => true
        ],
        'services' => [
            'label' => 'Servizi',
            'icon' => 'it-settings',
            'iconSize' => 'lg',
            'content' => 'Elenco dei servizi disponibili',
            'padding' => true
        ],
        'profile' => [
            'label' => 'Profilo',
            'icon' => 'it-user',
            'content' => 'Informazioni del profilo utente',
            'padding' => true
        ]
    ]" />

4. Icon-only tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :tabs="[
        'dashboard' => [
            'icon' => 'it-chart-bar',
            'iconSize' => 'lg',
            'content' => 'Dashboard con statistiche',
            'padding' => true
        ],
        'messages' => [
            'icon' => 'it-comment',
            'iconSize' => 'lg',
            'content' => 'Centro messaggi',
            'padding' => true
        ],
        'settings' => [
            'icon' => 'it-settings',
            'iconSize' => 'lg',
            'content' => 'Impostazioni applicazione',
            'padding' => true
        ]
    ]" />

5. Tabs with disabled state:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :tabs="[
        'available' => [
            'label' => 'Disponibile',
            'content' => 'Funzionalità disponibile',
            'padding' => true
        ],
        'coming-soon' => [
            'label' => 'Prossimamente',
            'content' => 'Questa funzionalità sarà disponibile presto',
            'padding' => true,
            'disabled' => true
        ],
        'maintenance' => [
            'label' => 'Manutenzione',
            'content' => 'Sezione in manutenzione',
            'padding' => true,
            'disabled' => true
        ]
    ]" />

6. Vertical tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    orientation="vertical"
    position="left"
    :tabs="[
        'account' => [
            'label' => 'Account',
            'icon' => 'it-user',
            'content' => '<h4>Impostazioni Account</h4><p>Gestisci le tue informazioni personali.</p>',
            'padding' => true
        ],
        'security' => [
            'label' => 'Sicurezza',
            'icon' => 'it-lock',
            'content' => '<h4>Impostazioni di Sicurezza</h4><p>Password e autenticazione.</p>',
            'padding' => true
        ],
        'privacy' => [
            'label' => 'Privacy',
            'icon' => 'it-eye-off',
            'content' => '<h4>Impostazioni Privacy</h4><p>Controllo della privacy e visibilità.</p>',
            'padding' => true
        ]
    ]" />

7. Bottom positioned tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    position="bottom"
    :tabs="[
        'step1' => ['label' => 'Passo 1', 'content' => 'Primo passo del processo', 'padding' => true],
        'step2' => ['label' => 'Passo 2', 'content' => 'Secondo passo del processo', 'padding' => true],
        'step3' => ['label' => 'Passo 3', 'content' => 'Terzo passo del processo', 'padding' => true]
    ]" />

8. Dark theme tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :dark="true"
    :tabs="[
        'dark1' => ['label' => 'Dark Tab 1', 'content' => 'Contenuto tema scuro 1', 'padding' => true],
        'dark2' => ['label' => 'Dark Tab 2', 'content' => 'Contenuto tema scuro 2', 'padding' => true]
    ]" />

9. Card-style tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :card="true"
    :tabs="[
        'card1' => ['label' => 'Card 1', 'content' => 'Contenuto card-style 1', 'padding' => true],
        'card2' => ['label' => 'Card 2', 'content' => 'Contenuto card-style 2', 'padding' => true]
    ]" />

10. Complex content tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :full-width="true"
    :tabs="[
        'documents' => [
            'label' => 'Documenti',
            'icon' => 'it-file',
            'content' => '
                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <h5>Documenti recenti</h5>
                        <ul class=\"list-group\">
                            <li class=\"list-group-item\">Documento 1.pdf</li>
                            <li class=\"list-group-item\">Documento 2.pdf</li>
                        </ul>
                    </div>
                    <div class=\"col-md-6\">
                        <button class=\"btn btn-primary\">Carica nuovo documento</button>
                    </div>
                </div>
            ',
            'padding' => true
        ],
        'history' => [
            'label' => 'Storico',
            'icon' => 'it-calendar',
            'content' => '
                <table class=\"table\">
                    <thead>
                        <tr><th>Data</th><th>Azione</th><th>Stato</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>01/01/2024</td><td>Documento caricato</td><td>Completato</td></tr>
                    </tbody>
                </table>
            ',
            'padding' => true
        ]
    ]" />

11. Dynamic tabs with Alpine.js:
<div x-data="{ activeTab: 'info' }">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" 
               :class="{ 'active': activeTab === 'info' }"
               @click="activeTab = 'info'"
               href="#"
               role="tab">
                Informazioni
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               :class="{ 'active': activeTab === 'form' }"
               @click="activeTab = 'form'"
               href="#"
               role="tab">
                Modulo
            </a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane p-4"
             :class="{ 'show active': activeTab === 'info' }">
            <h4>Informazioni generali</h4>
            <p>Contenuto informativo.</p>
        </div>
        <div class="tab-pane p-4"
             :class="{ 'show active': activeTab === 'form' }">
            <h4>Modulo di contatto</h4>
            <form>
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        </div>
    </div>
</div>

12. Responsive tabs with mobile considerations:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    :no-scrollbar="true"
    :full-width="true"
    :tabs="[
        'mobile-tab1' => [
            'label' => 'Informazioni',
            'icon' => 'it-info-circle',
            'content' => 'Contenuto ottimizzato per mobile',
            'padding' => true
        ],
        'mobile-tab2' => [
            'label' => 'Servizi',
            'icon' => 'it-settings',
            'content' => 'Elenco servizi mobile-friendly',
            'padding' => true
        ],
        'mobile-tab3' => [
            'label' => 'Contatti',
            'icon' => 'it-mail',
            'content' => 'Informazioni di contatto',
            'padding' => true
        ]
    ]"
    class="d-block d-md-none" />

13. Administrative interface tabs:
<x-pub_theme::bootstrap-italia.tab 
<x-pub_theme::bootstrap-italia.tab 
=======
<x-pub_theme::bootstrap-italia.tab 
    orientation="vertical"
    position="left"
    :tabs="[
        'users' => [
            'label' => 'Utenti',
            'icon' => 'it-user',
            'content' => '
                <h4>Gestione Utenti</h4>
                <div class=\"d-flex justify-content-between mb-3\">
                    <span>Totale utenti: <strong>1,247</strong></span>
                    <button class=\"btn btn-primary btn-sm\">Aggiungi utente</button>
                </div>
                <div class=\"table-responsive\">
                    <!-- User table here -->
                </div>
            ',
            'padding' => true
        ],
        'permissions' => [
            'label' => 'Permessi',
            'icon' => 'it-key',
            'content' => '
                <h4>Gestione Permessi</h4>
                <p>Configura i permessi per ruoli e utenti.</p>
                <!-- Permissions management interface -->
            ',
            'padding' => true
        ],
        'system' => [
            'label' => 'Sistema',
            'icon' => 'it-settings',
            'content' => '
                <h4>Impostazioni Sistema</h4>
                <p>Configurazione generale del sistema.</p>
                <!-- System settings -->
            ',
            'padding' => true
        ]
    ]" />

Accessibility Features:
- Proper ARIA roles (tablist, tab, tabpanel)
- ARIA attributes (aria-controls, aria-selected, aria-labelledby)
- Keyboard navigation support with proper tabindex handling
- Screen reader friendly with semantic HTML structure
- Disabled state management with aria-disabled
- Focus management and visual indicators

Bootstrap Italia Integration:
- Uses official Bootstrap Italia tab classes and structure
- Compatible with Bootstrap Italia icon set
- Supports all documented variants (horizontal, vertical, positioned)
- Follows PA design system patterns and theming
- Responsive behavior with mobile considerations

Advanced Features:
- Multiple orientation and positioning options
- Icon support with size variants
- Full-width automatic sizing
- Dark theme support
- Card-style variant
- Fade transitions
- Touch device scrollbar handling
- Dynamic content loading support
--}}
