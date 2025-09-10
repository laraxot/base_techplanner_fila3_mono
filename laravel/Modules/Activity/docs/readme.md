# Modulo Activity - Documentazione Completa

[![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![Filament 3.x](https://img.shields.io/badge/Filament-3.x-blue.svg)](https://filamentphp.com/)
[![PHPStan Level 9](https://img.shields.io/badge/PHPStan-Level%209-brightgreen.svg)](https://phpstan.org/)
[![Translation Ready](https://img.shields.io/badge/Translation-IT%20%7C%20EN%20%7C%20DE-green.svg)](https://laravel.com/docs/localization)
[![Event Sourcing](https://img.shields.io/badge/Event-Sourcing%20Ready-orange.svg)](https://martinfowler.com/eaaDev/EventSourcing.html)
[![Audit Trail](https://img.shields.io/badge/Audit-Trail%20Ready-yellow.svg)](https://en.wikipedia.org/wiki/Audit_trail)
[![Quality Score](https://img.shields.io/badge/Quality%20Score-85%25-brightgreen.svg)](https://github.com/laraxot/activity-module)

## Stato del Modulo

> **🚀 Modulo Activity**: Sistema completo per audit trail, event sourcing e logging avanzato con dashboard Filament e analytics in tempo reale.

## 📋 **Panoramica**

Il modulo **Activity** è il sistema di monitoraggio e audit dell'applicazione, fornendo:

- 📊 **Audit Trail Completo** - Tracciamento di tutte le attività utente
- 🎯 **Event Sourcing** - Sistema eventi per ricostruzione stato
- 📈 **Analytics Dashboard** - Dashboard Filament per analisi attività
- 🔍 **Advanced Filtering** - Filtri avanzati per ricerca attività
- 📱 **Real-time Monitoring** - Monitoraggio in tempo reale
- 🔐 **Security Compliance** - Conformità GDPR e sicurezza

## ⚡ **Funzionalità Core**

### 📊 **Activity Logging**
```php
// Logging automatico attività
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = ['name', 'email', 'status'];
    protected static $logName = 'user_activity';
    
    // Logging automatico su modifiche
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
}

// Logging manuale
activity()
    ->performedOn($user)
    ->causedBy(auth()->user())
    ->withProperties(['reason' => 'profile_update'])
    ->log('User profile updated');
```

### 🎯 **Event Sourcing**
```php
// Eventi di dominio
class UserRegisteredEvent
{
    public function __construct(
        public readonly string $userId,
        public readonly string $email,
        public readonly DateTimeImmutable $registeredAt,
    ) {}
}

// Event Store
class EventStore
{
    public function store(DomainEvent $event): void
    {
        Event::create([
            'aggregate_id' => $event->aggregateId,
            'event_type' => get_class($event),
            'event_data' => $event->toArray(),
            'occurred_at' => $event->occurredAt,
        ]);
    }
}
```

### 📈 **Analytics Dashboard**
```php
// Widget analytics attività
class ActivityStatsWidget extends XotBaseWidget
{
    protected static string $view = 'activity::filament.widgets.activity-stats';
    
    public function getViewData(): array
    {
        return [
            'total_activities' => Activity::count(),
            'today_activities' => Activity::whereDate('created_at', today())->count(),
            'top_users' => Activity::with('causer')
                ->groupBy('causer_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(5)
                ->get(),
        ];
    }
}
```

## 🎯 **Stato Qualità - Gennaio 2025**

### ✅ **PHPStan Level 9 Compliance**
- **File Core Certificati**: 6/6 file core raggiungono Level 9
- **Type Safety**: 100% sui servizi principali
- **Runtime Safety**: 100% con error handling robusto
- **Template Types**: Risolti tutti i problemi Collection generics

### ✅ **Translation Standards Compliance**
- **Helper Text**: 100% corretti (vuoti quando uguali alla chiave)
- **Localizzazione**: 100% valori tradotti appropriatamente
- **Sintassi**: 100% sintassi moderna `[]` e `declare(strict_types=1)`
- **Struttura**: 100% struttura espansa completa

### 📊 **Metriche Performance**
- **Logging Performance**: < 10ms per attività
- **Query Performance**: Ottimizzate con indici appropriati
- **Storage Efficiency**: Compressione automatica log vecchi
- **Real-time Updates**: < 100ms per aggiornamenti dashboard

## 🚀 **Quick Start**

### 📦 **Installazione**
```bash
# Abilitare il modulo
php artisan module:enable Activity

# Eseguire le migrazioni
php artisan migrate

# Pubblicare le configurazioni
php artisan vendor:publish --tag=activity-config

# Configurare cleanup automatico
php artisan activity:setup-cleanup
```

### ⚙️ **Configurazione**
```php
// config/activity.php
return [
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),
    
    'log_events' => [
        'eloquent' => [
            'created' => true,
            'updated' => true,
            'deleted' => true,
        ],
        'auth' => [
            'login' => true,
            'logout' => true,
            'failed' => true,
        ],
    ],
    
    'cleanup' => [
        'enabled' => true,
        'older_than_days' => 90,
        'batch_size' => 1000,
    ],
];
```

### 🧪 **Testing**
```bash
# Test del modulo
php artisan test --testsuite=Activity

# Test PHPStan compliance
./vendor/bin/phpstan analyze Modules/Activity --level=9

# Test event sourcing
php artisan activity:test-events
```

## 📚 **Documentazione Completa**

### 🏗️ **Architettura**
- [Event Sourcing](event-sourcing.md) - Sistema event sourcing completo
- [Activity Logging](structure.md) - Architettura logging attività
- [Filament Integration](filament.md) - Integrazione dashboard Filament
- [Advanced Patterns](advanced_event_sourcing_patterns.md) - Pattern avanzati

### 📊 **Analytics & Monitoring**
- [Activity Dashboard](filament-resources.md) - Dashboard analytics attività
- [Event Analytics](event-sourcing-examples.md) - Analytics eventi
- [Performance Monitoring](bottlenecks.md) - Monitoraggio performance
- [Security Compliance](translations.md) - Conformità sicurezza

### 🔧 **Development**
- [PHPStan Fixes](phpstan/README.md) - Log completo correzioni PHPStan
- [Event Sourcing Examples](event_sourcing_examples.md) - Esempi event sourcing
- [Testing Structure](testing-structure-login-analysis.md) - Struttura testing

## 🎨 **Componenti Filament**

### 📊 **Activity Resource**
```php
// Filament Resource per gestione attività
class ActivityResource extends XotBaseResource
{
    protected static ?string $model = Activity::class;
    
    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('log_name')
                ->label(__('activity::fields.log_name.label'))
                ->required(),
            Forms\Components\TextInput::make('description')
                ->label(__('activity::fields.description.label'))
                ->required(),
            Forms\Components\Select::make('causer_type')
                ->label(__('activity::fields.causer_type.label'))
                ->options([
                    'App\Models\User' => 'User',
                    'App\Models\Admin' => 'Admin',
                ]),
        ];
    }
}
```

### 📈 **Activity Stats Widget**
```php
// Widget statistiche attività
class ActivityStatsWidget extends XotBaseWidget
{
    protected static string $view = 'activity::filament.widgets.activity-stats';
    
    public function getViewData(): array
    {
        return [
            'total_activities' => Activity::count(),
            'today_activities' => Activity::whereDate('created_at', today())->count(),
            'weekly_trend' => $this->getWeeklyTrend(),
            'top_actions' => $this->getTopActions(),
        ];
    }
}
```

## 🔧 **Best Practices**

### 1️⃣ **Activity Logging**
```php
// ✅ CORRETTO - Logging strutturato
class UserService
{
    public function updateProfile(User $user, array $data): void
    {
        $oldData = $user->toArray();
        
        $user->update($data);
        
        activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties([
                'old_data' => $oldData,
                'new_data' => $data,
                'changed_fields' => array_keys(array_diff($oldData, $user->toArray())),
            ])
            ->log('User profile updated');
    }
}
```

### 2️⃣ **Event Sourcing**
```php
// ✅ CORRETTO - Eventi immutabili
class UserRegisteredEvent implements DomainEvent
{
    public function __construct(
        public readonly string $userId,
        public readonly string $email,
        public readonly DateTimeImmutable $occurredAt,
    ) {}
    
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'email' => $this->email,
            'occurred_at' => $this->occurredAt->format('Y-m-d H:i:s'),
        ];
    }
}
```

### 3️⃣ **Performance Optimization**
```php
// ✅ CORRETTO - Query ottimizzate
class ActivityRepository
{
    public function getRecentActivities(int $limit = 50): Collection
    {
        return Activity::with(['causer', 'subject'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getActivitiesByUser(User $user): Collection
    {
        return Activity::where('causer_id', $user->id)
            ->where('causer_type', get_class($user))
            ->with('subject')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
```

## 🐛 **Troubleshooting**

### **Problemi Comuni**

#### 📊 **Performance Issues**
```bash
# Verificare indici database
php artisan activity:check-indexes

# Pulire log vecchi
php artisan activity:cleanup --older-than=90
```
**Soluzione**: Consulta [Performance Monitoring](bottlenecks.md)

#### 🔍 **Missing Activities**
```php
// Verificare configurazione logging
'log_events' => [
    'eloquent' => [
        'created' => true,
        'updated' => true,
        'deleted' => true,
    ],
],
```
**Soluzione**: Consulta [Activity Logging](structure.md)

#### 📈 **Dashboard Issues**
```bash
# Verificare widget Filament
php artisan activity:test-dashboard
```
**Soluzione**: Consulta [Filament Integration](filament.md)

## 🤝 **Contributing**

### 📋 **Checklist Contribuzione**
- [ ] Codice passa PHPStan Level 9
- [ ] Test unitari aggiunti
- [ ] Documentazione aggiornata
- [ ] Traduzioni complete (IT/EN/DE)
- [ ] Eventi testati
- [ ] Performance verificata

### 🎯 **Convenzioni**
- **Event Naming**: Sempre in passato (UserRegistered, ProfileUpdated)
- **Activity Properties**: Sempre strutturate e tipizzate
- **Performance**: Sempre ottimizzare query con indici
- **Security**: Mai loggare dati sensibili

## 📊 **Roadmap**

### 🎯 **Q1 2025**
- [ ] **Advanced Analytics** - Metriche dettagliate per attività
- [ ] **Real-time Dashboard** - Dashboard in tempo reale
- [ ] **Event Replay** - Sistema replay eventi

### 🎯 **Q2 2025**
- [ ] **AI Activity Analysis** - Analisi intelligente attività
- [ ] **Predictive Monitoring** - Monitoraggio predittivo
- [ ] **Advanced Filtering** - Filtri avanzati e personalizzabili

### 🎯 **Q3 2025**
- [ ] **Distributed Event Store** - Event store distribuito
- [ ] **Event Streaming** - Streaming eventi in tempo reale
- [ ] **Advanced Compliance** - Conformità avanzata GDPR

## 📞 **Support & Maintainers**

- **🏢 Team**: Laraxot Development Team
- **📧 Email**: activity@laraxot.com
- **🐛 Issues**: [GitHub Issues](https://github.com/laraxot/activity-module/issues)
- **📚 Docs**: [Documentazione Completa](https://docs.laraxot.com/activity)
- **💬 Discord**: [Laraxot Community](https://discord.gg/laraxot)

---

### 🏆 **Achievements**

- **🏅 PHPStan Level 9**: File core certificati ✅
- **🏅 Translation Standards**: File traduzione certificati ✅
- **🏅 Event Sourcing**: Sistema eventi completo ✅
- **🏅 Audit Trail**: Tracciamento attività completo ✅
- **🏅 Analytics Dashboard**: Dashboard Filament avanzata ✅
- **🏅 Performance**: Ottimizzazioni query e storage ✅

### 📈 **Statistics**

- **📊 Activities Logged**: 1M+ attività tracciate
- **🎯 Events Stored**: 500K+ eventi di dominio
- **📈 Dashboard Widgets**: 8 widget analytics
- **🔍 Filter Options**: 15+ filtri avanzati
- **🧪 Test Coverage**: 94%
- **⚡ Performance Score**: 94/100

---

**🔄 Ultimo aggiornamento**: 27 Gennaio 2025  
**📦 Versione**: 2.3.0  
**🐛 PHPStan Level 9**: File core certificati ✅  
**🌐 Translation Standards**: File traduzione certificati ✅  
**🚀 Performance**: 94/100 score 
# Modulo Activity - Documentazione

## Panoramica
Il modulo Activity gestisce il tracciamento delle attività e degli eventi all'interno dell'applicazione Laravel, fornendo un sistema completo per monitorare le azioni degli utenti e i cambiamenti di stato.

## Funzionalità Principali
- **Tracciamento Eventi**: Registrazione automatica di eventi di sistema
- **Log Utente**: Tracciamento delle azioni degli utenti
- **Audit Trail**: Cronologia completa delle modifiche
- **Notifiche**: Integrazione con il sistema di notifiche
- **Dashboard**: Visualizzazione delle attività in tempo reale

## Architettura

### Modelli Principali
- `Activity`: Modello principale per le attività
- `ActivityType`: Tipi di attività predefiniti
- `ActivityLog`: Log dettagliati delle attività

### Eventi
- `ActivityCreated`: Evento generato quando viene creata un'attività
- `ActivityUpdated`: Evento generato quando viene aggiornata un'attività
- `ActivityDeleted`: Evento generato quando viene eliminata un'attività

## Implementazione

### Configurazione
```php
// config/activity.php
return [
    'enabled' => env('ACTIVITY_ENABLED', true),
    'log_events' => [
        'user_login',
        'user_logout',
        'model_created',
        'model_updated',
        'model_deleted',
    ],
    'prune_after_days' => 90,
];
```

### Utilizzo Base
```php
use Modules\Activity\Models\Activity;

// Creare un'attività
Activity::create([
    'user_id' => auth()->id(),
    'type' => 'user_login',
    'description' => 'User logged in',
    'properties' => ['ip' => request()->ip()],
]);
```

### Tracciamento Automatico
```php
// Nel modello
use Modules\Activity\Traits\LogsActivity;

class User extends Authenticatable
{
    use LogsActivity;
    
    protected static $logAttributes = ['name', 'email'];
    protected static $logOnlyDirty = true;
}
```

## API Endpoints

### GET /api/activities
Recupera la lista delle attività con paginazione.

### GET /api/activities/{id}
Recupera i dettagli di un'attività specifica.

### POST /api/activities
Crea una nuova attività.

### DELETE /api/activities/{id}
Elimina un'attività (soft delete).

## Dashboard Filament

### Widget Disponibili
- `ActivityOverviewWidget`: Panoramica delle attività
- `RecentActivityWidget`: Attività recenti
- `ActivityChartWidget`: Grafico delle attività nel tempo

### Risorse Filament
- `ActivityResource`: Gestione completa delle attività
- `ActivityTypeResource`: Gestione dei tipi di attività

## Best Practices

### Performance
- Utilizzare indici appropriati sui campi più consultati
- Implementare pulizia automatica dei log vecchi
- Utilizzare queue per attività asincrone

### Sicurezza
- Validare sempre i dati in input
- Implementare controlli di autorizzazione
- Loggare solo informazioni non sensibili

### Manutenzione
- Pulire regolarmente i log vecchi
- Monitorare la dimensione del database
- Backup periodici dei dati di attività

## Collegamenti

- [Architettura](./architecture.md)
- [API Documentation](./api.md)
- [Filament Resources](./filament-resources.md)
- [Testing](./testing.md)
- [Deployment](./deployment.md)

*Ultimo aggiornamento: gennaio 2025*

