# Regole Critiche per Filament - Prevenzione Errori FatalError

## REGOLA FONDAMENTALE: Estendere SEMPRE Classi XotBase

### Principio Assoluto
**NON estendiamo MAI classi Filament direttamente. Estendiamo SEMPRE classi astratte con prefisso `XotBase` dal modulo `Xot`.**

### Mappatura Obbligatoria
```php
// ❌ MAI fare questo - Estensione diretta Filament
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;

// ✅ SEMPRE fare questo - Estensione XotBase
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Xot\Filament\Resources\Pages\XotBasePage;
```

### Esempi di Implementazione Corretta

#### CreateRecord
```php
<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\TechPlanner\Filament\Resources\ClientResource;

class CreateClient extends XotBaseCreateRecord // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### EditRecord
```php
<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\TechPlanner\Filament\Resources\ClientResource;

class EditClient extends XotBaseEditRecord // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### ListRecords
```php
<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\TechPlanner\Filament\Resources\ClientResource;

class ListClients extends XotBaseListRecords // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### Page
```php
<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBasePage;

class Dashboard extends XotBasePage // ✅ CORRETTO
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
}
```

## Regola 1: XotBaseViewRecord - Metodo getInfolistSchema Obbligatorio

### Ambito
Globale (tutti i moduli)

### Motivazione
Evitare FatalError "abstract method not implemented"

### Regola
Chi estende `XotBaseViewRecord` DEVE implementare il metodo `getInfolistSchema()` con visibilità `protected`

### Esempio Pratico
```php
<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

use Filament\Pages\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Geo\Filament\Resources\LocationResource;

class ViewLocation extends XotBaseViewRecord // ✅ CORRETTO
{
    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    /**
     * @return array<int|string,\Filament\Infolists\Components\Component>
     */
    protected function getInfolistSchema(): array
    {
        return [
            Section::make('Informazioni Base')
                ->schema([
                    TextEntry::make('name')->label('Nome'),
                    TextEntry::make('description')->label('Descrizione'),
                ])
                ->collapsible(),
        ];
    }
}
```

### Anti-Pattern
```php
// ❌ ERRATO: Estensione diretta Filament
use Filament\Resources\Pages\ViewRecord;

class ViewLocation extends ViewRecord // ERRORE! Deve estendere XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

    // Manca getInfolistSchema() - causerà FatalError!
}
```

## Regola 2: XotBaseWidget - Metodo getFormSchema DEVE essere PUBBLICO

### Ambito
Globale (tutti i moduli)

### Motivazione
Evitare FatalError "abstract method not implemented" per visibilità sbagliata

### Regola
Chi estende `XotBaseWidget` DEVE implementare il metodo `getFormSchema()` con visibilità `public`

### Esempio Pratico
```php
<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget; // ✅ CORRETTO

class ClockWidget extends XotBaseWidget // ✅ CORRETTO
{
    protected static string $view = 'job::filament.widgets.clock-widget';
    protected int|string|array $columnSpan = 'full';

