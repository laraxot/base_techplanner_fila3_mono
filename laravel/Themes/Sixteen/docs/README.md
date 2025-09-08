# Tema Sixteen - Bootstrap Italia per Laravel/Tailwind

## 🎯 Panoramica del Progetto

Il tema Sixteen è un'implementazione completa delle **Linee Guida AGID per il Design della PA Italiana** utilizzando **Laravel**, **Filament** e **Tailwind CSS**. Il tema fornisce una migrazione moderna da Bootstrap Italia, mantenendo la piena conformità alle specifiche AGID con un'architettura più flessibile e performante.

## 📊 Stato Implementazione AGID

### 📈 Compliance Generale
- **Componenti Bootstrap Italia**: 16/54+ implementati (30%)
- **Accessibilità**: WCAG 2.1 AA parziale
- **Design System**: Colori e tipografia base
- **Requisiti Legali**: In implementazione

### 📋 Documentazione Aggiornata
- **[Analisi Compliance AGID](agid-compliance-analysis.md)** - Analisi completa requisiti
- **[Roadmap Componenti Mancanti](missing-components-roadmap.md)** - Piano implementazione 38+ componenti
- **[Stato Componenti](components-status.md)** - Stato dettagliato implementazione

## 🏛️ Conformità PA Italiana

### Requisiti AGID Soddisfatti
- ✅ **Design System**: Colori, tipografia, spaziature conformi
- ✅ **Accessibilità**: WCAG 2.1 AA con skiplinks e navigation
- ✅ **Responsive**: Mobile-first, touch-friendly
- ✅ **Multilingual**: Supporto italiano/inglese
- ✅ **Performance**: Ottimizzato per dispositivi PA

### Requisiti AGID Mancanti  
- ❌ **SPID Authentication**: Componente login SPID
- ❌ **PagoPA Payments**: Integrazione pagamenti PA
- ❌ **Complete Forms**: Date/time pickers, validazione avanzata
- ❌ **Icon System**: Libreria completa SVG Bootstrap Italia

## 🚀 Avvio Rapido

### Installazione
```bash
# Clone del tema
cd themes/
git clone [repository-url] Sixteen

# Installazione dipendenze
cd Sixteen
npm install
composer install

# Build assets
npm run build
```

### Configurazione Laravel
```php
// config/app.php
'providers' => [
    Themes\Sixteen\Providers\SixteenServiceProvider::class,
],
```

### Configurazione Filament
```php
// app/Providers/AdminPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('themes/sixteen/resources/css/app.css')
        ->theme('sixteen');
}
```

## 📁 Struttura del Progetto

```
Themes/Sixteen/
├── docs/                           # 📚 Documentazione completa
│   ├── agid-bootstrap-italia-gap-analysis.md  # Gap analysis AGID
│   ├── bootstrap-italia-compliance-analysis.md # Stato compliance
│   ├── components-status.md        # Stato componenti
│   └── index.md                    # Indice documentazione
├── resources/views/components/
│   └── bootstrap-italia/           # 🎨 Componenti AGID
│       ├── alert.blade.php         # ✅ Messaggi di stato
│       ├── badge.blade.php         # ✅ Indicatori stato
│       ├── breadcrumb.blade.php    # ✅ Navigazione breadcrumb
│       ├── button.blade.php        # ✅ Pulsanti PA-compliant
│       ├── card.blade.php          # ✅ Contenitori contenuto
│       ├── carousel.blade.php      # ✅ Slider contenuti
│       ├── cookiebar.blade.php     # ✅ GDPR compliance
│       ├── footer.blade.php        # ✅ Piè di pagina PA
│       ├── header-main.blade.php   # ✅ Header principale
│       ├── header-slim.blade.php   # ✅ Barra istituzionale
│       ├── hero.blade.php          # ✅ Sezioni hero
│       ├── megamenu.blade.php      # ✅ Menu complessi
│       ├── notification.blade.php  # ✅ Notifiche toast
│       ├── progress.blade.php      # ✅ Barre progresso
│       ├── radio.blade.php         # ✅ Radio button
│       ├── rating.blade.php        # ✅ Sistema valutazioni
│       ├── select.blade.php        # ✅ Dropdown selezione
│       ├── sidebar.blade.php       # ✅ Navigazione laterale
│       ├── skiplinks.blade.php     # ✅ Accessibilità WCAG
│       ├── tabs.blade.php          # ✅ Interfacce a schede
│       ├── toggle.blade.php        # ✅ Switch controlli
│       └── upload.blade.php        # ✅ Caricamento file
├── tailwind.config.js              # 🎨 Configurazione Tailwind
├── vite.config.js                  # ⚡ Build configuration
└── package.json                    # 📦 Dipendenze NPM
```

