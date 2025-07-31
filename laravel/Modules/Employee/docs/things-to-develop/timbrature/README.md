# Sistema di Timbrature - Modulo Employee

## Panoramica

Il sistema di timbrature del modulo Employee gestisce l'ingresso e l'uscita dei dipendenti con supporto per:
- Timbrature automatiche (badge, biometrico)
- Timbrature manuali (app, web)
- Geolocalizzazione
- Gestione stati e correzioni
- Integrazione con sistema presenze

## Struttura Implementata

### Migrazione
- **File**: `database/migrations/2025_01_06_000001_create_timbrature_table.php`
- **Tabella**: `timbrature`
- **Regole**: Estende `XotBaseMigration`, classe anonima, solo metodo `up()`

### Modello
- **File**: `app/Models/Timbratura.php`
- **Classe**: `Timbratura extends BaseModel`
- **Regole**: Estende `BaseModel` del modulo Employee

## Campi della Tabella

| Campo | Tipo | Descrizione |
|-------|------|-------------|
| `id` | int | Chiave primaria autoincrement |
| `user_id` | int | Chiave esterna verso users |
| `data_timbratura` | datetime | Data e ora della timbratura |
| `tipo` | enum | 'entrata' o 'uscita' |
| `metodo` | enum | 'badge', 'pin', 'biometrico', 'app', 'web' |
| `latitudine` | string | Coordinata latitudine (opzionale) |
| `longitudine` | string | Coordinata longitudine (opzionale) |
| `indirizzo` | string | Indirizzo geolocalizzato (opzionale) |
| `note` | text | Note aggiuntive (opzionale) |
| `stato` | enum | 'valida', 'corretta', 'annullata' |
| `is_manuale` | boolean | Flag per timbrature manuali |
| `created_by` | int | Utente che ha creato la timbratura |
| `updated_by` | int | Utente che ha modificato la timbratura |
| `created_at` | datetime | Timestamp di creazione |
| `updated_at` | datetime | Timestamp di aggiornamento |

## Relazioni

- **user**: BelongsTo verso `Modules\User\Models\User`
- **createdBy**: BelongsTo verso `Modules\User\Models\User` (created_by)
- **updatedBy**: BelongsTo verso `Modules\User\Models\User` (updated_by)

## Scopes Disponibili

- `scopeForUser($query, $userId)`: Filtra per utente
- `scopeOfType($query, $tipo)`: Filtra per tipo (entrata/uscita)
- `scopeForDate($query, $date)`: Filtra per data
- `scopeValid($query)`: Solo timbrature valide

## Accessors

- `formatted_data_timbratura`: Data formattata (d/m/Y H:i:s)
- `formatted_time`: Solo ora (H:i:s)
- `formatted_date`: Solo data (d/m/Y)

## Metodi di Utilità

- `isEntry()`: Verifica se è timbratura di entrata
- `isExit()`: Verifica se è timbratura di uscita
- `isManual()`: Verifica se è timbratura manuale
- `hasLocation()`: Verifica se ha dati di geolocalizzazione

## Indici Database

- `user_id, data_timbratura`: Indice composito per query per utente e data
- `data_timbratura`: Indice per query temporali
- `tipo`: Indice per filtri per tipo
- `stato`: Indice per filtri per stato

## Regole di Compliance

### Migrazione
- ✅ Classe anonima che estende `XotBaseMigration`
- ✅ Solo metodo `up()`, nessun metodo `down()`
- ✅ Verifica esistenza tabella con `hasTable()`
- ✅ Indici per performance

### Modello
- ✅ Estende `BaseModel` del modulo Employee
- ✅ Proprietà `$fillable` con annotazione `@var list<string>`
- ✅ Metodo `casts()` invece di proprietà `$casts`
- ✅ PHPDoc completo per tutte le proprietà
- ✅ Tipizzazione rigorosa per tutti i metodi

## Prossimi Passi

1. **Filament Resource**: Creare `TimbraturaResource` che estende `XotBaseResource`
2. **Widget**: Creare widget per dashboard timbrature
3. **API**: Endpoint per timbrature mobile
4. **Validazioni**: Regole di validazione per timbrature
5. **Traduzioni**: File di traduzione per interfaccia

## Collegamenti

- [Regole Migrazioni](../../../Xot/docs/migration_base_rules.md)
- [Regole Modelli](../../../Xot/docs/model_base_rules.md)
- [Regole XotBase](../../xotbase_extension_rules.md) 