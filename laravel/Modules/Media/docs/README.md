# Media Module Documentation

Media module for Laraxot PTVX providing specialized functionality and business logic.

## Quick Reference

### Core Components
- **Business Logic**: Core Media functionality
- **Data Models**: Media-specific models and relationships
- **API Integration**: External service integrations
- **User Interface**: Filament resources and components
- **Configuration**: Module settings and options

## Documentation Structure

1. [Core Functionality](core-functionality.md) - Main business logic
2. [Data Models](data-models.md) - Models and relationships
3. [API Integration](api-integration.md) - External integrations
4. [User Interface](user-interface.md) - Filament components
5. [Configuration](configuration.md) - Settings and options
6. [Migration Patterns](migration-patterns.md) - Database patterns
7. [Best Practices](best-practices.md) - Development guidelines
8. [Troubleshooting](troubleshooting.md) - Common issues

## Business Logic Focus

- **Domain expertise**: Specialized Media functionality
- **Data integrity**: Robust data validation and storage
- **Integration**: Seamless system integration
- **Performance**: Optimized for business requirements
- **Scalability**: Designed for growth and expansion

## Quick Start

```php
// Basic usage example
$result = app(MediaService::class)->process($data);
```
<<<<<<< HEAD
=======

### 2. Trait HasMedia
```php
// ❌ NON FARE QUESTO
class User extends Model
{
    public function avatar()
    {
        return $this->hasOne(Media::class);
    }
}

// ✅ FARE QUESTO
use Modules\Media\Traits\HasMedia;

class User extends XotBaseModel
{
    use HasMedia;

    protected $fillable = [
        'name',
        'email'
    ];
}
```

### 3. Utilizzo in Filament
```php
// ❌ NON FARE QUESTO
use Filament\Forms\Components\FileUpload;

FileUpload::make('avatar')
    ->label('Avatar')

// ✅ FARE QUESTO
use Modules\Media\Filament\Components\XotBaseFileUpload;

XotBaseFileUpload::make('avatar')
    ->label(['label' => 'Avatar'])
```

## Best Practices

### 1. Upload
- Validare i file
- Generare nomi unici
- Gestire le conversioni
- Ottimizzare le immagini

### 2. Storage
```php
// ❌ NON FARE QUESTO
Storage::disk('public')->put($path, $file);

// ✅ FARE QUESTO
Media::upload($file, [
    'disk' => 'public',
    'conversions' => [
        'thumb' => [
            'width' => 100,
            'height' => 100
        ]
    ]
]);
```

### 3. Conversioni
```php
// ❌ NON FARE QUESTO
$image->resize(100, 100);

// ✅ FARE QUESTO
$media->convert('thumb', [
    'width' => 100,
    'height' => 100,
    'fit' => 'crop'
]);
```

## Dipendenze Principali

### Moduli
- **User**: Media utente
- **Xot**: Media base
- **Lang**: Traduzioni media

### Pacchetti
- Laravel Framework
- Filament
- Livewire
- Spatie Media Library

## Roadmap

### Prossime Feature
1. Nuovi tipi media
2. Miglioramento conversioni
3. Ottimizzazione storage

### Miglioramenti Pianificati
1. Refactoring media
2. Miglioramento UI
3. Ottimizzazione performance

## Contribuire

### Setup Sviluppo
1. Clona il repository
2. Installa le dipendenze
3. Configura l'ambiente
4. Esegui i test

### Convenzioni di Codice
- Seguire PSR-12
- Utilizzare type hints
- Documentare il codice
- Scrivere test unitari

### Processo di Pull Request
1. Crea un branch feature
2. Implementa le modifiche
3. Aggiungi i test
4. Aggiorna la documentazione
5. Crea la PR

## Troubleshooting

### Problemi Comuni
1. Upload fallito
2. Conversioni non funzionanti
3. Errori storage

### Soluzioni
1. Verifica configurazione
2. Controlla log
3. Consulta documentazione

## Riferimenti