## 🎨 Sistema di Design

### Colori AGID Bootstrap Italia
```javascript
// Palette colori PA Italiana implementata in Tailwind
colors: {
    'italia-blue': {
        50: '#E3F2FD',
        500: '#0066CC',  // Primary PA blue
        900: '#003D7A'
    },
    'italia-green': {
        50: '#E8F5E8', 
        500: '#00B373', // Success green
        900: '#007A4F'
    },
    'italia-red': {
        50: '#FFEBEE',
        500: '#D9364F', // Error red  
        900: '#B71C1C'
    }
}
```

### Tipografia PA Compliant
```css
/* Font system conformi alle linee guida */
font-family: {
    'sans': ['Inter var', 'system-ui', 'sans-serif'],
    'serif': ['Lora', 'Georgia', 'serif'],
    'mono': ['Roboto Mono', 'monospace']
}
```

## 🔧 Utilizzo Componenti

### Header PA Standard
```blade
<x-bootstrap-italia.header-slim
    :institution="'Comune di Roma'"
    :links="[
        ['url' => '#', 'text' => 'Amministrazione Trasparente'],
        ['url' => '#', 'text' => 'URP']
    ]"
/>

<x-bootstrap-italia.header-main
    :site-name="'Sito Comunale'"
    :tagline="'Servizi digitali per i cittadini'"
    :navigation="$mainNavigation"
    show-search
/>
```

### Form PA Compliant
```blade
<form class="space-y-6">
    <x-bootstrap-italia.select
        name="provincia"
        label="Provincia di residenza"
        :options="$province"
        placeholder="Seleziona provincia"
        required
    />
    
    <x-bootstrap-italia.radio
        name="servizio"
        label="Tipo di servizio richiesto"
        :options="[
            'certificati' => 'Certificati anagrafici',
            'tributi' => 'Tributi e pagamenti',
            'pratiche' => 'Pratiche edilizie'
        ]"
        required
    />
    
    <x-bootstrap-italia.upload
        name="documenti"
        label="Documenti allegati"
        accept=".pdf,.doc,.docx"
        multiple
    />
</form>
```

### Notifiche e Feedback
```blade
{{-- Notifica successo --}}
<x-bootstrap-italia.notification
    type="success"
    title="Richiesta inviata"
    message="La tua richiesta è stata inviata correttamente"
    dismissible
/>

{{-- Progress indicator per processi lunghi --}}
<x-bootstrap-italia.progress-indicators
    :steps="[
        'Compilazione dati',
        'Verifica documenti', 
        'Pagamento',
        'Conferma'
    ]"
    :current-step="2"
/>
```

### Accessibilità Built-in
```blade
{{-- Skiplinks per navigazione da tastiera --}}
<x-bootstrap-italia.skiplinks
    :links="[
        '#main-content' => 'Vai al contenuto principale',
        '#main-navigation' => 'Vai al menu principale',
        '#footer' => 'Vai al footer'
    ]"
/>
```

## ♿ Accessibilità WCAG 2.1 AA

