<<<<<<< HEAD
# Activity Module Documentation

Business logic module providing domain-specific functionality.

## Quick Reference
- **Domain Logic**: Core business rules and processes
- **Data Models**: Domain entities and relationships
- **Workflows**: Business process automation
- **Validation**: Business rule validation

## Documentation Structure
1. [Domain Logic](domain-logic.md) - Core business rules
2. [Data Models](data-models.md) - Domain entities
3. [Workflows](workflows.md) - Business processes
4. [Validation](validation.md) - Business rule validation
5. [Integration](integration.md) - External integrations
6. [Troubleshooting](troubleshooting.md) - Common issues
=======
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
>>>>>>> 9b16d81 (.)

## Business Logic Focus
- **Domain Expertise**: Specialized business knowledge
- **Data Integrity**: Robust data validation
- **Process Automation**: Streamlined workflows
- **Compliance**: Regulatory and business compliance
