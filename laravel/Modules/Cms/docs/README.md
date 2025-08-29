# Modulo CMS - Content Management System

## Descrizione
Il modulo CMS fornisce un sistema completo di gestione dei contenuti per l'applicazione Laravel, includendo componenti, blocchi, sezioni e temi personalizzabili.

## Caratteristiche Principali

### Componenti
- **Footer**: Componente footer responsive con menu e social link
- **Header**: Header principale con navigazione e logo
- **Navigation**: Menu di navigazione multilingua
- **Breadcrumb**: Navigazione a breadcrumb
- **Pagination**: Sistema di paginazione personalizzabile

### Blocchi
- **Text**: Blocchi di testo con formattazione rich text
- **Image**: Gestione immagini con ottimizzazioni
- **Gallery**: Gallerie di immagini responsive
- **Video**: Embed video da YouTube, Vimeo e altri servizi
- **Form**: Form di contatto e iscrizione

### Sezioni
- **Hero**: Sezioni hero con call-to-action
- **Features**: Sezioni caratteristiche prodotto/servizio
- **Testimonials**: Testimonianze clienti
- **Contact**: Sezioni contatto e mappe
- **Footer**: Sezioni footer con informazioni e link

### Temi
- **One**: Tema moderno e minimalista
- **Sixteen**: Tema business professionale
- **Custom**: Sistema di temi personalizzabili

## Installazione

### Requisiti
- Laravel 10.x o superiore
- PHP 8.1 o superiore
- Composer 2.0 o superiore

### Installazione via Composer
```bash
composer require modules/cms
```

### Pubblicazione Assets
```bash
php artisan vendor:publish --tag=cms-assets
```

### Esecuzione Migrazioni
```bash
php artisan migrate
```

## Utilizzo Base

### Rendering Componente
```php
// In Blade templates
<x-cms::components.footer />

// In Livewire
<x-cms::components.header />
```

### Rendering Sezione
```php
// Sezione con slug specifico
<x-cms::section slug="hero" />

// Sezione con dati personalizzati
<x-cms::section slug="footer" :data="$footerData" />
```

### Rendering Blocco
```php
// Blocco di testo
<x-cms::blocks.text :data="$textData" />

// Blocco immagine
<x-cms::blocks.image :data="$imageData" />
```

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

// Registrare nel ServiceProvider
Blade::componentNamespace('Themes\\CustomTheme\\View\\Components', 'custom');
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

