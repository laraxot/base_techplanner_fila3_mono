# Regola: Metodi Obbligatori per List Records

## Problema Identificato (2025-01-06)
Le classi che estendono `XotBaseListRecords` devono implementare **ENTRAMBI** i metodi:
- `getListTableColumns()` - Per la definizione delle colonne
- `getTableColumns()` - Richiesto dal trait `HasXotTable`

## Metodi Obbligatori

### 1. getListTableColumns()
```php
/**
 * Definisce le colonne della tabella per la List Page.
 *
 * @return array<string, Tables\Columns\Column>
 */
public function getListTableColumns(): array
{
    return [
        'name' => Tables\Columns\TextColumn::make('name')
            ->searchable()
            ->sortable(),
        'email' => Tables\Columns\TextColumn::make('email')
            ->searchable(),
        'created_at' => Tables\Columns\TextColumn::make('created_at')
            ->dateTime()
            ->sortable(),
    ];
}
```

### 2. getTableColumns() - OBBLIGATORIO
```php
/**
 * Ottiene le colonne della tabella per il trait HasXotTable.
 *
 * @return array<string, Tables\Columns\Column>
 */
public function getTableColumns(): array
{
    return $this->getListTableColumns();
}
```

## Pattern Corretto Completo

```php
<?php

declare(strict_types=1);

namespace Modules\ModuleName\Filament\Resources\ResourceName\Pages;

use Filament\Actions;
use Filament\Tables;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\ModuleName\Filament\Resources\ResourceName;

class ListResourceName extends XotBaseListRecords
{
    protected static string $resource = ResourceName::class;

    /**
     * Definisce le colonne della tabella per la List Page.
     *
     * @return array<string, Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'name' => Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            'email' => Tables\Columns\TextColumn::make('email')
                ->searchable(),
            'created_at' => Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * Ottiene le colonne della tabella per il trait HasXotTable.
     *
     * @return array<string, Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return $this->getListTableColumns();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
```

## Errori Comuni da Evitare

### ❌ ERRATO - Manca getTableColumns()
```php
class ListResourceName extends XotBaseListRecords
{
    public function getListTableColumns(): array
    {
        return [
            'name' => Tables\Columns\TextColumn::make('name'),
        ];
    }
    // ❌ MANCA getTableColumns() - Causa errore "Method does not exist"
}
```

### ❌ ERRATO - getTableColumns() senza getListTableColumns()
```php
class ListResourceName extends XotBaseListRecords
{
    public function getTableColumns(): array
    {
        return [
            'name' => Tables\Columns\TextColumn::make('name'),
        ];
    }
    // ❌ MANCA getListTableColumns() - Non segue le convenzioni
}
```

### ✅ CORRETTO - Entrambi i metodi implementati
```php
class ListResourceName extends XotBaseListRecords
{
    public function getListTableColumns(): array
    {
        return [
            'name' => Tables\Columns\TextColumn::make('name'),
        ];
    }

    public function getTableColumns(): array
    {
        return $this->getListTableColumns();
    }
}
```

## Checklist Pre-Implementazione

Prima di creare una List Page, verificare SEMPRE:

- [ ] La classe estende `XotBaseListRecords`
- [ ] Implementato `getListTableColumns()` con array associativo
- [ ] Implementato `getTableColumns()` che chiama `getListTableColumns()`
- [ ] Tutte le colonne hanno chiavi stringa
- [ ] PHPDoc completo per entrambi i metodi

## Validazione Automatica

Eseguire questi controlli prima di ogni commit:

```bash
# Cerca classi che estendono XotBaseListRecords
grep -r "extends XotBaseListRecords" Modules/ --include="*.php"

# Cerca classi con getListTableColumns ma senza getTableColumns
grep -r "getListTableColumns" Modules/ --include="*.php" | grep -v "getTableColumns"

# Cerca classi con getTableColumns ma senza getListTableColumns
grep -r "getTableColumns" Modules/ --include="*.php" | grep -v "getListTableColumns"
```

## Motivazione

1. **getListTableColumns()**: Convenzione Filament per definire colonne
2. **getTableColumns()**: Richiesto dal trait `HasXotTable` per layout dinamici
3. **Coerenza**: Entrambi i metodi devono esistere per compatibilità
4. **Manutenibilità**: Un solo punto di verità per le definizioni delle colonne

## Backlink e Riferimenti

- [Filament List Records Inheritance](../../docs/filament_list_records_inheritance.md)
- [Filament Table Columns Structure](../../docs/filament_table_columns_structure.md)
- [XotBaseListRecords Documentation](../../Modules/Xot/docs/filament/xotbaselistrecords.md)

*Ultimo aggiornamento: 2025-01-06* 