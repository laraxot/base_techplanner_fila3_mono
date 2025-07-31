# Regola Critica: Nomi Modelli SEMPRE in Inglese

## ⚠️ REGOLA ASSOLUTA ⚠️

**MAI** usare nomi italiani per modelli, classi, metodi, proprietà in Laravel.

## Principi Fondamentali

### ✅ CORRETTO - Nomi Inglesi Standard
```php
// Modelli
class TimeRecord extends BaseModel { }
class Employee extends BaseModel { }
class Contract extends BaseModel { }
class Department extends BaseModel { }
class Location extends BaseModel { }

// Metodi
public function getFormattedTimestampAttribute(): string { }
public function isEntry(): bool { }
public function hasLocation(): bool { }

// Proprietà
protected $fillable = ['timestamp', 'type', 'method', 'status'];
```

### ❌ ERRATO - Nomi Italiani (VIETATO)
```php
// ❌ MAI fare questo
class Timbratura extends BaseModel { }
class Dipendente extends BaseModel { }
class Contratto extends BaseModel { }
class Reparto extends BaseModel { }
class Luogo extends BaseModel { }

// ❌ Metodi italiani
public function getFormattedDataTimbraturaAttribute(): string { }
public function isEntrata(): bool { }
public function hasIndirizzo(): bool { }

// ❌ Proprietà italiane
protected $fillable = ['data_timbratura', 'tipo', 'metodo', 'stato'];
```

## Motivazione

1. **Standardizzazione**: Laravel e PHP usano convenzioni inglesi
2. **Portabilità**: Codice utilizzabile in contesti internazionali
3. **Collaborazione**: Team multilingue possono lavorare insieme
4. **Best Practice**: Seguire le convenzioni Laravel standard
5. **Manutenibilità**: Codice più professionale e comprensibile

## Convenzioni di Naming

### Modelli
- **Singolare, PascalCase**: `TimeRecord`, `Employee`, `Contract`
- **Descrittivo**: `TimeRecord` invece di `Record`
- **Specifico**: `EmployeeContract` invece di `Contract`

### Metodi
- **camelCase**: `getFormattedTimestampAttribute()`
- **Verbi**: `isEntry()`, `hasLocation()`, `canEdit()`
- **Descrittivo**: `getFormattedTimestampAttribute()` invece di `getFormatted()`

### Proprietà
- **snake_case**: `timestamp`, `employee_id`, `created_at`
- **Descrittivo**: `timestamp` invece di `data`
- **Specifico**: `entry_timestamp` invece di `entry_time`

## Checklist Compliance

- [ ] Tutti i nomi di modelli sono in inglese
- [ ] Tutti i nomi di metodi sono in inglese
- [ ] Tutte le proprietà sono in inglese
- [ ] Tutti i commenti PHPDoc sono in inglese
- [ ] Tutti i nomi di relazioni sono in inglese
- [ ] Tutti i nomi di scope sono in inglese

## Esempi di Traduzione

| Italiano | Inglese Corretto |
|----------|------------------|
| Timbratura | TimeRecord |
| Dipendente | Employee |
| Contratto | Contract |
| Reparto | Department |
| Luogo | Location |
| Entrata | Entry |
| Uscita | Exit |
| Stato | Status |
| Tipo | Type |
| Metodo | Method |

## Penalità per Violazione

- **Errore Critico**: Violazione delle convenzioni Laravel
- **Rifiuto**: Codice non accettato se usa nomi italiani
- **Refactoring**: Obbligatorio per tutti i file con nomi italiani
- **Documentazione**: Aggiornamento regole per prevenire ricorrenza

## Collegamenti

- [Laravel Naming Conventions](https://laravel.com/docs/10.x/eloquent#model-conventions)
- [PSR-1 Basic Coding Standard](https://www.php-fig.org/psr/psr-1/)
- [PHP-FIG Standards](https://www.php-fig.org/psr/)

*Ultimo aggiornamento: 2025-01-06* 