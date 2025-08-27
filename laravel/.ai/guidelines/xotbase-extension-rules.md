# XotBase Extension Rules - REGOLA ASSOLUTA

## ⚠️ REGOLA INVIOLABILE
**MAI ESTENDERE DIRETTAMENTE CLASSI FILAMENT. SEMPRE USARE XOTBASE.**

## Principio Fondamentale

Tutte le classi Filament devono essere estese tramite classi astratte XotBase che replicano la struttura originale, mantenendo il percorso del namespace originale.

### ❌ SBAGLIATO - Estensione diretta
```php
use Filament\Resources\Pages\CreateRecord;

class MyCreatePage extends CreateRecord // ❌ VIETATO
{
    // ...
}
```

### ✅ CORRETTO - Estensione tramite XotBase
```php
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class MyCreatePage extends XotBaseCreateRecord // ✅ OBBLIGATORIO
{
    // ...
}
```

## Mappatura Classi Comuni - REGOLA ASSOLUTA

| Classe Filament Originale | Classe XotBase da Usare | Metodi Abstract Richiesti | Staticità | Status |
|---------------------------|-------------------------|---------------------------|-----------|---------|
| `Filament\Pages\Dashboard` | `Modules\Xot\Filament\Pages\XotBaseDashboard` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Resources\Resource` | `Modules\Xot\Filament\Resources\XotBaseResource` | `getFormSchema(): array` | `static` | ✅ OBBLIGATORIO |
| `Filament\Resources\Pages\ListRecords` | `Modules\Xot\Filament\Resources\Pages\XotBaseListRecords` | `getTableColumns(): array` | `non-static` | ✅ OBBLIGATORIO |
| `Filament\Resources\Pages\CreateRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Resources\Pages\EditRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Resources\Pages\ViewRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord` | `getInfolistSchema(): array` | `non-static` | ✅ OBBLIGATORIO |
| `Filament\Resources\Pages\Page` | `Modules\Xot\Filament\Resources\Pages\XotBasePage` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Widgets\Widget` | `Modules\Xot\Filament\Widgets\XotBaseWidget` | `getFormSchema(): array` | `non-static` | ✅ OBBLIGATORIO |
| `Filament\Tables\Actions\Action` | `Modules\Xot\Filament\Tables\Actions\XotBaseTableAction` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Forms\Components\Component` | `Modules\Xot\Filament\Forms\Components\XotBaseFormComponent` | Nessuno | - | ✅ OBBLIGATORIO |
| `Filament\Clusters\Cluster` | `Modules\Xot\Filament\Clusters\XotBaseCluster` | Nessuno | - | ✅ OBBLIGATORIO |

## Esempi Pratici

### Resource Pages

#### ❌ VIETATO
```php
namespace Modules\MyModule\Filament\Resources\MyResource\Pages;

use Filament\Resources\Pages\CreateRecord;

class CreateMyResource extends CreateRecord // ❌ ERRORE GRAVE
{
    protected static string $resource = MyResource::class;
}
```

#### ✅ OBBLIGATORIO
```php
namespace Modules\MyModule\Filament\Resources\MyResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateMyResource extends XotBaseCreateRecord // ✅ CORRETTO
{
    protected static string $resource = MyResource::class;
}
```

### Resources

#### ❌ VIETATO
```php
namespace Modules\MyModule\Filament\Resources;

use Filament\Resources\Resource;

class MyResource extends Resource // ❌ ERRORE GRAVE
{
    protected static ?string $model = MyModel::class;
}
```

#### ✅ OBBLIGATORIO
```php
namespace Modules\MyModule\Filament\Resources;

use Modules\Xot\Filament\Resources\XotBaseResource;

class MyResource extends XotBaseResource // ✅ CORRETTO
{
    protected static ?string $model = MyModel::class;
}
```

### Widgets

#### ❌ VIETATO
```php
namespace Modules\MyModule\Filament\Widgets;

use Filament\Widgets\Widget;

class MyWidget extends Widget // ❌ ERRORE GRAVE
{
    // ...
}
```

#### ✅ OBBLIGATORIO
```php
namespace Modules\MyModule\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

class MyWidget extends XotBaseWidget // ✅ CORRETTO
{
    // ...
}
```

## Motivazioni Architetturali

### 1. Centralizzazione delle Funzionalità
- Funzionalità comuni implementate una sola volta nelle classi XotBase
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

### 4. Isolamento Modulare
- Ogni modulo può personalizzare il proprio comportamento
- Personalizzazioni locali senza impatto globale
- Compatibilità con logiche specifiche del modulo

## Controlli di Qualità

Prima di ogni commit, verificare che:

1. **Nessuna classe estenda direttamente classi Filament**
2. **Tutti gli import puntino a classi XotBase appropriate**
3. **La struttura del namespace sia coerente**
4. **PHPStan non segnali errori di tipo**
5. **La documentazione sia aggiornata**

## Esempi di Correzione

### Prima (ERRATO)
```php
namespace Modules\Employee\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard // ❌ VIETATO
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Employee';
}
```

### Dopo (CORRETTO)
```php
namespace Modules\Employee\Filament\Pages;

use Modules\Xot\Filament\Pages\XotBaseDashboard;