    /**
     * ⚠️ IMPORTANTE: Questo metodo deve essere PUBBLICO, non protetto!
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array // ⚠️ PUBBLICO, non protected!
    {
        return [
            // Schema del form del widget
            // Per ora vuoto, ma può essere esteso in futuro
        ];
    }

    // Altri metodi del widget...
}
```

### Anti-Pattern
```php
// ❌ ERRATO: Estensione diretta Filament
use Filament\Widgets\Widget;

class ClockWidget extends Widget // ERRORE! Deve estendere XotBaseWidget
{
    protected static string $view = 'job::filament.widgets.clock-widget';

    protected function getFormSchema(): array // ERRORE! Deve essere public
    {
        return [];
    }
}
```

## Regola 3: XotBaseResource - NO Metodo Table, NO getTableColumns

### Ambito
Globale (tutti i moduli)

### Motivazione
Evitare duplicazione e conflitti con gestione automatica

### Regola
Chi estende `XotBaseResource` NON deve implementare il metodo `table()` e NON deve implementare `getTableColumns()`

### Esempio Pratico
```php
<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Modules\Xot\Filament\Resources\XotBaseResource; // ✅ CORRETTO

class ClientResource extends XotBaseResource // ✅ CORRETTO
{
    // NIENTE metodo table() - gestito automaticamente da XotBaseResource
    // NIENTE metodo getTableColumns() - gestito automaticamente da XotBaseResource
    
    public function getFormSchema(): array
    {
        return [
            // Schema del form
        ];
    }

    // Altri metodi della resource...
}
```

### Anti-Pattern
```php
// ❌ ERRATO: Metodi duplicati
class ClientResource extends XotBaseResource
{
    public function table(Table $table): Table // ERRORE! Duplicazione
    {
        return $table->columns([/* colonne */]);
    }

    public function getTableColumns(): array // ERRORE! Duplicazione
    {
        return [/* colonne */];
    }
}
```

## Regola 4: Estensione Diretta Filament VIETATA

### Classi VIETATE per Estensione Diretta
```php
// ❌ MAI estendere queste classi direttamente
Filament\Resources\Pages\CreateRecord
Filament\Resources\Pages\EditRecord
Filament\Resources\Pages\ListRecords
Filament\Resources\Pages\Page
Filament\Resources\Pages\ViewRecord
Filament\Widgets\Widget
Filament\Resources\Resource
Filament\Forms\Form
Filament\Tables\Table
```

### Classi CORRETTE per Estensione
```php
// ✅ SEMPRE estendere queste classi
Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord
Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
Modules\Xot\Filament\Resources\Pages\XotBaseListRecords
Modules\Xot\Filament\Resources\Pages\XotBasePage
Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
Modules\Xot\Filament\Widgets\XotBaseWidget
Modules\Xot\Filament\Resources\XotBaseResource
```

## Checklist per Evitare Errori

### Prima di Creare Classi Filament

- [ ] **Import**: Verificare che si importi la classe XotBase corretta
- [ ] **Estensione**: Verificare che si estenda la classe XotBase corretta
- [ ] **Namespace**: Verificare che non si estendano classi Filament direttamente
- [ ] **Metodi**: Verificare che non si duplichino metodi già gestiti da XotBase

### Durante lo Sviluppo

- [ ] Eseguire PHPStan livello 9+ per verificare tipizzazione
- [ ] Testare le pagine Filament dopo modifiche
- [ ] Verificare che non ci siano errori di sintassi
- [ ] Controllare che tutti i metodi astratti siano implementati
- [ ] Verificare che non si estendano classi Filament direttamente

### Dopo le Modifiche

- [ ] Aggiornare la documentazione del modulo
- [ ] Aggiornare la documentazione root se necessario
- [ ] Creare collegamenti bidirezionali
- [ ] Documentare eventuali errori risolti
- [ ] Verificare che si rispettino le regole XotBase

## Errori Comuni e Soluzioni

### Errore: Estensione Diretta Filament
```
FatalError: Class extends non-existent class
```

**Soluzione**: Cambiare l'estensione da classe Filament a classe XotBase corrispondente

### Errore: Metodo Table Duplicato
```
Error: Method table() already defined in parent class
```

**Soluzione**: Rimuovere il metodo `table()` dalle classi che estendono `XotBaseResource`

### Errore: Metodo getTableColumns Duplicato
```
Error: Method getTableColumns() already defined in parent class
```

**Soluzione**: Rimuovere il metodo `getTableColumns()` dalle classi che estendono `XotBaseResource`

## Collegamenti e Riferimenti

- [Filament ViewRecord Errors](../../docs/filament-view-record-errors.md)
- [Testing Analysis](../../docs/testing-analysis.md)
- [XotBase Classes Source](../../laravel/Modules/Xot/app/Filament/)
- [Filament Official Documentation](https://filamentphp.com/docs)

## Note di Manutenzione

- **Data Creazione**: 2025-01-06
- **Motivazione**: Prevenzione errori FatalError in Filament e rispetto architettura XotBase
- **Autore**: AI Assistant
- **Stato**: Completato e verificato
- **Ultimo Aggiornamento**: 2025-01-06

---

**IMPORTANTE**: 
1. **NON estendere MAI classi Filament direttamente**
2. **SEMPRE estendere classi XotBase corrispondenti**
3. **NON implementare mai metodi già gestiti da XotBase**
4. **Verificare SEMPRE gli import e le estensioni**
5. **Rispettare SEMPRE l'architettura modulare Laraxot**
