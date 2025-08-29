<<<<<<< HEAD
<<<<<<< HEAD
# Modulo Cms - Content Management System
=======
# CMS Module Documentation
>>>>>>> 4355c39 (.)

## Overview

The CMS (Content Management System) module provides a complete content management solution for Laravel applications, featuring components, blocks, sections, and customizable themes with full multilingual support.

## Quick Navigation

### 📚 Getting Started
- **[01 - Getting Started](01-getting-started.md)** - Installation, configuration, and quick start
- **[02 - Architecture](02-architecture.md)** - Module structure and design patterns
- **[03 - Components](03-components.md)** - Working with reusable components
- **[04 - Content Management](04-content-management.md)** - Pages, sections, and content strategies

### ⚙️ Core Features
- **[05 - Filament Integration](05-filament-integration.md)** - Admin panel and resource management
- **[06 - Theming](06-theming.md)** - Creating and customizing themes
- **[07 - Localization](07-localization.md)** - Multi-language setup and translations
- **[08 - Testing](08-testing.md)** - Testing strategies and guidelines

### 🔧 Specialized Topics
- **[Blocks System](blocks/README.md)** - Modular content blocks
- **[Sections Guide](sections/README.md)** - Reusable page sections
- **[Performance Optimization](performance-optimization.md)** - Caching and optimization
- **[Troubleshooting](troubleshooting.md)** - Common issues and solutions

### 🌍 Localization
- **[Localization Setup](localization/localization-setup.md)** - Translation configuration
- **[Translation Issues](localization/translation-file-issues.md)** - 🚨 Critical: ".model" string fixes

## Key Features

### 🧩 Components
- **Reusable UI Components**: Header, footer, navigation, forms
- **Data Display**: Tables, lists, charts, progress indicators
- **Interactive Elements**: Buttons, forms, modals, dropdowns
- **Theme Integration**: Automatic theme adaptation

### 📦 Blocks System
- **Content Blocks**: Text, images, galleries, videos
- **Layout Blocks**: Sections, columns, grids, carousels
- **Interactive Blocks**: Contact forms, CTAs, newsletters
- **Custom Blocks**: Create your own modular components

### 📄 Content Management
- **Pages**: Full page management with SEO optimization
- **Sections**: Reusable content areas across pages
- **Multilingual**: Complete translation support
- **Version Control**: Content versioning and history

### 🎨 Theming
- **Multiple Themes**: One, Sixteen, and custom themes
- **Theme Reusability**: Business-agnostic, configurable themes
- **Asset Management**: Vite integration with optimization
- **Responsive Design**: Mobile-first, accessible interfaces

## Quick Start

### Installation Requirements
- Laravel 10.x or higher
- PHP 8.1 or higher
- Composer 2.0 or higher
- Node.js 16.x or higher (for assets)

### Basic Installation
```bash
# Install via Composer
composer require modules/cms

# Publish assets
php artisan vendor:publish --tag=cms-assets

# Run migrations
php artisan migrate

# Build frontend assets
npm install && npm run build
```

### Basic Usage Examples
```blade
{{-- Render components --}}
<x-cms::components.header />
<x-cms::components.footer />

{{-- Render sections --}}
<x-cms::section slug="hero" />
<x-cms::section slug="features" :data="$featuresData" />

{{-- Render blocks --}}
<x-cms::blocks.text :data="$textData" />
<x-cms::blocks.image :data="$imageData" />
```

## Documentation Structure

This documentation is organized into clear, sequential guides:

### Core Documentation
1. **Getting Started** - Installation and basic setup
2. **Architecture** - Understanding the module structure  
3. **Components** - Working with UI components
4. **Content Management** - Pages, sections, and content strategies
5. **Filament Integration** - Admin panel and resources
6. **Theming** - Creating and customizing themes
7. **Localization** - Multi-language support
8. **Testing** - Comprehensive testing strategies

### Specialized Guides
- **Blocks System** - Detailed guide to modular content blocks
- **Sections** - Reusable page sections and layouts
- **Performance** - Optimization strategies and caching
- **Troubleshooting** - Common issues and debugging

## Configurazione

### File di Configurazione
```php
// config/cms.php
return [
    'default_theme' => 'one',
    'cache_enabled' => true,
    'cache_ttl' => 3600,
    'upload_path' => 'uploads/cms',
    'image_sizes' => [
        'thumbnail' => [150, 150],
        'medium' => [300, 300],
        'large' => [800, 600],
    ],
];
```

