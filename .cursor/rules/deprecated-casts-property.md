# Regola: Proprietà $casts Deprecata - ERRORE CRITICO

## 🚨 GRAVITÀ DEL PROBLEMA

La proprietà `protected $casts = []` è **DEPRECATA** in Laravel 10+ e causa:

### ❌ Problemi Critici
1. **Deprecation Warning**: Warning di deprecazione in produzione
2. **PHPStan Error**: Errori di analisi statica
3. **Future Breaking**: Rottura in versioni future di Laravel
4. **Performance**: Overhead di reflection per determinare i cast
5. **Type Safety**: Perdita di type safety e autocompletamento

### ✅ Soluzione Obbligatoria

**SOSTITUIRE** la proprietà `$casts` con il metodo `casts()`:

```php
// ❌ ERRATO - DEPRECATO
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

// ✅ CORRETTO - MODERNO
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

## 📋 Vantaggi del Metodo casts()

### 1. **Type Safety**
- ✅ Tipizzazione esplicita del valore di ritorno
- ✅ Autocompletamento IDE migliorato
- ✅ PHPStan compliance

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

## 🔍 Pattern di Correzione

### Fase 1: Identificazione
```bash
# Cerca tutti i file con proprietà $casts deprecata
grep -r "protected \$casts" laravel/Modules/*/app/Models/ --include="*.php"
```

### Fase 2: Correzione
```php
// Prima
protected $casts = [
    'field' => 'type',
];

// Dopo
protected function casts(): array
{
    return [
        'field' => 'type',
    ];
}
```

### Fase 3: Verifica
```bash
# Esegui PHPStan per verificare la correzione
./vendor/bin/phpstan analyze --level=9
```

## 📊 Impatto del Problema

### Moduli Affetti
- ❌ **Geo**: `Address.php` (linea 119)
- ❌ **User**: Potenzialmente altri modelli
- ❌ **TechPlanner**: Potenzialmente altri modelli
- ❌ **Notify**: Potenzialmente altri modelli

### Errori PHPStan
- ❌ `Property $casts is deprecated`
- ❌ `Use casts() method instead`
- ❌ `Type safety issues`

## 🎯 Checklist Correzione

### Per Ogni Modello
- [ ] Identificare proprietà `protected $casts`
- [ ] Sostituire con metodo `protected function casts(): array`
- [ ] Aggiungere PHPDoc corretto
- [ ] Verificare tipi di ritorno
- [ ] Testare funzionalità
- [ ] Eseguire PHPStan

### Per il Progetto
- [ ] Cerca globale proprietà `$casts`
- [ ] Correggi tutti i modelli
- [ ] Aggiorna documentazione
- [ ] Test di regressione
- [ ] Verifica performance

## 🔗 Collegamenti

### Documentazione Correlata
- [Laravel Casting Documentation](https://laravel.com/docs/10.x/eloquent-mutators#attribute-casting)
- [PHPStan Laravel Rules](https://github.com/larastan/larastan)
- [Model Casting Best Practices](./model-casting-rules.md)

### File Correlati
- `laravel/Modules/Geo/app/Models/Address.php` - **DA CORREGGERE**
- Altri modelli con proprietà `$casts`

## 📝 Note Importanti

### Priorità
- 🔴 **CRITICA**: Correggere immediatamente
- 🔴 **PRODUZIONE**: Warning visibili agli utenti
- 🔴 **PERFORMANCE**: Overhead non necessario

### Timeline
- ✅ **IMMEDIATO**: Correggere tutti i modelli
- ✅ **CONTINUO**: Verificare nuovi modelli
- ✅ **PREVENTIVO**: Regole PHPStan per prevenire

## Ultimo aggiornamento
2025-01-06 - Documentazione completa del problema critico 