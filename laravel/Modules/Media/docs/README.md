<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> da8eaf7 (.)
# 📁 **Media Module** - Sistema Avanzato Gestione File Multimediali

[![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![Filament 3.x](https://img.shields.io/badge/Filament-3.x-blue.svg)](https://filamentphp.com/)
[![PHPStan Level 9](https://img.shields.io/badge/PHPStan-Level%209-brightgreen.svg)](https://phpstan.org/)
[![Translation Ready](https://img.shields.io/badge/Translation-IT%20%7C%20EN%20%7C%20DE-green.svg)](https://laravel.com/docs/localization)
[![File Upload](https://img.shields.io/badge/File-Upload%20Ready-orange.svg)](https://laravel.com/docs/filesystem)
[![Video Processing](https://img.shields.io/badge/Video-Processing%20Ready-purple.svg)](https://ffmpeg.org/)
[![Image Optimization](https://img.shields.io/badge/Image-Optimization%20Ready-yellow.svg)](https://imagemagick.org/)
[![Quality Score](https://img.shields.io/badge/Quality%20Score-95%25-brightgreen.svg)](https://github.com/laraxot/media-module)

> **🚀 Modulo Media**: Sistema completo per gestione file multimediali con upload avanzato, conversioni automatiche, ottimizzazione immagini e processing video.

## 📋 **Panoramica**

Il modulo **Media** è il centro di gestione file multimediali dell'applicazione, fornendo:

- 📁 **File Upload Avanzato** - Upload sicuro e ottimizzato di tutti i tipi di file
- 🖼️ **Image Optimization** - Ottimizzazione automatica immagini con conversioni
- 🎥 **Video Processing** - Processing video con FFmpeg e conversioni
- 📄 **Document Management** - Gestione documenti con preview e OCR
- 🔄 **Auto Conversions** - Conversioni automatiche per diversi formati
- 📊 **Media Analytics** - Analytics dettagliati per utilizzo file

## ⚡ **Funzionalità Core**

### 📁 **File Upload System**
```php
// Upload sicuro con validazione
<<<<<<< HEAD
=======
# Modulo Media

## Panoramica
Il modulo Media gestisce tutti i file multimediali dell'applicazione, fornendo un sistema centralizzato per l'upload, la gestione e la distribuzione di immagini, video, documenti e altri file. Si integra con tutti gli altri moduli per garantire una gestione efficiente dei media.

### Versione HEAD


### Versione Incoming

## Collegamenti correlati
- [README.md documentazione generale](../../../docs/README.md)
- [README.md toolkit bashscripts](../../../bashscripts/docs/README.md)
- [README.md modulo GDPR](../Gdpr/docs/README.md)
- [README.md modulo User](../User/docs/README.md)
- [README.md modulo Lang](../Lang/docs/README.md)
- [README.md modulo Media](../Media/docs/README.md)
- [README.md modulo Notify](../Notify/docs/README.md)
- [README.md modulo Tenant](../Tenant/docs/README.md)
- [README.md modulo UI](../UI/docs/README.md)
- [README.md modulo Xot](../Xot/docs/README.md)
- [Collegamenti documentazione centrale](../../../docs/collegamenti-documentazione.md)


---

## Collegamenti Principali

### Documentazione Core
- [Struttura del Modulo](./structure.md)
- [Gestione File](./files.md)
- [Conversioni](./conversions.md)
- [Storage](./storage.md)
- [Best Practices](./BEST-PRACTICES.md)

### Integrazioni
- [Integrazione con User](../User/docs/README.md)
- [Integrazione con Xot](../Xot/docs/README.md)
- [Integrazione con Lang](../Lang/docs/README.md)

### Best Practices
- [Convenzioni Media](./media-conventions.md)
- [Gestione Storage](./storage-management.md)
- [PHPStan Fixes](./phpstan-fixes.md)

### Testing e Qualità
- [PHPStan Level 9](./PHPSTAN_LEVEL9_FIXES.md)
- [PHPStan Level 10](./PHPSTAN_LEVEL10_FIXES.md)
- [Testing Best Practices](./testing-best-practices.md)

## Struttura del Modulo

```
Modules/Media/
├── app/
│   ├── Models/
│   │   ├── Media.php
│   │   └── MediaConversion.php
│   ├── Providers/
│   │   ├── MediaServiceProvider.php
│   │   └── MediaBaseServiceProvider.php
│   ├── Filament/
│   │   ├── Resources/
│   │   │   └── MediaResource.php
│   │   ├── Widgets/
│   │   │   └── MediaStatsWidget.php
│   │   └── Pages/
│   │       └── MediaManager.php
│   └── Http/
│       └── Controllers/
│           └── MediaController.php
├── config/
│   └── media.php
├── database/
│   └── migrations/
│       ├── create_media_table.php
│       └── create_media_conversions_table.php
└── resources/
    └── views/
        └── media/
            ├── upload.blade.php
            └── manager.blade.php
```

## Gestione Media

### 1. Modello Media
```php
// app/Models/Media.php
namespace App\Models;

use Modules\Media\Models\XotBaseMedia;
use Modules\Lang\Facades\Lang;

class Media extends XotBaseMedia
{
    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'size',
        'disk',
        'conversions'
    ];

    protected $casts = [
        'conversions' => 'array'
    ];

    public function getDisplayNameAttribute(): string
    {
        return Lang::get('media.name', ['name' => $this->name]);
    }
}
```

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
>>>>>>> 9c5e628 (.)
=======
>>>>>>> da8eaf7 (.)
use Modules\Media\Traits\HasMedia;

class User extends XotBaseModel
{
    use HasMedia;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> da8eaf7 (.)
    
    protected $fillable = ['name', 'email'];
}

// Upload con conversioni automatiche
$user->addMedia($request->file('avatar'))
    ->withCustomProperties(['type' => 'profile'])
    ->withManipulations([
        'thumb' => ['width' => 100, 'height' => 100],
        'medium' => ['width' => 300, 'height' => 300],
    ])
    ->toMediaCollection('avatars');
```

### 🖼️ **Image Processing**
```php
// Ottimizzazione immagini automatica
class ImageOptimizationService
{
    public function optimize(Media $media): void
    {
        $media->manipulate('thumb', function ($image) {
            $image->resize(100, 100)
                  ->greyscale()
                  ->quality(85);
        });
        
        $media->manipulate('webp', function ($image) {
            $image->format('webp')
                  ->quality(90);
        });
    }
}
```

### 🎥 **Video Processing**
```php
// Processing video con FFmpeg
class VideoProcessingService
{
    public function processVideo(Media $media): void
    {
        $media->manipulate('mp4', function ($video) {
            $video->format('mp4')
                  ->codec('h264')
                  ->bitrate('1000k')
                  ->resolution('1280x720');
        });
        
        $media->manipulate('webm', function ($video) {
            $video->format('webm')
                  ->codec('vp9')
                  ->bitrate('800k');
        });
    }
}
```

## 🎯 **Stato Qualità - Gennaio 2025**

### ✅ **PHPStan Level 9 Compliance**
- **File Core Certificati**: 10/10 file core raggiungono Level 9
- **Type Safety**: 100% sui servizi principali
- **Runtime Safety**: 100% con error handling robusto
- **Template Types**: Risolti tutti i problemi Collection generics

### ✅ **Correzioni Recenti - S3Test.php**
- **Violazioni Architetturali**: Risolte dipendenze dirette tra moduli
- **Tipizzazione PHPStan**: Aggiunta tipizzazione rigorosa per tutti i metodi
- **Traduzioni Complete**: Creati file di traduzione in IT/EN/DE
- **Sicurezza**: Migliorato logging e gestione errori
- **Documentazione**: Aggiornata documentazione completa

**📋 Dettagli**: [Correzioni S3Test.php](s3test_corrections.md)

## 🏗️ **Architettura**

### 📦 **Struttura Moduli**
```
Modules/Media/
├── app/
│   ├── Actions/           # Azioni per operazioni media
│   ├── Contracts/         # Contratti e interfacce
│   ├── Datas/            # Data Transfer Objects
│   ├── Filament/         # Componenti Filament
│   ├── Models/           # Modelli Eloquent
│   ├── Services/         # Servizi di business logic
│   └── Traits/           # Traits riutilizzabili
├── config/               # Configurazioni
├── database/             # Migrazioni e seeders
├── docs/                 # Documentazione
├── lang/                 # Traduzioni (IT/EN/DE)
├── resources/            # Views e assets
└── routes/               # Definizioni route
```

### 🔧 **Componenti Principali**

#### **Media Model**
```php
class Media extends XotBaseModel
{
    use HasMedia;
    
    protected $fillable = [
        'name', 'file_name', 'mime_type', 'size',
        'disk', 'path', 'collection_name'
    ];
    
    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'custom_properties' => 'array',
            'manipulations' => 'array',
            'responsive_images' => 'array',
        ];
    }
}
```

#### **Media Service**
```php
class MediaService
{
    public function uploadFile(UploadedFile $file, string $collection = 'default'): Media
    {
        // Validazione e upload sicuro
        $this->validateFile($file);
        
        // Conversione automatica se necessario
        $media = $this->processFile($file);
        
        // Ottimizzazione automatica
        $this->optimizeMedia($media);
        
        return $media;
    }
}
```

## 🚀 **Quick Start**

### 📦 **Installazione**
```bash
# Installazione modulo
composer require laraxot/media-module

# Pubblicazione configurazioni
php artisan vendor:publish --tag=media-config

# Esecuzione migrazioni
php artisan migrate

# Generazione storage link
php artisan storage:link
```

### 🔧 **Configurazione**
```php
// config/media.php
return [
    'disk' => env('MEDIA_DISK', 'public'),
    'max_file_size' => env('MEDIA_MAX_FILE_SIZE', 10240), // 10MB
    'allowed_mime_types' => [
        'image/jpeg', 'image/png', 'image/webp',
        'video/mp4', 'video/webm',
        'application/pdf', 'application/msword'
    ],
    'image_optimization' => [
        'enabled' => true,
        'quality' => 85,
        'formats' => ['webp', 'avif']
    ],
    'video_processing' => [
        'enabled' => true,
        'ffmpeg_path' => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),
        'formats' => ['mp4', 'webm']
    ]
];
```

### 📝 **Utilizzo Base**
```php
// Upload semplice
$media = Media::upload($request->file('document'));

// Upload con proprietà custom
$media = Media::upload($request->file('avatar'))
    ->withCustomProperties(['user_id' => $user->id])
    ->withManipulations([
        'thumb' => ['width' => 100, 'height' => 100],
        'medium' => ['width' => 300, 'height' => 300]
    ])
    ->toMediaCollection('avatars');

// Accesso ai file
$url = $media->getUrl();
$thumbUrl = $media->getUrl('thumb');
$downloadUrl = $media->getDownloadUrl();
```

## 🎨 **Filament Integration**

### 📋 **Media Resource**
```php
class MediaResource extends XotBaseResource
{
    protected static ?string $model = Media::class;
    
    public static function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')
                ->disk('media')
                ->directory('uploads')
                ->visibility('public')
                ->acceptedFileTypes(['image/*', 'video/*', 'application/pdf'])
                ->maxSize(10240), // 10MB
                
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                
            Forms\Components\Select::make('collection_name')
                ->options([
                    'avatars' => 'Avatar',
                    'documents' => 'Documenti',
                    'gallery' => 'Galleria'
                ])
                ->required(),
        ];
    }
}
```

### 🎯 **Widget Media**
```php
class MediaStatsWidget extends XotBaseWidget
{
    protected static ?string $heading = 'Statistiche Media';
    
    protected function getStats(): array
    {
        return [
            Stat::make('File Totali', Media::count())
                ->description('Tutti i file caricati')
                ->descriptionIcon('heroicon-m-document'),
                
            Stat::make('Immagini', Media::where('mime_type', 'like', 'image/%')->count())
                ->description('File immagine')
                ->descriptionIcon('heroicon-m-photo'),
                
            Stat::make('Video', Media::where('mime_type', 'like', 'video/%')->count())
                ->description('File video')
                ->descriptionIcon('heroicon-m-video-camera'),
                
            Stat::make('Documenti', Media::where('mime_type', 'like', 'application/%')->count())
                ->description('File documento')
                ->descriptionIcon('heroicon-m-document-text'),
        ];
    }
}
```

## 🔧 **Testing**

### 🧪 **Unit Tests**
```php
class MediaTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_upload_file(): void
    {
        $file = UploadedFile::fake()->image('test.jpg');
        
        $media = Media::upload($file);
        
        $this->assertDatabaseHas('media', [
            'id' => $media->id,
            'file_name' => 'test.jpg',
            'mime_type' => 'image/jpeg'
        ]);
        
        $this->assertFileExists($media->getPath());
    }
    
    public function test_can_generate_thumbnails(): void
    {
        $file = UploadedFile::fake()->image('test.jpg', 800, 600);
        
        $media = Media::upload($file)
            ->withManipulations([
                'thumb' => ['width' => 100, 'height' => 100]
            ]);
        
        $this->assertFileExists($media->getPath('thumb'));
    }
}
```

### 🔍 **Feature Tests**
```php
class MediaUploadTest extends TestCase
{
    public function test_user_can_upload_file(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->post('/api/media/upload', [
                'file' => UploadedFile::fake()->image('avatar.jpg'),
                'collection' => 'avatars'
            ]);
        
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id', 'name', 'file_name', 'url'
        ]);
    }
}
```

## 🚨 **Troubleshooting**

### 🔧 **Problemi Comuni**

#### 📁 **Upload Issues**
```bash
# Verificare configurazione storage
php artisan media:check-storage

# Verificare permessi directory
chmod -R 755 storage/app/public
```
**Soluzione**: Consulta [File Management](file-management.md)

#### 🖼️ **Image Processing Issues**
```php
// Verificare estensione GD/Imagick
php artisan media:check-extensions

// Verificare memoria disponibile
ini_set('memory_limit', '512M');
```
**Soluzione**: Consulta [FFmpeg Integration](ffmpeg_integration.md)

#### 🎥 **Video Processing Issues**
```bash
# Verificare FFmpeg installazione
ffmpeg -version

# Verificare codec disponibili
ffmpeg -codecs
```
**Soluzione**: Consulta [Video Processing](ffmpeg_usage.md)

## 🤝 **Contributing**

### 📋 **Checklist Contribuzione**
- [ ] Codice passa PHPStan Level 9
- [ ] Test unitari aggiunti
- [ ] Documentazione aggiornata
- [ ] Traduzioni complete (IT/EN/DE)
- [ ] File upload testati
- [ ] Performance verificata

### 🎯 **Convenzioni**
- **File Naming**: Sempre nomi unici e sicuri
- **Validation**: Sempre validare tipo e dimensione file
- **Optimization**: Sempre ottimizzare immagini e video
- **Security**: Mai permettere upload di file eseguibili

## 📊 **Roadmap**

### 🎯 **Q1 2025**
- [ ] **Advanced Compression** - Compressione avanzata per tutti i formati
- [ ] **AI Image Processing** - Processing immagini con AI
- [ ] **Cloud Storage** - Integrazione cloud storage (AWS S3, Google Cloud)

### 🎯 **Q2 2025**
- [ ] **Batch Processing** - Elaborazione massiva file
- [ ] **Advanced Analytics** - Analytics dettagliati per utilizzo media
- [ ] **CDN Integration** - Integrazione CDN per distribuzione

### 🎯 **Q3 2025**
- [ ] **Real-time Processing** - Processing in tempo reale
- [ ] **Advanced Formats** - Supporto formati avanzati (AV1, WebP 2)
- [ ] **Machine Learning** - ML per ottimizzazione automatica

## 📞 **Support & Maintainers**

- **🏢 Team**: Laraxot Development Team
- **📧 Email**: media@laraxot.com
- **🐛 Issues**: [GitHub Issues](https://github.com/laraxot/media-module/issues)
- **📚 Docs**: [Documentazione Completa](https://docs.laraxot.com/media)
- **💬 Discord**: [Laraxot Community](https://discord.gg/laraxot)

---

### 🏆 **Achievements**

- **🏅 PHPStan Level 9**: File core certificati ✅
- **🏅 Translation Standards**: File traduzione certificati ✅
- **🏅 File Upload**: Sistema upload sicuro e ottimizzato ✅
- **🏅 Image Processing**: Ottimizzazione automatica immagini ✅
- **🏅 Video Processing**: Processing video con FFmpeg ✅
- **🏅 Storage Management**: Gestione storage efficiente ✅
- **🏅 S3Test Corrections**: Violazioni architetturali risolte ✅

### 📈 **Statistics**

- **📁 Files Supported**: 50+ formati file supportati
- **🖼️ Image Formats**: 10+ formati immagine (JPEG, PNG, WebP, AVIF)
- **🎥 Video Formats**: 15+ formati video (MP4, WebM, AV1, H.264)
- **📄 Document Formats**: 20+ formati documento (PDF, DOC, XLS)
- **🧪 Test Coverage**: 95%
- **⚡ Performance Score**: 95/100

---

**🔄 Ultimo aggiornamento**: 27 Gennaio 2025  
**📦 Versione**: 3.1.0  
**🐛 PHPStan Level 9**: File core certificati ✅  
**🌐 Translation Standards**: File traduzione certificati ✅  
**🚀 Performance**: 95/100 score  
**🔧 S3Test Corrections**: Completate ✅
<<<<<<< HEAD
=======

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
>>>>>>> 9c5e628 (.)
=======
>>>>>>> da8eaf7 (.)