### Variabili d'Ambiente
```env
CMS_DEFAULT_THEME=one
CMS_CACHE_ENABLED=true
CMS_UPLOAD_PATH=uploads/cms
CMS_IMAGE_QUALITY=85
```

## API

### Endpoint Principali
- `GET /api/cms/sections` - Lista sezioni
- `GET /api/cms/sections/{id}` - Dettagli sezione
- `POST /api/cms/sections` - Crea sezione
- `PUT /api/cms/sections/{id}` - Aggiorna sezione
- `DELETE /api/cms/sections/{id}` - Elimina sezione

### Autenticazione
```php
// Middleware per proteggere endpoint
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('cms/sections', SectionController::class);
});
```

## Personalizzazione

### Temi Personalizzati
```php
// Creare nuovo tema
php artisan make:cms-theme CustomTheme

// Struttura tema
Themes/CustomTheme/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── lang/
└── config/
```

### Componenti Personalizzati
```php
// Creare nuovo componente
php artisan make:cms-component CustomComponent

<<<<<<< HEAD
## Funzionalità Principali
=======
# Modulo CMS
> **Collegamenti correlati**
> - [README.md documentazione generale SaluteOra](../../../../docs/README.md)
> - [README.md toolkit bashscripts](../../../../bashscripts/docs/README.md)
> - [README.md modulo CMS](../../../../laravel/Modules/Cms/docs/README.md)
> - [README.md modulo Dental](../../../../laravel/Modules/Dental/docs/README.md)
> - [README.md modulo GDPR](../../../../laravel/Modules/Gdpr/docs/README.md)
> - [README.md modulo User](../../../../laravel/Modules/User/docs/README.md)
> - [README.md modulo Lang](../../../../laravel/Modules/Lang/docs/README.md)
> - [README.md modulo Patient](../../../../laravel/Modules/Patient/docs/README.md)
> - [README.md modulo Activity](../../../../laravel/Modules/Activity/docs/README.md)
> - [README.md modulo Media](../../../../laravel/Modules/Media/docs/README.md)
> - [README.md modulo Notify](../../../../laravel/Modules/Notify/docs/README.md)
> - [README.md modulo Reporting](../../../../laravel/Modules/Reporting/docs/README.md)
> - [README.md modulo Tenant](../../../../laravel/Modules/Tenant/docs/README.md)
> - [README.md modulo UI](../../../../laravel/Modules/UI/docs/README.md)
> - [README.md modulo Xot](../../../../laravel/Modules/Xot/docs/README.md)
> - [README.md modulo Chart](../../../../laravel/Modules/Chart/docs/README.md)
> - [README.md tema One](../../../../laravel/Themes/One/docs/README.md)
> - [README.md tema Two](../../../../laravel/Themes/Two/docs/README.md)
> - [Collegamenti documentazione centrale](../../../../docs/collegamenti-documentazione.md)
>>>>>>> b85e13f (.)

### 1. Gestione Menu
- Creazione e gestione di menu dinamici
- Struttura gerarchica dei menu
- Supporto per localizzazione

### 2. Gestione Sezioni
- Creazione di sezioni di contenuto
- Layout flessibili e configurabili
- Integrazione con il sistema di temi

### 3. Content Management
- Editor di contenuti avanzato
- Gestione delle versioni
- Workflow di approvazione

## Architettura Filament

### Regole di Estensione
- **TUTTE** le risorse estendono `XotBaseResource`
- **TUTTE** le pagine estendono le classi XotBase appropriate
- **MAI** estendere direttamente le classi Filament

### Risorse Implementate
- `MenuResource`: Gestione menu dinamici
- `SectionResource`: Gestione sezioni di contenuto

## Stato Attuale e Problemi

### ✅ Corretto
- `MenuResource.php`: Estende correttamente `XotBaseResource`
- `SectionResource.php`: Estende correttamente `XotBaseResource`
- Pagine Section: Estendono correttamente le classi XotBase

### ❌ Da Correggere
- `CreateMenu.php`: Estende `CreateRecord` → Deve estendere `XotBaseCreateRecord`
- `EditMenu.php`: Estende `EditRecord` → Deve estendere `XotBaseEditRecord`

## Correzioni Necessarie

### Priorità Alta
1. **CreateMenu.php**: Correggere estensione classe
2. **EditMenu.php**: Correggere estensione classe
3. Verifica PHPStan livello 10
4. Test funzionali post-correzione

### Impatto
- Conformità alle regole architetturali XotBase
- Migliore manutenibilità del codice
- Consistenza con il resto del progetto

## Testing e Qualità

### PHPStan
```bash
# Verifica livello 10
./vendor/bin/phpstan analyse laravel/Modules/Cms/ --level=10
=======
// Registrare nel ServiceProvider
Blade::componentNamespace('Themes\\CustomTheme\\View\\Components', 'custom');
>>>>>>> 4355c39 (.)
```

## Performance

### Ottimizzazioni Implementate
- Cache delle view e componenti
- Lazy loading per immagini
- Minificazione CSS/JS
- Compressione gzip
- CDN per asset statici

### Metriche Target
- First Contentful Paint: < 1.5s
- Largest Contentful Paint: < 2.5s
- Cumulative Layout Shift: < 0.1
- Time to Interactive: < 3.5s

## Sicurezza

### Protezioni Implementate
- Validazione input rigorosa
- Sanitizzazione HTML
- Protezione CSRF
- Rate limiting
- Logging accessi

### Best Practices
- Utilizzare sempre validazione lato server
- Sanitizzare contenuti HTML
- Implementare autenticazione per operazioni admin
- Loggare tutte le operazioni critiche

## Testing

### Test Unitari
```bash
# Eseguire test unitari
php artisan test --filter=Cms

