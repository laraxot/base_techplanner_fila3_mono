# Memoria: Errore Filament List Records (2025-01-06)

## Errore Critico Identificato
```
BadMethodCallException
Method Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages\ListAppointments::getTableColumns does not exist.
```

## Causa dell'Errore
Le classi che estendono `XotBaseListRecords` devono implementare **ENTRAMBI** i metodi:
- `getListTableColumns()` - Per la definizione delle colonne
- `getTableColumns()` - Richiesto dal trait `HasXotTable`

## Pattern Corretto OBBLIGATORIO

### Struttura Completa
```php
class ListResourceName extends XotBaseListRecords
{
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
}
```

## Checklist Pre-Implementazione OBBLIGATORIA

Prima di creare qualsiasi List Page, verificare SEMPRE:

1. **Estensione Corretta**: `extends XotBaseListRecords`
2. **getListTableColumns()**: Implementato con array associativo
3. **getTableColumns()**: Implementato che chiama `getListTableColumns()`
4. **Chiavi Stringa**: Tutte le colonne devono avere chiavi stringa
5. **PHPDoc Completo**: Per entrambi i metodi

## Validazione Automatica

Eseguire SEMPRE questi controlli:

```bash
# Cerca classi che potrebbero avere il problema
grep -r "extends XotBaseListRecords" Modules/ --include="*.php"

# Cerca classi con getListTableColumns ma senza getTableColumns
grep -r "getListTableColumns" Modules/ --include="*.php" | grep -v "getTableColumns"

# Cerca classi con getTableColumns ma senza getListTableColumns  
grep -r "getTableColumns" Modules/ --include="*.php" | grep -v "getListTableColumns"
```

## Errori Comuni da Evitare

### ❌ ERRATO - Solo getListTableColumns()
```php
class ListResourceName extends XotBaseListRecords
{
    public function getListTableColumns(): array
    {
        return ['name' => Tables\Columns\TextColumn::make('name')];
    }
    // ❌ MANCA getTableColumns() - Causa errore "Method does not exist"
}
```

### ❌ ERRATO - Solo getTableColumns()
```php
class ListResourceName extends XotBaseListRecords
{
    public function getTableColumns(): array
    {
        return ['name' => Tables\Columns\TextColumn::make('name')];
    }
    // ❌ MANCA getListTableColumns() - Non segue convenzioni
}
```

### ✅ CORRETTO - Entrambi i metodi
```php
class ListResourceName extends XotBaseListRecords
{
    public function getListTableColumns(): array
    {
        return ['name' => Tables\Columns\TextColumn::make('name')];
    }

    public function getTableColumns(): array
    {
        return $this->getListTableColumns();
    }
}
```

## Motivazione Tecnica

1. **getListTableColumns()**: Convenzione Filament per definire colonne
2. **getTableColumns()**: Richiesto dal trait `HasXotTable` per layout dinamici
3. **Coerenza**: Entrambi i metodi devono esistere per compatibilità
4. **Manutenibilità**: Un solo punto di verità per le definizioni delle colonne

## File Corretti (2025-01-06)
- ✅ `Modules/TechPlanner/app/Filament/Resources/AppointmentResource/Pages/ListAppointments.php`

## Regole Aggiornate
- ✅ `.cursor/rules/filament-list-records-methods.md`

## Documentazione Aggiornata
- ✅ Pattern completo con entrambi i metodi
- ✅ Checklist pre-implementazione obbligatoria
- ✅ Validazione automatica

*Ultimo aggiornamento: 2025-01-06* 