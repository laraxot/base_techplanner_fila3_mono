# Configurazione Localizzazione Modulo CMS

## Panoramica

Il modulo CMS supporta la localizzazione completa per l'interfaccia utente, con supporto per italiano (it), inglese (en) e tedesco (de).

## Struttura File

```
Modules/Cms/lang/
├── it/                    # Italiano
│   ├── page.php          # Traduzioni pagine
│   ├── page_content.php  # Traduzioni contenuti pagine
│   ├── menu.php          # Traduzioni menu
│   └── components.php    # Traduzioni componenti
├── en/                    # Inglese
│   ├── page.php
│   ├── page_content.php
│   ├── menu.php
│   └── components.php
└── de/                    # Tedesco
    ├── page.php
    ├── page_content.php
    ├── menu.php
    └── components.php
```

## Problemi Identificati

### ⚠️ ERRORE CRITICO: Stringa ".model" nei File di Traduzione

**Data**: 2025-01-06

I file di traduzione contengono riferimenti errati alla stringa `".model"` che causano problemi di localizzazione:

- **File affetti**: `page.php`, `page_content.php`, `menu.php`
- **Problema**: Viene visualizzato ".model" invece di testo localizzato
- **Impatto**: Interfaccia utente confusa, impossibilità di tradurre correttamente

**Per dettagli completi e soluzioni**: [Problemi File Traduzione](translation-file-issues.md)

## Configurazione

### 1. Registrazione Service Provider

Il modulo CMS registra automaticamente i file di traduzione nel `CmsServiceProvider`:

```php
public function boot(): void
{
    parent::boot();
    
    // Carica le traduzioni del modulo
    $this->loadTranslationsFrom(__DIR__.'/../lang', 'cms');
}
```

### 2. Utilizzo nelle View

```blade
{{-- Utilizzo diretto --}}
{{ __('cms::page.title') }}

{{-- Con parametri --}}
{{ __('cms::page.welcome', ['name' => $user->name]) }}

{{-- Pluralizzazione --}}
{{ trans_choice('cms::page.items_count', $count, ['count' => $count]) }}
```

### 3. Utilizzo nei Componenti Filament

```php
protected function getFormSchema(): array
{
    return [
        Forms\Components\TextInput::make('title')
            ->label(__('cms::page.fields.title.label'))
            ->placeholder(__('cms::page.fields.title.placeholder'))
            ->helperText(__('cms::page.fields.title.help'))
            ->required(),
    ];
}
```

## Struttura Traduzioni

### Struttura Espansa Obbligatoria

Ogni campo deve seguire la struttura completa:

```php
'fields' => [
    'title' => [
        'label' => 'Titolo',
        'placeholder' => 'Inserisci il titolo',
        'help' => 'Il titolo della pagina',
        'validation' => [
            'required' => 'Il titolo è obbligatorio',
            'max' => 'Il titolo non può superare :max caratteri',
        ],
    ],
],
```

### Esempi di Struttura

#### Pagine

```php
'page' => [
    'title' => 'Gestione Pagine',
    'create' => 'Crea Nuova Pagina',
    'edit' => 'Modifica Pagina',
    'fields' => [
        'title' => [
            'label' => 'Titolo',
            'placeholder' => 'Inserisci il titolo della pagina',
            'help' => 'Il titolo sarà visibile nella navigazione',
        ],
        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'titolo-pagina',
            'help' => 'URL amichevole per la pagina',
        ],
    ],
],
```

#### Menu

```php
'menu' => [
    'title' => 'Gestione Menu',
    'fields' => [
        'name' => [
            'label' => 'Nome Menu',
            'placeholder' => 'Menu principale',
            'help' => 'Nome identificativo del menu',
        ],
        'location' => [
            'label' => 'Posizione',
            'placeholder' => 'Seleziona posizione',
            'help' => 'Dove verrà visualizzato il menu',
        ],
    ],
],
```

## Best Practices

### 1. Struttura Coerente

- Mantenere la stessa struttura per tutti i file di traduzione
- Utilizzare chiavi descrittive e organizzate gerarchicamente
- Evitare duplicazioni tra file diversi

### 2. Localizzazione Completa

- Tradurre tutti i testi visibili all'utente
- Includere sempre label, placeholder e help text
- Aggiungere messaggi di validazione appropriati

### 3. Manutenzione

- Aggiornare le traduzioni quando si modificano le funzionalità
- Verificare la coerenza tra le diverse lingue
- Testare l'interfaccia in tutte le lingue supportate

### 4. Debug e Troubleshooting

```bash
# Verifica traduzioni mancanti
php artisan translation:missing-keys --module=Cms

# Verifica traduzioni non utilizzate
php artisan translation:unused-keys --module=Cms

# Sincronizzazione chiavi
php artisan translation:sync-keys --module=Cms
```

## Verifica e Testing

### 1. Test Interfaccia

- Verificare che tutti i campi mostrino testo localizzato
- Controllare che i placeholder siano appropriati
- Testare i messaggi di validazione

### 2. Test Lingue

- Cambiare lingua dell'interfaccia
- Verificare che le traduzioni funzionino correttamente
- Controllare la coerenza tra le diverse lingue

### 3. Test PHPStan

```bash
cd /var/www/html/_bases/base_techplanner_fila3_mono/laravel
./vendor/bin/phpstan analyze Modules/Cms --level=9
```

## Collegamenti Correlati

- [Problemi File Traduzione](translation-file-issues.md)
- [Best Practices Traduzioni](../../../docs/translation-standards.md)
- [Struttura File Lingua](../../../docs/localization-structure.md)
- [Documentazione Modulo CMS](../README.md)

---

**Ultimo aggiornamento**: 2025-01-06
**Stato**: Documentazione aggiornata con problemi identificati
**Versione**: 2.0