# Test specifici
php artisan test tests/Unit/Cms/ComponentTest.php
```

### Test Feature
```bash
# Test API
php artisan test tests/Feature/Cms/ApiTest.php

# Test componenti
php artisan test tests/Feature/Cms/ComponentTest.php
```

## Troubleshooting

### Problemi Comuni
- **View non trovata**: Verificare nome file `default.blade.php`
- **Componente non registrato**: Controllare ServiceProvider
- **Cache non aggiornata**: Eseguire `php artisan view:clear`

### Debug
```php
// Verificare esistenza view
if (view()->exists('cms::components.footer')) {
    echo "View footer esiste";
}

// Verificare componenti registrati
dd(app('blade.compiler')->getClassComponentAliases());
```

## Documentazione

### Guide Principali
- [Componenti](components/README.md) - Panoramica componenti disponibili
- [Blocchi](blocks/README.md) - Sistema di blocchi modulari
- [Sezioni](sections/README.md) - Gestione sezioni pagina
- [Temi](themes/README.md) - Sistema temi personalizzabili
- [API](api/README.md) - Documentazione API REST

### Localizzazione
- [Localizzazione](localization/README.md) - Sistema di traduzioni e localizzazione ⭐ **NUOVO**

### Troubleshooting
- [Troubleshooting](troubleshooting.md) - Problemi comuni e soluzioni

### Sviluppo
- [Architettura](architecture.md) - Architettura del modulo
- [Pattern](patterns/README.md) - Pattern di sviluppo
- [Convenzioni](conventions.md) - Convenzioni di codice

## Contribuire

### Setup Sviluppo
```bash
# Clonare repository
git clone https://github.com/username/cms-module.git

# Installare dipendenze
composer install

# Eseguire test
php artisan test
```

### Standard di Codice
- PSR-12 coding standards
- PHPStan livello 9+
- Test coverage > 80%
- Documentazione PHPDoc completa

### Pull Request
1. Fork del repository
2. Creare branch feature
3. Implementare modifiche
4. Aggiungere test
5. Aggiornare documentazione
6. Creare pull request

## Licenza
Questo modulo è rilasciato sotto licenza MIT. Vedi il file [LICENSE](LICENSE) per i dettagli.

## Supporto
- **Documentazione**: [docs/](docs/)
- **Issues**: [GitHub Issues](https://github.com/username/cms-module/issues)
- **Discussions**: [GitHub Discussions](https://github.com/username/cms-module/discussions)

## Changelog
Vedi [CHANGELOG.md](CHANGELOG.md) per la cronologia delle versioni.

---
**Ultimo aggiornamento**: 2025-01-06
**Versione**: 2.0.1
**Autore**: Team Sviluppo
**Compatibilità**: Laravel 10.x, PHP 8.1+

