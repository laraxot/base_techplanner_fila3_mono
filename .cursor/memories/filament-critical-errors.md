# Memorie Critiche per Filament - Prevenzione Errori FatalError

## REGOLA FONDAMENTALE: Estendere SEMPRE Classi XotBase

### Principio Assoluto
**NON estendiamo MAI classi Filament direttamente. Estendiamo SEMPRE classi astratte con prefisso `XotBase` dal modulo `Xot`.**

### Mappatura Obbligatoria da Ricordare SEMPRE
```php
// ❌ MAI fare questo - Estensione diretta Filament
Filament\Resources\Pages\CreateRecord → Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord
Filament\Resources\Pages\EditRecord → Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
Filament\Resources\Pages\ListRecords → Modules\Xot\Filament\Resources\Pages\XotBaseListRecords
Filament\Resources\Pages\Page → Modules\Xot\Filament\Resources\Pages\XotBasePage
Filament\Resources\Pages\ViewRecord → Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
Filament\Widgets\Widget → Modules\Xot\Filament\Widgets\XotBaseWidget
Filament\Resources\Resource → Modules\Xot\Filament\Resources\XotBaseResource
```

### Esempi di Implementazione Corretta da Ricordare

#### CreateRecord
```php
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateClient extends XotBaseCreateRecord // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### EditRecord
```php
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditClient extends XotBaseEditRecord // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### ListRecords
```php
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListClients extends XotBaseListRecords // ✅ CORRETTO
{
    protected static string $resource = ClientResource::class;
}
```

#### Page
```php
use Modules\Xot\Filament\Resources\Pages\XotBasePage;

class Dashboard extends XotBasePage // ✅ CORRETTO
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
}
```

## Errore 1: XotBaseViewRecord - Metodo getInfolistSchema Mancante

### Contesto
- **Data**: 2025-01-06
- **File**: `Modules/Geo/app/Filament/Resources/LocationResource/Pages/ViewLocation.php`
- **Errore**: `FatalError: Class ViewLocation contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (XotBaseViewRecord::getInfolistSchema)`
- **Rotta**: `GET /employee/admin/work-hours/create`

### Causa
La classe `ViewLocation` estendeva `XotBaseViewRecord` ma non implementava il metodo astratto `getInfolistSchema()`.

### Soluzione
Implementare il metodo `getInfolistSchema()` con visibilità `protected`:

```php
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
```

### Regola da Ricordare
**Chi estende `XotBaseViewRecord` DEVE implementare il metodo `getInfolistSchema()` con visibilità `protected`**

## Errore 2: XotBaseWidget - Metodo getFormSchema Visibilità Sbagliata

### Contesto
- **Data**: 2025-01-06
- **File**: `Modules/Job/app/Filament/Widgets/ClockWidget.php`
- **Errore**: `FatalError: Class ClockWidget contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (XotBaseWidget::getFormSchema)`
- **Rotta**: `GET /employee/admin/work-hours/create`

### Causa
La classe `ClockWidget` estendeva `XotBaseWidget` ma implementava il metodo `getFormSchema()` con visibilità **protetta** invece che **pubblica**.

### Soluzione
Cambiare la visibilità del metodo da `protected` a `public`:

```php
// ❌ ERRATO: Metodo protetto
protected function getFormSchema(): array
{
    return [];
}

// ✅ CORRETTO: Metodo pubblico
public function getFormSchema(): array
{
    return [];
}
```

### Regola da Ricordare
**Chi estende `XotBaseWidget` DEVE implementare il metodo `getFormSchema()` con visibilità `public`**

## Regola 3: XotBaseResource - NO Metodo Table, NO getTableColumns

### Contesto
- **Data**: 2025-01-06
- **Motivazione**: Prevenzione duplicazione e conflitti

### Regola
**Chi estende `XotBaseResource` NON deve implementare il metodo `table()` e NON deve implementare `getTableColumns()`**

### Esempio
```php
// ❌ ERRATO: Metodi duplicati
class MyResource extends XotBaseResource
{
    public function table(Table $table): Table // ERRORE!
    {
        return $table->columns([/* colonne */]);
    }

    public function getTableColumns(): array // ERRORE!
    {
        return [/* colonne */];
    }
}

// ✅ CORRETTO: Niente metodi duplicati
class MyResource extends XotBaseResource
{
    // NIENTE metodo table() - gestito automaticamente
    // NIENTE metodo getTableColumns() - gestito automaticamente
}
```

## Pattern di Prevenzione

### 1. Checklist Prima di Creare Classi Filament
- [ ] **Import**: Verificare che si importi la classe XotBase corretta
- [ ] **Estensione**: Verificare che si estenda la classe XotBase corretta
- [ ] **Namespace**: Verificare che non si estendano classi Filament direttamente
- [ ] **Metodi**: Verificare che non si duplichino metodi già gestiti da XotBase

### 2. Verifica Durante lo Sviluppo
- [ ] Eseguire PHPStan livello 9+ per verificare tipizzazione
- [ ] Testare le pagine Filament dopo modifiche
- [ ] Verificare che non ci siano errori di sintassi
- [ ] Controllare che tutti i metodi astratti siano implementati
- [ ] Verificare che non si estendano classi Filament direttamente

### 3. Documentazione Post-Implementazione
- [ ] Aggiornare la documentazione del modulo
- [ ] Aggiornare la documentazione root se necessario
- [ ] Creare collegamenti bidirezionali
- [ ] Documentare eventuali errori risolti
- [ ] Verificare che si rispettino le regole XotBase

## Errori Comuni e Soluzioni Rapide

### Errore: Estensione Diretta Filament
**Sintomo**: `FatalError: Class extends non-existent class`
**Soluzione**: Cambiare l'estensione da classe Filament a classe XotBase corrispondente

### Errore: Abstract Method Not Implemented
**Sintomo**: `FatalError: Class contains 1 abstract method`
**Soluzione**: Implementare il metodo astratto richiesto con visibilità corretta

### Errore: Method Visibility Mismatch
**Sintomo**: `FatalError: Method visibility mismatch`
**Soluzione**: Verificare che `getFormSchema()` sia `public` per widget e `getInfolistSchema()` sia `protected` per ViewRecord

### Errore: Method Table Already Defined
**Sintomo**: `Error: Method table() already defined in parent class`
**Soluzione**: Rimuovere il metodo `table()` dalle classi che estendono `XotBaseResource`

### Errore: Method getTableColumns Already Defined
**Sintomo**: `Error: Method getTableColumns() already defined in parent class`
**Soluzione**: Rimuovere il metodo `getTableColumns()` dalle classi che estendono `XotBaseResource`

## Collegamenti di Riferimento

- [Filament ViewRecord Errors](../../docs/filament-view-record-errors.md)
- [Testing Analysis](../../docs/testing-analysis.md)
- [Critical Filament Rules](../../.cursor/rules/filament-critical-rules.md)
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
6. **Aggiorna SEMPRE la documentazione per evitare errori futuri**
7. **Ricorda SEMPRE la mappatura obbligatoria XotBase**