class Dashboard extends XotBaseDashboard // ✅ OBBLIGATORIO
{
    // ❌ NON ridefinire proprietà di navigazione:
    // protected static ?string $navigationIcon
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

## ⚠️ Errori Critici da Evitare

### 1. ❌ Cambio Staticità Metodi
```php
// ❌ ERRORE FATALE: Cambio staticità
class ListWorkHours extends XotBaseListRecords
{
    public static function getTableColumns(): array // ❌ STATIC su metodo NON-STATIC
    {
        return [];
    }
}
```

**Errore PHP:** `Cannot make non static method static in class`

### 2. ❌ Metodi Astratti Mancanti
```php
// ❌ ERRORE: Metodo astratto non implementato
class ViewLocation extends XotBaseViewRecord
{
    // MANCA: getInfolistSchema()
}
```

**Errore PHP:** `Class contains abstract methods and must therefore be declared abstract`

### 3. ❌ Estensione Diretta Filament
```php
// ❌ VIETATO: Estensione diretta
class WorkHourResource extends Resource
{
    // ERRORE CRITICO
}
```

## ✅ Pattern Corretti di Implementazione

### XotBaseResource (static)
```php
class WorkHourResource extends XotBaseResource
{
    protected static ?string $model = WorkHour::class;
    
    public static function getFormSchema(): array // ✅ STATIC
    {
        return [
            'employee_id' => Forms\Components\Select::make('employee_id')->required(),
            'timestamp' => Forms\Components\DateTimePicker::make('timestamp')->required(),
        ];
    }
}
```

### XotBaseListRecords (non-static)
```php
class ListWorkHours extends XotBaseListRecords
{
    protected static string $resource = WorkHourResource::class;
    
    public function getTableColumns(): array // ✅ NON-STATIC
    {
        return [
            'employee_id' => Tables\Columns\TextColumn::make('employee.first_name'),
            'timestamp' => Tables\Columns\TextColumn::make('timestamp')->dateTime(),
        ];
    }
}
```

### XotBaseViewRecord (non-static)
```php
class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;
    
    protected function getInfolistSchema(): array // ✅ NON-STATIC
    {
        return [
            Infolists\Components\TextEntry::make('name'),
            Infolists\Components\TextEntry::make('formatted_address'),
        ];
    }
}
```

## 🧠 Regole di Memoria

1. **XotBaseResource**: `getFormSchema()` → `static`
2. **XotBaseListRecords**: `getTableColumns()` → `non-static`  
3. **XotBaseViewRecord**: `getInfolistSchema()` → `non-static`
4. **XotBaseWidget**: `getFormSchema()` → `non-static`

## 📝 Checklist Pre-Implementazione

- [ ] ✅ Estendere XotBase invece di Filament
- [ ] ✅ Verificare namespace corretto (Modules\Xot\Filament\*)
- [ ] ✅ Implementare tutti i metodi astratti della classe base
- [ ] ✅ Mantenere la stessa staticità dei metodi ereditati
- [ ] ✅ Non cambiare mai `static` ↔ `non-static`
- [ ] ✅ Testare con PHPStan per verificare conformità
- [ ] ✅ Aggiornare documentazione del modulo

## Note Importanti

- **Nessuna eccezione** a questa regola di ereditarietà
- **Tutte le classi concrete** devono seguire il pattern XotBase → ClasseConcreta
- **Aggiornare sempre** la documentazione quando si modifica la catena di ereditarietà
- **Verificare PHPStan** per assicurarsi che non ci siano errori di tipo
- **Mantenere coerenza** tra tutti i moduli del progetto

## ⚠️ ERRORE: Metodo route() Mancante in XotBasePage

### Problema Identificato
```php
// ❌ ERRORE: XotBasePage non ha metodo route() statico
class PreviewNotificationTemplate extends XotBasePage
{
    // ...
}

// Nel Resource:
public static function getPages(): array
{
    return [
        'preview' => Pages\PreviewNotificationTemplate::route('/preview'), // ❌ Method does not exist
    ];
}
```

### Soluzione Temporanea
```php
// ✅ Usare la classe Filament base direttamente (SOLO per questo caso specifico)
use Filament\Resources\Pages\Page;

class PreviewNotificationTemplate extends Page
{
    protected static string $resource = NotificationTemplateResource::class;
    // ...
}
```

### Soluzione Definitiva
```php
// ✅ Creare XotBasePage con metodo route() (da implementare in Xot)
use Modules\Xot\Filament\Resources\Pages\XotBasePageWithRoute;

class PreviewNotificationTemplate extends XotBasePageWithRoute
{
    protected static string $resource = NotificationTemplateResource::class;
    // ...
}
```

## Collegamento alla Documentazione Generale

Per regole architetturali generali, consultare:
- [Documentazione Xot - Architettura Filament](../../Modules/Xot/docs/filament_architecture.md)
- [Regole Generali di Sviluppo](../../Modules/Xot/docs/development_rules.md)
- [Regole di Ereditarietà Modelli](../../docs/laraxot.md#estensione-modelli-tra-moduli)

## Backlinks
- [XotBase Patterns](../xot-base-patterns.md)
- [Filament XotBase Resource Rules](../filament-xotbase-resource-rules.md)
- [Module BaseModel Pattern](../module-basemodel-pattern.md)
- [LangBase Extension Rules](../langbase-extension-rules.md)