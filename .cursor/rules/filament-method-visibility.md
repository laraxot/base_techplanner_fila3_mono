# Regola: Visibilità Metodi Filament

## Problema Identificato (2025-01-06)
I metodi Filament devono avere la visibilità corretta per rispettare l'ereditarietà delle classi base.

## Errore Comune
```
Access level to X::getTableBulkActions() must be public (as in class Y)
```

## Metodi che DEVONO essere PUBLIC

### Metodi di Tabella
- `getTableColumns()` - **PUBLIC** obbligatorio
- `getTableActions()` - **PUBLIC** obbligatorio
- `getTableBulkActions()` - **PUBLIC** obbligatorio
- `getTableFilters()` - **PUBLIC** obbligatorio
- `getTableHeaderActions()` - **PUBLIC** obbligatorio
- `getTableRecordAction()` - **PUBLIC** obbligatorio

### Metodi di Form
- `getFormSchema()` - **PUBLIC** obbligatorio
- `getFormActions()` - **PUBLIC** obbligatorio

### Metodi di Widget
- `getTableQuery()` - **PROTECTED** (può essere protected)
- `getTableRecordsPerPageSelectOptions()` - **PROTECTED** (può essere protected)

## Pattern Corretto OBBLIGATORIO

### ✅ DO - Visibilità Corretta
```php
class ListResourceName extends XotBaseListRecords
{
    /**
     * @return array<string, Tables\Columns\Column>
     */
    public function getTableColumns(): array  // ✅ PUBLIC
    {
        return [
            'id' => TextColumn::make('id'),
            'name' => TextColumn::make('name'),
        ];
    }

    /**
     * @return array<string, Tables\Actions\Action>
     */
    public function getTableActions(): array  // ✅ PUBLIC
    {
        return [
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
     * @return array<string, Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array  // ✅ PUBLIC
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }

    /**
     * @return array<string, Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array  // ✅ PUBLIC
    {
        return [
            'status' => SelectFilter::make('status'),
        ];
    }
}
```

### ❌ DON'T - Visibilità Errata
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

## Checklist Pre-Implementazione

Prima di implementare metodi Filament:

- [ ] **getTableColumns()**: PUBLIC obbligatorio
- [ ] **getTableActions()**: PUBLIC obbligatorio
- [ ] **getTableBulkActions()**: PUBLIC obbligatorio
- [ ] **getTableFilters()**: PUBLIC obbligatorio
- [ ] **getFormSchema()**: PUBLIC obbligatorio
- [ ] **getTableQuery()**: PROTECTED (può essere protected)
- [ ] **PHPDoc**: Includere annotazioni di tipo corrette

## Controllo Automatico

Eseguire PHPStan per verificare la conformità:
```bash
cd laravel
./vendor/bin/phpstan analyze --level=9
```

## File Corretti Recentemente

- ✅ `Modules/Job/app/Filament/Resources/ScheduleResource/Pages/ViewSchedule.php`
- ✅ `Modules/Geo/app/Filament/Widgets/LocationMapTableWidget.php`

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

*Ultimo aggiornamento: 2025-01-06* 