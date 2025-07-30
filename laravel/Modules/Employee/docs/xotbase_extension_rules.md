# Regole di Estensione XotBase per Filament

## Regola Fondamentale

**NON estendere MAI classi Filament direttamente**

Tutte le classi Filament devono essere estese tramite classi astratte XotBase che replicano la struttura originale.

## Pattern Corretto

### ❌ SBAGLIATO
```php
use Filament\Pages\Dashboard;

class MyDashboard extends Dashboard
{
    // ERRORE: estensione diretta di classe Filament
}
```

### ✅ CORRETTO
```php
use Modules\Xot\Filament\Pages\XotBaseDashboard;

class MyDashboard extends XotBaseDashboard
{
    // CORRETTO: estensione tramite XotBase
}
```

## Mappatura Classi Comuni

| Classe Filament Originale | Classe XotBase da Usare |
|---------------------------|-------------------------|
| `Filament\Pages\Dashboard` | `Modules\Xot\Filament\Pages\XotBaseDashboard` |
| `Filament\Resources\Resource` | `Modules\Xot\Filament\Resources\XotBaseResource` |
| `Filament\Resources\Pages\ListRecords` | `Modules\Xot\Filament\Resources\Pages\XotBaseListRecords` |
| `Filament\Resources\Pages\CreateRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord` |
| `Filament\Resources\Pages\EditRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord` |
| `Filament\Widgets\Widget` | `Modules\Xot\Filament\Widgets\XotBaseWidget` |

## Motivazioni Architetturali

### 1. Centralizzazione
- Funzionalità comuni implementate una sola volta
- Controllo centralizzato dell'architettura
- Prevenzione di duplicazioni di codice

### 2. Manutenibilità
- Modifiche globali tramite classi XotBase
- Coerenza tra tutti i moduli
- Facilità di debugging e testing

### 3. Estensibilità
- Override centralizzato di comportamenti Filament
- Aggiunta di funzionalità custom a livello sistemico
- Integrazione con altri componenti del framework

## Implementazione nel Modulo Employee

Tutti i componenti Filament del modulo Employee seguono questa regola:

- `Dashboard.php` estende `XotBaseDashboard`
- Future risorse estenderanno `XotBaseResource`
- Future pagine estenderanno le rispettive classi XotBase

## Collegamento alla Documentazione Generale

Per regole architetturali generali, consultare:
- [Documentazione Xot - Architettura Filament](../../Xot/docs/filament_architecture.md)
- [Regole Generali di Sviluppo](../../Xot/docs/development_rules.md)

## Controlli di Qualità

Prima di ogni commit, verificare che:
1. Nessuna classe estenda direttamente classi Filament
2. Tutti gli import puntino a classi XotBase
3. La struttura del namespace sia coerente
4. **Nessuna classe che estende XotBaseDashboard ridefinisca proprietà di navigazione**
5. Le dashboard siano completamente vuote e lascino gestire tutto a XotBaseDashboard

## Esempi di Correzione

### Prima (ERRATO)
```php
namespace Modules\Employee\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;
    // ...
}
```

### Dopo (CORRETTO)
```php
namespace Modules\Employee\Filament\Pages;

use Modules\Xot\Filament\Pages\XotBaseDashboard;

/**
 * Dashboard per il modulo Employee.
 * 
 * Estende XotBaseDashboard che gestisce automaticamente:
 * - Navigazione (icon, title, label, sort)
 * - Filtri del dashboard
 * - Struttura base del dashboard
 */
class Dashboard extends XotBaseDashboard
{
    // ❌ NON ridefinire proprietà di navigazione:
    // protected static ?string $navigationIcon
    // protected static ?string $title
    // protected static ?string $navigationLabel  
    // protected static ?int $navigationSort
    
    // ✅ XotBaseDashboard gestisce tutto automaticamente
}
```

## Regole Specifiche per XotBaseDashboard

### ❌ NON Ridefinire Mai

Le seguenti proprietà sono **gestite centralmente** da XotBaseDashboard:

```php
// ❌ VIETATO - Già gestito dalla classe base
protected static ?string $navigationIcon = 'heroicon-o-users';
protected static ?string $title = 'Employee Dashboard';
protected static ?string $navigationLabel = 'Employee';
protected static ?int $navigationSort = 1;
```

### ✅ Pattern Corretto

```php
class Dashboard extends XotBaseDashboard
{
    // Classe completamente vuota
    // XotBaseDashboard auto-configura tutto basandosi sul modulo
}
```

### Motivazioni Architetturali

1. **Auto-configurazione**: XotBaseDashboard deduce automaticamente icon, title e label dal nome del modulo
2. **Centralizzazione**: Tutte le dashboard hanno comportamento uniforme
3. **DRY Principle**: Evita duplicazione di codice di navigazione
4. **Manutenibilità**: Modifiche globali dalla classe base
5. **Consistenza**: Stesso aspetto e comportamento tra tutti i moduli
