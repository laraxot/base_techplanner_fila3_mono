<<<<<<< HEAD
# Modulo Xot - Fondamento Architetturale Laraxot
=======
# Modulo Xot - Documentazione
>>>>>>> 68b3eda (.)

## Panoramica

Il modulo Xot è il fondamento architetturale dell'ecosistema Laraxot PTVX. Fornisce classi base, trait, service provider e funzionalità core che vengono estesi e utilizzati da tutti gli altri moduli dell'applicazione. Implementa i principi DRY, KISS, SOLID e robustezza per garantire coerenza e manutenibilità.

<<<<<<< HEAD
## Caratteristiche Principali
=======
### Core Features
- [Development Rules](development-rules.md) - Regole di sviluppo per il modulo
- [Code Quality](code_quality.md) - Standard di qualità del codice
- [Best Practices](best-practices.md) - Pratiche consigliate
>>>>>>> 68b3eda (.)

- **Classi Base**: Modelli, controller e resource base per tutti i moduli
- **Service Provider Base**: Service provider base con funzionalità comuni
- **Trait Condivisi**: Trait riutilizzabili per funzionalità comuni
- **Middleware Base**: Middleware base per autenticazione e autorizzazione
- **Configurazioni Base**: Configurazioni standard per tutti i moduli
- **Utilities**: Helper e utility functions condivise

## Struttura del Modulo

```
Modules/Xot/
├── app/
│   ├── Models/
│   │   ├── XotBaseModel.php
│   │   └── BaseModel.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── XotBaseController.php
│   │   └── Middleware/
│   │       ├── XotBaseMiddleware.php
│   │       └── CheckPermission.php
│   ├── Filament/
│   │   ├── Resources/
│   │   │   └── XotBaseResource.php
│   │   ├── Pages/
│   │   │   └── XotBasePage.php
│   │   └── RelationManagers/
│   │       └── XotBaseRelationManager.php
│   ├── Providers/
│   │   └── XotBaseServiceProvider.php
│   ├── Traits/
│   │   ├── HasUuid.php
│   │   ├── HasSlug.php
│   │   └── HasStatus.php
│   └── Services/
│       ├── BaseService.php
│       └── CacheService.php
├── config/
├── database/
│   └── migrations/
│       └── XotBaseMigration.php
├── docs/
├── lang/
├── resources/
└── tests/
```

## Componenti Principali

### XotBaseModel

Modello base per tutti i moduli:

```php
abstract class XotBaseModel extends Model
{
    use HasFactory, HasUuid, HasSlug, HasStatus;

<<<<<<< HEAD
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return $this->table ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * Get the connection name for the model.
     */
    public function getConnectionName(): string
    {
        return $this->connection ?? config('database.default');
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return $this->casts;
    }
}
```

### XotBaseController
=======
### Gennaio 2025 - Testing Organization ⭐ **NUOVO**
>>>>>>> 68b3eda (.)

Controller base per tutti i moduli:

```php
abstract class XotBaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The model class for this controller.
     */
    protected string $modelClass;

    /**
     * The resource class for this controller.
     */
    protected string $resourceClass;

    /**
     * The request class for validation.
     */
    protected string $requestClass;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->modelClass);

        $query = $this->modelClass::query();
        
        if (method_exists($this, 'applyFilters')) {
            $query = $this->applyFilters($query, $request);
        }

        $items = $query->paginate($request->get('per_page', 15));

        return $this->resourceClass::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->modelClass);

        $validated = $request->validate((new $this->requestClass)->rules());

        $item = $this->modelClass::create($validated);

        return new $this->resourceClass($item);
    }
}
```

### XotBaseResource

Resource base per Filament:

```php
abstract class XotBaseResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sistema';
    protected static ?int $navigationSort = 100;

    /**
     * Get the form schema for the resource.
     */
    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Informazioni Base')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }

    /**
     * Get the table columns for the resource.
     */
    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * Get the table actions for the resource.
     */
    public static function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }
}
```

### XotBaseRelationManager