### Documentazione
- [Laravel Storage](https://laravel.com/docs/12.x/filesystem)
- [Filament](https://filamentphp.com/docs)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary)

### Collegamenti Interni
- [User Module](../User/docs/README.md)
- [Xot Module](../Xot/docs/README.md)
- [Lang Module](../Lang/docs/README.md)

## Changelog

### [1.0.0] - 2024-03-20
#### Added
- Implementazione iniziale
- Sistema media
- Conversioni base
- Storage manager

#### Changed
- Miglioramento performance
- Ottimizzazione storage
- Refactoring codice

#### Fixed
- Bug upload
- Problemi conversioni
### Versione HEAD

- Errori storage 

### Versione Incoming

- Errori storage 
## Collegamenti
- [Modulo Xot](../../Xot/docs/README.md)
- [Modulo Cms](../../Cms/docs/README.md)
- [Modulo Lang](../../Lang/docs/README.md) 
## Collegamenti tra versioni di README.md
* [README.md](bashscripts/docs/README.md)
* [README.md](bashscripts/docs/it/README.md)
* [README.md](docs/laravel-app/phpstan/README.md)
* [README.md](docs/laravel-app/README.md)
* [README.md](docs/moduli/struttura/README.md)
* [README.md](docs/moduli/README.md)
* [README.md](docs/moduli/manutenzione/README.md)
* [README.md](docs/moduli/core/README.md)
* [README.md](docs/moduli/installati/README.md)
* [README.md](docs/moduli/comandi/README.md)
* [README.md](docs/phpstan/README.md)
* [README.md](docs/README.md)
* [README.md](docs/module-links/README.md)
* [README.md](docs/troubleshooting/git-conflicts/README.md)
* [README.md](docs/tecnico/laraxot/README.md)
* [README.md](docs/modules/README.md)
* [README.md](docs/conventions/README.md)
* [README.md](docs/amministrazione/backup/README.md)
* [README.md](docs/amministrazione/monitoraggio/README.md)
* [README.md](docs/amministrazione/deployment/README.md)
* [README.md](docs/translations/README.md)
* [README.md](docs/roadmap/README.md)
* [README.md](docs/ide/cursor/README.md)
* [README.md](docs/implementazione/api/README.md)
* [README.md](docs/implementazione/testing/README.md)
* [README.md](docs/implementazione/pazienti/README.md)
* [README.md](docs/implementazione/ui/README.md)
* [README.md](docs/implementazione/dental/README.md)


---

## Server MCP consigliati per Media

Per il modulo Media, si consiglia di utilizzare i seguenti server MCP:

- **sequential-thinking**: per orchestrare workflow di gestione media, automazione di processi di upload/download e revisione di asset multimediali.
- **memory**: per mantenere una knowledge base di file, immagini, video e storico delle operazioni media.
- **filesystem**: per esportare/importare file, immagini, video o gestire backup di asset multimediali.
- **postgres**: se il modulo utilizza un database PostgreSQL per archiviare metadati, log o riferimenti a file media.
- **puppeteer**: per automatizzare scraping di immagini/video da web, generazione di thumbnail, esportazione PDF o test di visualizzazione media.

**Nota:**
- Usa solo server MCP Node.js disponibili su npm e avviabili con `npx`.
- Configura sempre gli argomenti obbligatori (es. directory per filesystem, stringa di connessione per postgres).
- Non usare fetch, mysql o redis se non attivo.

Per dettagli e best practice consulta la guida generale MCP nel workspace.

## Proprietà fondamentali del ServiceProvider (Laraxot/PTVX)

Tutti i provider dei moduli che estendono XotBaseServiceProvider **devono** dichiarare:
- `protected string $module_dir = __DIR__;`
- `protected string $module_ns = __NAMESPACE__;`
- `public string $name = 'Media';`

Queste proprietà sono necessarie per:
- La risoluzione automatica dei path delle risorse
- Il corretto namespace per autoloading e publish
- L'identificazione del modulo nelle operazioni di asset publish

### Esempio
```php
class MediaServiceProvider extends XotBaseServiceProvider
{
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
    public string $name = 'Media';
}
```

**Motivazione:**  
- Se mancano queste proprietà, alcune risorse potrebbero non essere caricate correttamente.
- La dichiarazione esplicita garantisce portabilità, manutenibilità e coerenza tra tutti i moduli.

**Approfondimenti:**  
- Vedi anche [../../../../docs/PROVIDER_OVERVIEW.md](../../../../docs/PROVIDER_OVERVIEW.md)

## Regola per i file .sh (script shell)

Tutti i file `.sh` (script shell) devono essere posizionati esclusivamente in una sottocartella dedicata chiamata `bashscripts` (ad esempio `docs/bashscripts/`).
Non devono mai trovarsi direttamente nella root di `docs/` o in altre sottocartelle generiche.

**Motivazione:**
- Ordine e reperibilità: tutti gli script shell sono facilmente individuabili e gestibili.
- Sicurezza: si evita l'esecuzione accidentale di script non previsti.
- Coerenza cross-modulo e tra root/moduli.

**Esempio di struttura corretta:**
```
docs/
└── bashscripts/
    ├── deploy.sh
    ├── clear_cache.sh
    └── backup_db.sh
```

**Checklist aggiornata:**
- [x] Nessun file .sh fuori da bashscripts/
- [x] Documentazione aggiornata
- [x] Struttura coerente in tutti i moduli

>>>>>>> c59deef (.)