### Funzionalità Implementate
- ✅ **Skiplinks**: Navigazione rapida da tastiera
- ✅ **Contrasto Colori**: Rapporto ≥ 4.5:1 per testo normale
- ✅ **Focus Visibile**: Indicatori focus chiari su tutti gli elementi interattivi  
- ✅ **Markup Semantico**: Struttura HTML corretta con landmark ARIA
- ✅ **Label Accessibili**: Tutti i form field hanno label associate
- ✅ **ARIA Attributes**: Supporto completo per screen reader

### Test di Accessibilità
```bash
# Test automatici con axe-core
npm run test:a11y

# Audit manuale con screen reader
# - NVDA (Windows)
# - VoiceOver (macOS)  
# - Orca (Linux)
```

## 📈 Roadmap Sviluppo

### 🚨 Priorità CRITICA (Prossime 2-3 settimane)
1. **Dropdown Component** - Essenziale per navigazione e form
2. **Pagination Component** - Richiesto per dataset PA
3. **SPID Integration** - Obbligatorio per autenticazione PA
4. **Form completi** - Date/time picker, autocomplete

### 🔥 Priorità ALTA (1-2 mesi)  
1. **PagoPA Integration** - Pagamenti PA
2. **Tooltip/Popover** - UX e accessibilità
3. **Steppers** - Processi multi-step
4. **Complete Icon System** - Libreria SVG Bootstrap Italia

### 📈 Priorità MEDIA (2-3 mesi)
1. **Timeline Component** - Visualizzazione processi
2. **Advanced UX** - Callout, Collapse, Avatar
3. **Performance Optimization** - Bundle size, lazy loading
4. **Documentation** - Guide complete utilizzo

## 🧪 Testing e Qualità

### Test Automatici
```bash
# Test componenti Laravel
php artisan test --filter=SixteenTheme

# Test accessibilità  
npm run test:a11y

# Test performance
npm run lighthouse
```

### Metriche Qualità Target
- **Accessibilità**: 100% WCAG 2.1 AA
- **Performance**: Lighthouse Score > 90
- **Bundle Size**: CSS < 300KB, JS < 200KB
- **Coverage**: Test coverage > 80%

## 📚 Documentazione Completa

### Guide Specializzate
- **[📊 Stato Componenti](components-status.md)** - Inventario completo implementazione
- **[🔍 Gap Analysis AGID](agid-bootstrap-italia-gap-analysis.md)** - Analisi conformità PA
- **[🔧 Bootstrap Italia → Tailwind](bootstrap-italia-to-tailwind.md)** - Guida migrazione
- **[📋 Indice Completo](index.md)** - Navigazione documentazione

### Risorse Esterne
- [Bootstrap Italia Documentation](https://italia.github.io/bootstrap-italia/docs/)
- [AGID Design Guidelines](https://www.agid.gov.it/it/argomenti/linee-guida-design-pa)  
- [Design Comuni Documentation](https://docs.italia.it/italia/designers-italia/design-comuni-docs/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

## 🤝 Contribuire

### Come Contribuire
1. **Fork** del repository
2. **Create feature branch** (`git checkout -b feature/nuovo-componente`)
3. **Implementa** seguendo le linee guida AGID
4. **Testa** accessibilità e performance
5. **Documenta** le modificare
6. **Submit Pull Request**

### Guidelines Sviluppo
- Seguire convenzioni nomenclatura esistenti
- Implementare test automatici per nuovi componenti
- Verificare conformità WCAG 2.1 AA
- Documentare API e utilizzo componenti
- Ottimizzare per performance

---

## 🏅 Status Badge

![AGID Compliance](https://img.shields.io/badge/AGID-48%25%20Compliant-yellow)
![WCAG 2.1](https://img.shields.io/badge/WCAG%202.1-AA-green)
![Laravel](https://img.shields.io/badge/Laravel-12+-red)
![Tailwind](https://img.shields.io/badge/Tailwind-3.4+-blue)

**Versione**: 2.0.0  
**Ultimo aggiornamento**: Settembre 1, 2025  
**Mantenuto da**: Team Bootstrap Italia Migration  
**Licenza**: MIT