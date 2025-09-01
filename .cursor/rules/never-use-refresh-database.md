# REGOLA CRITICA: MAI USARE RefreshDatabase nei Test Laraxot

## REGOLA ASSOLUTA
**MAI USARE `RefreshDatabase` nei test. SEMPRE usare `.env.testing` con database dedicato.**

## Motivazioni Tecniche

### 1. Performance Critica
- RefreshDatabase ricrea l'intero schema ad ogni test
- Laraxot ha 10+ moduli con centinaia di migrazioni
- Tempo di esecuzione: da secondi a minuti per ogni test

### 2. Architettura Modulare Laraxot
- Moduli interdipendenti con relazioni complesse
- XotBaseMigration ha logica di controllo esistenza (hasTable, hasColumn)
- RefreshDatabase bypassa questa logica causando inconsistenze

### 3. Complessità delle Migrazioni
- Migrazioni con logica condizionale complessa
- Foreign keys cross-module
- Seeding e dati di base necessari

### 4. Stabilità dei Test
- RefreshDatabase può causare race conditions
- Problemi con foreign key constraints
- Inconsistenze tra test environment e production

## Soluzione: .env.testing

### Configurazione Corretta
```env
# .env.testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
# oppure
DB_DATABASE=/tmp/laraxot_test.sqlite
```

### Pattern di Test Corretto
```php
<?php

declare(strict_types=1);

namespace Modules\ModuleName\Tests\Feature;

use Modules\ModuleName\Tests\TestCase;
// MAI: use Illuminate\Foundation\Testing\RefreshDatabase;

class MyTest extends TestCase
{
    // ❌ MAI: use RefreshDatabase;
    
    /** @test */
    public function it_works(): void
    {
        // Test logic senza RefreshDatabase
        // Database viene gestito da .env.testing
    }
}
```

## Anti-Pattern da Evitare

### ❌ VIETATO
```php
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyTest extends TestCase
{
    use RefreshDatabase; // ❌ MAI FARE QUESTO
}
```

### ✅ CORRETTO
```php
// Nessun trait di database
// Database gestito da .env.testing
class MyTest extends TestCase
{
    // Test senza RefreshDatabase
}
```

## Impatto sui Test Esistenti

### File da Correggere: 91 file trovati
- Activity: 3 file
- Cms: 3 file  
- Employee: 8 file
- TechPlanner: 25+ file
- Notify: 12 file
- Job: 5 file
- Altri moduli: 35+ file

### Strategia di Correzione
1. Rimuovere `use RefreshDatabase;` da tutti i test
2. Rimuovere `use Illuminate\Foundation\Testing\RefreshDatabase;`
3. Configurare correttamente `.env.testing`
4. Testare che i test funzionino senza RefreshDatabase

## Prevenzione Futura

### Checklist Obbligatoria per Nuovi Test
- [ ] NON usa RefreshDatabase
- [ ] Usa .env.testing per database
- [ ] Estende TestCase del modulo
- [ ] Non importa RefreshDatabase

### Template Test Corretto
```php
<?php

declare(strict_types=1);

namespace Modules\{ModuleName}\Tests\{Feature|Unit};

use Modules\{ModuleName}\Tests\TestCase;

class {TestName} extends TestCase
{
    /** @test */
    public function it_does_something(): void
    {
        // Arrange
        
        // Act
        
        // Assert
    }
}
```

## Eccezioni
**NON CI SONO ECCEZIONI A QUESTA REGOLA.**

Ogni test deve funzionare con database dedicato configurato in .env.testing.

## Controlli Automatici

### Comando per Verificare Violazioni
```bash
grep -r "RefreshDatabase" laravel/Modules/*/tests/
```

### Script di Correzione Automatica
```bash
find laravel/Modules -name "*.php" -path "*/tests/*" -exec sed -i '/RefreshDatabase/d' {} \;
```

## Documentazione Correlata
- [Testing Strategy](../docs/testing-strategy.md)
- [Database Configuration](../docs/database-testing.md)
- [Laraxot Testing Philosophy](../docs/laraxot-testing.md)

---

**QUESTA REGOLA È ASSOLUTA E NON NEGOZIABILE**

*Ultimo aggiornamento: Settembre 2025*
