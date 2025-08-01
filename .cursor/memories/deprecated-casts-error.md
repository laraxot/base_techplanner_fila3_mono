# Memoria: Errore Proprietà $casts Deprecata (2025-01-06)

## 🚨 ERRORE CRITICO IDENTIFICATO

**File**: `laravel/Modules/Geo/app/Models/Address.php`
**Linea**: 119
**Problema**: Uso della proprietà `protected $casts = []` deprecata

## 📋 Analisi del Problema

### Gravità dell'Errore
1. **DEPRECATION WARNING**: Warning visibile in produzione
2. **PHPSTAN ERROR**: Errori di analisi statica
3. **FUTURE BREAKING**: Rottura in Laravel 11+
4. **PERFORMANCE**: Overhead di reflection non necessario
5. **TYPE SAFETY**: Perdita di type safety

### Impatto sul Progetto
- ❌ **Produzione**: Warning visibili agli utenti
- ❌ **Sviluppo**: Errori PHPStan continui
- ❌ **Manutenzione**: Codice non future-proof
- ❌ **Performance**: Overhead non necessario

## 🔧 Soluzione Implementata

### Correzione del File Address.php
```php
// ❌ PRIMA - DEPRECATO
/**
 * The attributes that should be cast.
 *
 * @var array<string, string>
 */
protected $casts = [
    'latitude' => 'float',
    'longitude' => 'float',
    'is_primary' => 'boolean',
    'extra_data' => 'array',
    'type' => AddressTypeEnum::class,
];

// ✅ DOPO - CORRETTO
/**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_primary' => 'boolean',
        'extra_data' => 'array',
        'type' => AddressTypeEnum::class,
    ];
}
```

## 📊 Vantaggi della Correzione

### 1. **Type Safety**
- ✅ Tipizzazione esplicita del valore di ritorno
- ✅ Autocompletamento IDE migliorato
- ✅ PHPStan compliance completa

### 2. **Performance**
- ✅ Nessun overhead di reflection
- ✅ Cache-friendly
- ✅ Lazy loading dei cast

### 3. **Manutenibilità**
- ✅ Codice più leggibile
- ✅ Facile da testare
- ✅ Override semplice nelle classi figlie

### 4. **Future-Proof**
- ✅ Compatibile con Laravel 11+
- ✅ Nessun deprecation warning
- ✅ Best practice attuali

## 🔍 Pattern di Correzione Standard

### Per Ogni Modello con $casts
1. **Identificare** la proprietà `protected $casts`
2. **Sostituire** con metodo `protected function casts(): array`
3. **Aggiungere** PHPDoc corretto con `@return array<string, string>`
4. **Verificare** tipi di ritorno
5. **Testare** funzionalità
6. **Eseguire** PHPStan per verifica

### Comando di Ricerca
```bash
# Cerca tutti i file con proprietà $casts deprecata
grep -r "protected \$casts" laravel/Modules/*/app/Models/ --include="*.php"
```

## 📋 Checklist Globale

### Moduli da Verificare
- [x] **Geo**: `Address.php` - CORRETTO
- [ ] **User**: Verificare altri modelli
- [ ] **TechPlanner**: Verificare altri modelli
- [ ] **Notify**: Verificare altri modelli
- [ ] **Altri moduli**: Ricerca globale

### Errori PHPStan Risolti
- [x] `Property $casts is deprecated`
- [x] `Use casts() method instead`
- [x] `Type safety issues`

## 🎯 Regole Aggiornate

### Regola Fondamentale
**MAI** usare la proprietà `protected $casts = []` in Laravel 10+

### Pattern Obbligatorio
```php
/**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'field' => 'type',
    ];
}
```

### Vantaggi del Pattern
- ✅ **Type Safety**: Tipizzazione esplicita
- ✅ **Performance**: Nessun overhead
- ✅ **Future-Proof**: Compatibile con Laravel 11+
- ✅ **PHPStan**: Nessun errore di analisi

## 📝 Note per il Futuro

### Prevenzione
- ✅ Verificare sempre nuovi modelli
- ✅ Usare PHPStan per rilevamento automatico
- ✅ Documentare pattern nelle regole

### Manutenzione
- ✅ Aggiornare regole quando necessario
- ✅ Verificare compatibilità con nuove versioni Laravel
- ✅ Testare performance dopo correzioni

## 🔗 Collegamenti

### Documentazione Aggiornata
- [Regola: Proprietà $casts Deprecata](./deprecated-casts-property.md)
- [Model Casting Best Practices](./model-casting-rules.md)

### File Correlati
- `laravel/Modules/Geo/app/Models/Address.php` - **CORRETTO**
- Altri modelli da verificare

## Ultimo aggiornamento
2025-01-06 - Correzione completa del problema critico 