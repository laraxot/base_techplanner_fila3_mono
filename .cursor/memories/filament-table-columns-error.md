# Memoria: Errore Array Numerici getTableColumns (2025-01-06)

## Errore Critico Identificato
```
Method X::getTableColumns() should return array<string, Filament\Tables\Columns\Column> but returns array<int, Filament\Tables\Columns\TextColumn>.
```

## Causa dell'Errore
I metodi `getTableColumns()` restituiscono array numerici invece di array associativi con chiavi stringa.

## Pattern Corretto OBBLIGATORIO

### Struttura Corretta
```php
public function getTableColumns(): array
{
    return [
        'id' => TextColumn::make('id')           // ✅ Chiave stringa
            ->sortable()
            ->searchable(),
        'name' => TextColumn::make('name')       // ✅ Chiave stringa
            ->searchable(),
        'email' => TextColumn::make('email')     // ✅ Chiave stringa
            ->searchable(),
    ];
}
```

### Struttura Errata
```php
public function getTableColumns(): array
{
    return [
        TextColumn::make('id'),                  // ❌ Senza chiave
        TextColumn::make('name'),                // ❌ Senza chiave
        TextColumn::make('email'),               // ❌ Senza chiave
    ];
}
```

## File Corretti Recentemente
- ✅ `Modules/Cms/app/Filament/Resources/PageContentResource/Pages/ListPageContents.php`
- ✅ `Modules/Activity/app/Filament/Resources/StoredEventResource/Pages/ListStoredEvents.php`
- ✅ `Modules/Activity/app/Filament/Resources/ActivityResource/Pages/ListActivities.php`

## Checklist Pre-Implementazione

**PRIMA** di implementare `getTableColumns()`:

1. **Chiavi stringa**: Ogni colonna deve avere una chiave stringa
2. **Nomi descrittivi**: Usare nomi di campo come chiavi (es. 'id', 'name', 'email')
3. **Coerenza**: Mantenere coerenza con i nomi dei campi del modello
4. **PHPDoc**: Includere annotazione `@return array<string, Tables\Columns\Column>`

## Metodi Affetti

Questa regola si applica a **TUTTI** questi metodi:
- `getTableColumns()` - Colonne della tabella principale
- `getListTableColumns()` - Colonne per list pages
- `getGridTableColumns()` - Colonne per grid layout
- `getTableColumns()` in RelationManagers

## Controllo Automatico

Eseguire PHPStan per verificare la conformità:
```bash
cd laravel
./vendor/bin/phpstan analyze --level=9
```

## Motivazione

1. **Type Safety**: PHPStan richiede array associativi per type safety
2. **Identificazione Univoca**: Le chiavi stringa permettono identificazione univoca
3. **Override Sicuro**: Permette override sicuro di colonne specifiche
4. **Compatibilità**: Richiesto dal trait `HasXotTable`

## Anti-Pattern da Evitare

```php
// ❌ MAI fare questo
return [
    TextColumn::make('id'),           // Senza chiave
    TextColumn::make('name'),         // Senza chiave
    TextColumn::make('email'),        // Senza chiave
];

// ❌ MAI fare questo
return [
    0 => TextColumn::make('id'),      // Chiave numerica
    1 => TextColumn::make('name'),    // Chiave numerica
    2 => TextColumn::make('email'),   // Chiave numerica
];
```

## Pattern Corretto Completo

```php
/**
 * Definisce le colonne della tabella.
 *
 * @return array<string, Tables\Columns\Column>
 */
public function getTableColumns(): array
{
    return [
        'id' => TextColumn::make('id')
            ->sortable()
            ->searchable(),
        'name' => TextColumn::make('name')
            ->searchable()
            ->sortable(),
        'email' => TextColumn::make('email')
            ->searchable(),
        'status' => TextColumn::make('status')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'active' => 'success',
                'inactive' => 'danger',
                default => 'warning',
            }),
        'created_at' => TextColumn::make('created_at')
            ->dateTime()
            ->sortable(),
    ];
}
```

## Riferimenti

- [Regola: Array Associativi Obbligatori per getTableColumns](.cursor/rules/filament-table-columns-array-keys.md)
- [Regola: Metodi Obbligatori per List Records](.cursor/rules/filament-list-records-methods.md)

*Ultimo aggiornamento: 2025-01-06* 