Relation manager base per Filament:

```php
abstract class XotBaseRelationManager extends RelationManager
{
    use HasXotTable;

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Get the form schema for the relation manager.
     */
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }

    /**
     * Get the table columns for the relation manager.
     */
    public function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
        ];
    }

    /**
     * Get the table header actions for the relation manager.
     */
    public function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\AttachAction::make(),
        ];
    }

    /**
     * Get the table actions for the relation manager.
     */
    public function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DetachAction::make(),
        ];
    }
}
```

### XotBaseServiceProvider

Service provider base per tutti i moduli:

```php
abstract class XotBaseServiceProvider extends ServiceProvider
{
    /**
     * The module namespace.
     */
    protected string $module_name;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(module_path($this->module_name, 'resources/views'), strtolower($this->module_name));
        $this->loadTranslationsFrom(module_path($this->module_name, 'lang'), strtolower($this->module_name));
        $this->loadMigrationsFrom(module_path($this->module_name, 'database/migrations'));
        $this->loadRoutesFrom(module_path($this->module_name, 'routes'));
        
        $this->publishes([
            module_path($this->module_name, 'config') => config_path(strtolower($this->module_name)),
        ], 'config');
        
        $this->publishes([
            module_path($this->module_name, 'resources/views') => resource_path('views/vendor/'.strtolower($this->module_name)),
        ], 'views');
    }

    /**
     * Register the module configuration.
     */
    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(
            module_path($this->module_name, 'config/config.php'),
            strtolower($this->module_name)
        );
    }

    /**
     * Register the module bindings.
     */
    protected function registerBindings(): void
    {
        // Override in child classes to register specific bindings
    }
}
```

### XotBaseMigration

Migrazione base per tutti i moduli:

```php
abstract class XotBaseMigration extends Migration
{
    /**
     * The name of the table.
     */
    protected string $table_name;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable($this->table_name)) {
            echo 'Table ['.$this->table_name.'] already exists';
            return;
        }

        Schema::create($this->table_name, function (Blueprint $table) {
            $this->createTableSchema($table);
        });

        echo 'Table ['.$this->table_name.'] created successfully!';
    }

    /**
     * Create the table schema.
     */
    abstract protected function createTableSchema(Blueprint $table): void;

    /**
     * Check if the table exists.
     */
    protected function hasTable(string $table): bool
    {
        return Schema::hasTable($table);
    }

    /**
     * Check if the column exists.
     */
    protected function hasColumn(string $table, string $column): bool
    {
        return Schema::hasColumn($table, $column);
    }

    /**
     * Add a comment to the table.
     */
    protected function tableComment(string $table, string $comment): void
    {
        DB::statement("ALTER TABLE `{$table}` COMMENT = '{$comment}'");
    }

    /**
     * Add a comment to the column.
     */
    protected function columnComment(string $table, string $column, string $comment): void
    {
        DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` COMMENT '{$comment}'");
    }
}
```

## Traits Condivisi

### HasUuid Trait

Gestione UUID per i modelli:

```php
trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Find a model by its UUID.
     */
    public static function findByUuid(string $uuid): ?static
    {
        return static::where('uuid', $uuid)->first();
    }
}
```

### HasSlug Trait

Gestione slug per i modelli:

```php
trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    /**
     * Find a model by its slug.
     */
    public static function findBySlug(string $slug): ?static
    {
        return static::where('slug', $slug)->first();
    }

    /**
     * Generate a unique slug.
     */
    public function generateUniqueSlug(): string
    {
        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
```

### HasStatus Trait

Gestione stati per i modelli:

```php
trait HasStatus
{
    /**
     * Get the status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'active' => 'Attivo',
            'inactive' => 'Inattivo',
            'draft' => 'Bozza',
            'published' => 'Pubblicato',
        ];
    }

    /**
     * Check if the model is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the model is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Scope a query to only include active models.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include published models.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}
```

## Configurazione

### Configurazione Base

```php
// config/xot.php
return [
    'models' => [
        'base_model' => \Modules\Xot\Models\XotBaseModel::class,
        'user_model' => \Modules\User\Models\User::class,
    ],
    
    'filament' => [
        'base_resource' => \Modules\Xot\Filament\Resources\XotBaseResource::class,
        'base_page' => \Modules\Xot\Filament\Pages\XotBasePage::class,
        'base_relation_manager' => \Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager::class,
    ],
    
    'migrations' => [
        'base_migration' => \Modules\Xot\Database\Migrations\XotBaseMigration::class,
    ],
    
    'cache' => [
        'enabled' => env('XOT_CACHE_ENABLED', true),
        'ttl' => env('XOT_CACHE_TTL', 3600),
    ],
];
```

### Environment Variables

```env
# Configurazione Xot
XOT_CACHE_ENABLED=true
XOT_CACHE_TTL=3600
XOT_DEBUG=false
XOT_LOG_ENABLED=true

# Database
XOT_DB_CONNECTION=mysql
XOT_DB_PREFIX=xot_

# Cache
XOT_CACHE_DRIVER=redis
XOT_CACHE_PREFIX=xot_
```

## Utilizzo

### Estensione Modelli

```php
use Modules\Xot\Models\XotBaseModel;

class MyModel extends XotBaseModel
{
    protected $table = 'my_models';
    
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected function createTableSchema(Blueprint $table): void
    {
        $table->id();
        $table->uuid('uuid')->unique();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('slug')->unique();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    }
}
```

### Estensione Controller

```php
use Modules\Xot\Http\Controllers\XotBaseController;

class MyController extends XotBaseController
{
    protected string $modelClass = MyModel::class;
    protected string $resourceClass = MyResource::class;
    protected string $requestClass = MyRequest::class;

    protected function applyFilters(Builder $query, Request $request): Builder
    {
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        return $query;
    }
}
```

### Estensione Resource

```php
use Modules\Xot\Filament\Resources\XotBaseResource;

class MyResource extends XotBaseResource
{
    protected static ?string $model = MyModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Il Mio Modulo';

    public static function getFormSchema(): array
    {
        return array_merge(parent::getFormSchema(), [
            Forms\Components\Section::make('Dettagli Aggiuntivi')
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload(),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('In Evidenza'),
                ]),
        ]);
    }

    public static function getTableColumns(): array
    {
        return array_merge(parent::getTableColumns(), [
            Tables\Columns\TextColumn::make('category.name')
                ->label('Categoria')
                ->sortable(),
            Tables\Columns\IconColumn::make('is_featured')
                ->boolean()
                ->label('In Evidenza'),
        ]);
    }
}
```

### Estensione Service Provider

```php
use Modules\Xot\Providers\XotBaseServiceProvider;

class MyServiceProvider extends XotBaseServiceProvider
{
    protected string $module_name = 'MyModule';

    protected function registerBindings(): void
    {
        $this->app->bind(MyInterface::class, MyImplementation::class);
        $this->app->singleton(MyService::class);
    }

    public function boot(): void
    {
        parent::boot();
        
        // Registrazione aggiuntiva specifica del modulo
        $this->registerPolicies();
        $this->registerCommands();
    }

    protected function registerPolicies(): void
    {
        Gate::policy(MyModel::class, MyPolicy::class);
    }

    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MyCommand::class,
            ]);
        }
    }
}
```

### Estensione Migration

```php
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    protected string $table_name = 'my_models';

    protected function createTableSchema(Blueprint $table): void
    {
        $table->id();
        $table->uuid('uuid')->unique();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('slug')->unique();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->boolean('is_featured')->default(false);
        $table->timestamps();
        $table->softDeletes();
        
        // Indici
        $table->index(['status', 'is_featured']);
        $table->index('category_id');
    }
};
```

## Best Practices

### Naming Convention

1. **Classi Base**: Prefisso `XotBase` per tutte le classi base
2. **Namespace**: Utilizzare namespace modulari `Modules\Xot\...`
3. **Metodi**: Metodi pubblici per API, protetti per estensioni
4. **Proprietà**: Proprietà protette per estensione, private per interno

### Estensione

1. **Composizione**: Preferire composizione a ereditarietà multipla
2. **Interfacce**: Definire interfacce per funzionalità estendibili
3. **Hook**: Utilizzare hook e eventi per estensioni
4. **Configurazione**: Rendere configurabili le funzionalità base

### Performance

1. **Lazy Loading**: Carica funzionalità solo quando necessario
2. **Caching**: Cache per configurazioni e metadati
3. **Indici**: Indici database ottimizzati
4. **Query**: Query ottimizzate e eager loading

## Testing

### Test Base

```php
// Test modelli base
it('creates model with uuid', function () {
    $model = MyModel::create(['name' => 'Test']);
    
    expect($model->uuid)->not->toBeEmpty();
    expect(Str::isUuid($model->uuid))->toBeTrue();
});

// Test trait status
it('has correct status options', function () {
    $options = MyModel::getStatusOptions();
    
    expect($options)->toHaveKey('active');
    expect($options)->toHaveKey('inactive');
});

// Test scope active
it('filters active models', function () {
    MyModel::create(['name' => 'Active', 'status' => 'active']);
    MyModel::create(['name' => 'Inactive', 'status' => 'inactive']);
    
    $activeModels = MyModel::active()->get();
    
    expect($activeModels)->toHaveCount(1);
    expect($activeModels->first()->name)->toBe('Active');
});
```

### Test di Copertura

```bash
# Test unitari
php artisan test Modules/Xot/tests/Unit

# Test feature
php artisan test Modules/Xot/tests/Feature

# Test Pest
./vendor/bin/pest Modules/Xot/tests
```

## Sicurezza

### Validazione

```php
// Validazione input
protected function validateInput(array $data): array
{
    return Validator::make($data, [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:65535',
        'status' => 'required|in:active,inactive,draft,published',
    ])->validate();
}

// Sanitizzazione
protected function sanitizeInput(array $data): array
{
    return array_map('trim', $data);
}
```

### Autorizzazione

```php
// Verifica permessi
protected function checkPermission(string $permission): void
{
    if (!auth()->user()->can($permission)) {
        abort(403, 'Unauthorized action.');
    }
}

// Verifica proprietà
protected function checkOwnership(Model $model): void
{
    if ($model->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
}
```

## Monitoraggio e Logging

### Log Base

```php
// Log operazioni
protected function logOperation(string $operation, array $context = []): void
{
    Log::info("Xot operation: {$operation}", array_merge([
        'user_id' => auth()->id(),
        'model' => static::class,
        'timestamp' => now(),
    ], $context));
}

// Log errori
protected function logError(string $message, \Throwable $exception): void
{
    Log::error("Xot error: {$message}", [
        'exception' => $exception->getMessage(),
        'trace' => $exception->getTraceAsString(),
        'user_id' => auth()->id(),
    ]);
}
```

### Metriche

- Numero estensioni per classe base
- Performance operazioni base
- Utilizzo trait condivisi
- Errori e eccezioni

## Troubleshooting

### Problemi Comuni

1. **Classi Base Non Trovate**
   - Verificare autoloading
   - Controllare namespace
   - Verificare estensioni corrette

2. **Trait Non Funzionanti**
   - Verificare use statement
   - Controllare metodi richiesti
   - Verificare compatibilità

3. **Service Provider Non Registrati**
   - Controllare config/app.php
   - Verificare estensione corretta
   - Controllare errori di sintassi

### Debug

```php
// Debug configurazione
config(['xot.debug' => true]);

// Log dettagliato
Log::debug('Xot debug', [
    'config' => config('xot'),
    'models' => get_declared_classes(),
    'traits' => get_declared_traits(),
]);
```

## Testing e Qualità del Codice

### Struttura dei Test

Il modulo Xot utilizza Pest per i test, con una struttura organizzata per garantire copertura completa:

- **Unit Tests**: Test dei modelli, traits e servizi base
- **Feature Tests**: Test delle funzionalità complete
- **Integration Tests**: Test dell'integrazione con altri moduli

### Documentazione Testing

Per informazioni complete sui test del modulo Xot, consultare:
- [Miglioramenti Testing](testing-improvements.md) - Miglioramenti implementati e best practice
- [Strategia Testing Globale](../../../../docs/testing/strategy.md) - Approccio generale al testing

### Best Practices per i Test

1. **Struttura Standardizzata**: Utilizzo di describe() e beforeEach() per organizzazione
2. **Assertions Specifiche**: Uso di custom expectations per i modelli e servizi
3. **Isolamento**: Ogni test è indipendente e non dipende da altri
4. **Type Safety**: Utilizzo di type hints e strict types
5. **Mocking Appropriato**: Utilizzo di mock per test isolati

### Esecuzione Test

```bash
cd /var/www/html/ptvx/laravel

# Tutti i test del modulo Xot
./vendor/bin/pest Modules/Xot/tests/

# Solo test unitari
./vendor/bin/pest Modules/Xot/tests/Unit/

# Solo test di integrazione
./vendor/bin/pest Modules/Xot/tests/Feature/

# Test con coverage
./vendor/bin/pest --coverage Modules/Xot/tests/
```

### Miglioramenti Recenti

- ✅ Rimossi separatori duplicati da tutti i file di test
- ✅ Consolidato codice duplicato causato da merge conflitti
- ✅ Standardizzata struttura test seguendo best practice Pest
- ✅ Migliorata leggibilità e manutenibilità dei test

## Integrazione con Altri Moduli

### Registrazione Modulo

```php
// Nel ServiceProvider del modulo
public function boot(): void
{
    parent::boot();
    
    // Registrazione specifica del modulo
    $this->registerResources();
    $this->registerCommands();
}
```

### Utilizzo Cross-Module

```php
// In qualsiasi modulo
use Modules\Xot\Models\XotBaseModel;
use Modules\Xot\Traits\HasUuid;

class MyModel extends XotBaseModel
{
    use HasUuid;
    
    // Implementazione specifica del modulo
}
```

## Roadmap

### Funzionalità Future

- [ ] Sistema di plugin avanzato
- [ ] API REST base
- [ ] Sistema di eventi avanzato
- [ ] Cache intelligente
- [ ] Monitoring avanzato
- [ ] Sistema di backup automatico

### Miglioramenti

- [ ] Performance optimization
- [ ] Advanced caching
- [ ] Real-time updates
- [ ] Analytics avanzate
- [ ] API REST completa

## Contributi

### Sviluppo

1. Fork del repository
2. Creazione branch feature
3. Implementazione funzionalità
4. Test completi
5. Pull request con documentazione

### Standard di Codice

<<<<<<< HEAD
- PSR-12 coding standards
- PHPStan livello 9+
- Test coverage >90%
- Documentazione PHPDoc completa

## Licenza

Questo modulo è rilasciato sotto la licenza MIT. Vedi il file LICENSE per i dettagli.

## Supporto

Per supporto tecnico o domande:

- **Issues**: GitHub Issues
- **Documentazione**: Questa documentazione
- **Wiki**: Wiki del progetto
- **Chat**: Canale Slack/Teams

---

*Ultimo aggiornamento: {{ date('Y-m-d') }}*
=======
- [Documentazione Root](../../../docs/README.md)
- [Modulo UI](../UI/docs/README.md)
- [Modulo Lang](../Lang/docs/README.md)
- [Modulo Notify](../Notify/docs/README.md)
- [Modulo Employee](../Employee/docs/README.md) - Sistema HR completo con gestione dipendenti e presenze ✅
  - **Stato**: Foundation completata (modelli, factory, test)
  - **PHPStan**: Livello 10 ✅
  - **Test Coverage**: 100% modelli base ✅

*Ultimo aggiornamento: gennaio 2025 - Aggiornato stato modulo Employee*
>>>>>>> 68b3eda (.)
