# Memoria: Errore Visibilità Metodi Filament (2025-01-06)

## Errore Critico Identificato
```
Access level to Modules\Xot\Filament\Resources\ModuleResource\Pages\ListModules::getTableBulkActions() must be public (as in class Modules\Xot\Filament\Resources\Pages\XotBaseListRecords)
```

## Causa dell'Errore
I metodi Filament devono avere la visibilità corretta per rispettare l'ereditarietà delle classi base.

## Metodi che DEVONO essere PUBLIC

### Metodi di Tabella (PUBLIC obbligatorio)
- `getTableColumns()` - **PUBLIC**
- `getTableActions()` - **PUBLIC**
- `getTableBulkActions()` - **PUBLIC**
- `getTableFilters()` - **PUBLIC**
- `getTableHeaderActions()` - **PUBLIC**
- `getTableRecordAction()` - **PUBLIC**

### Metodi di Form (PUBLIC obbligatorio)
- `getFormSchema()` - **PUBLIC**
- `getFormActions()` - **PUBLIC**

### Metodi di Widget (PROTECTED permesso)
- `getTableQuery()` - **PROTECTED** (può essere protected)
- `getTableRecordsPerPageSelectOptions()` - **PROTECTED** (può essere protected)

## Pattern Corretto OBBLIGATORIO

### Struttura Corretta
```php
class ListResourceName extends XotBaseListRecords
{
    public function getTableColumns(): array  // ✅ PUBLIC
    {
        return [
            'id' => TextColumn::make('id'),
            'name' => TextColumn::make('name'),
        ];
    }

    public function getTableActions(): array  // ✅ PUBLIC
    {
        return [
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    public function getTableBulkActions(): array  // ✅ PUBLIC
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }
}
```

### Struttura Errata
```php
class ListResourceName extends XotBaseListRecords
{
    protected function getTableColumns(): array  // ❌ PROTECTED
    {
        return [
            'id' => TextColumn::make('id'),
        ];
    }

    private function getTableActions(): array  // ❌ PRIVATE
    {
        return [
            'edit' => EditAction::make(),
        ];
    }
}
```

## File Corretti Recentemente
- ✅ `Modules/Job/app/Filament/Resources/ScheduleResource/Pages/ViewSchedule.php`
- ✅ `Modules/Geo/app/Filament/Widgets/LocationMapTableWidget.php`

## Checklist Pre-Implementazione

**PRIMA** di implementare metodi Filament:

1. **getTableColumns()**: PUBLIC obbligatorio
2. **getTableActions()**: PUBLIC obbligatorio
3. **getTableBulkActions()**: PUBLIC obbligatorio
4. **getTableFilters()**: PUBLIC obbligatorio
5. **getFormSchema()**: PUBLIC obbligatorio
6. **getTableQuery()**: PROTECTED (può essere protected)
7. **PHPDoc**: Includere annotazioni di tipo corrette

## Controllo Automatico

Eseguire PHPStan per verificare la conformità:
```bash
cd laravel
./vendor/bin/phpstan analyze --level=9
```

## Motivazione

1. **Ereditarietà**: I metodi devono rispettare la visibilità delle classi base
2. **Override**: I metodi pubblici permettono override sicuro
3. **Compatibilità**: Richiesto dal trait `HasXotTable`
4. **Type Safety**: PHPStan verifica la visibilità corretta

## Anti-Pattern da Evitare

```php
// ❌ MAI fare questo
protected function getTableColumns(): array  // Visibilità errata
{
    return [];
}

// ❌ MAI fare questo
private function getTableActions(): array  // Visibilità errata
{
    return [];
}
```

## Pattern Corretto Completo

```php
/**
 * List Records Page per Resource.
 */
class ListResourceName extends XotBaseListRecords
{
    protected static string $resource = ResourceName::class;

    /**
     * Definisce le colonne della tabella.
     *
     * @return array<string, Tables\Columns\Column>
     */
    public function getTableColumns(): array  // ✅ PUBLIC
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'name' => TextColumn::make('name')
                ->searchable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * Definisce le azioni della tabella.
     *
     * @return array<string, Tables\Actions\Action>
     */
    public function getTableActions(): array  // ✅ PUBLIC
    {
        return [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
     * Definisce le azioni bulk della tabella.
     *
     * @return array<string, Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array  // ✅ PUBLIC
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }

    /**
     * Definisce i filtri della tabella.
     *
     * @return array<string, Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array  // ✅ PUBLIC
    {
        return [
            'status' => SelectFilter::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),
        ];
    }
}
```

## Riferimenti

- [Regola: Visibilità Metodi Filament](.cursor/rules/filament-method-visibility.md)
- [Regola: Array Associativi Obbligatori per getTableColumns](.cursor/rules/filament-table-columns-array-keys.md)

*Ultimo aggiornamento: 2025-01-06* 