# Regola: Array Associativi Obbligatori per getTableColumns

## Problema Identificato (2025-01-06)
I metodi `getTableColumns()` devono **SEMPRE** restituire array associativi con chiavi stringa, non array numerici.

## Errore PHPStan
```
Method X::getTableColumns() should return array<string, Filament\Tables\Columns\Column> but returns array<int, Filament\Tables\Columns\TextColumn>.
```

## Pattern Corretto OBBLIGATORIO

### ✅ DO - Array Associativo con Chiavi Stringa
```php
public function getTableColumns(): array
{
    return [
        'id' => TextColumn::make('id')
            ->sortable()
            ->searchable(),
        'name' => TextColumn::make('name')
            ->searchable(),
        'email' => TextColumn::make('email')
            ->searchable(),
        'created_at' => TextColumn::make('created_at')
            ->dateTime()
            ->sortable(),
    ];
}
```

### ❌ DON'T - Array Numerico (ERRORE)
```php
public function getTableColumns(): array
{
    return [
        TextColumn::make('id')           // ❌ Senza chiave stringa
            ->sortable()
            ->searchable(),
        TextColumn::make('name')         // ❌ Senza chiave stringa
            ->searchable(),
        TextColumn::make('email')        // ❌ Senza chiave stringa
            ->searchable(),
    ];
}
```

## Checklist Pre-Implementazione

Prima di implementare `getTableColumns()`:

- [ ] **Chiavi stringa**: Ogni colonna deve avere una chiave stringa
- [ ] **Nomi descrittivi**: Usare nomi di campo come chiavi (es. 'id', 'name', 'email')
- [ ] **Coerenza**: Mantenere coerenza con i nomi dei campi del modello
- [ ] **PHPDoc**: Includere annotazione `@return array<string, Tables\Columns\Column>`

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

## File Corretti Recentemente

- ✅ `Modules/Cms/app/Filament/Resources/PageContentResource/Pages/ListPageContents.php`
- ✅ `Modules/Activity/app/Filament/Resources/StoredEventResource/Pages/ListStoredEvents.php`
- ✅ `Modules/Activity/app/Filament/Resources/ActivityResource/Pages/ListActivities.php`

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

*Ultimo aggiornamento: 2025-01-06* 