<<<<<<< HEAD
# PHP Strict Types in Laravel Modules

## Overview
This document provides guidelines for using strict typing in PHP within a Laravel module, ensuring type safety and reducing runtime errors.

## Key Principles
1. **Type Safety**: Strict typing enforces type checks at runtime, preventing unexpected type coercion.
2. **Code Reliability**: Explicit type declarations improve code reliability and readability.

## Implementation Guidelines
### 1. Declare Strict Types
- Always declare strict types at the top of every PHP file to enable strict type checking.
  ```php
  declare(strict_types=1);
  ```

### 2. Function and Method Signatures
- Use type hints for parameters and return types in all function and method declarations.
  ```php
  public function processData(string $input, int $count): array
  {
      // Process data
      return [];
  }
  ```

### 3. Nullable Types
- Use nullable types when a parameter or return value can be null.
  ```php
  public function findItem(?int $id): ?Item
  {
      // Find item or return null
      return null;
  }
  ```

## Common Issues and Fixes
- **Missing Strict Declaration**: Ensure `declare(strict_types=1);` is at the top of every PHP file to avoid loose typing.
- **Type Mismatch Errors**: Correct type mismatches by updating type hints or handling nullable cases appropriately.

## Testing and Verification
- Use static analysis tools like PHPStan to verify strict type adherence across the codebase.
- Test edge cases with different data types to ensure strict typing behaves as expected.

## Documentation and Updates
- Document any exceptions to strict typing rules in the relevant module's documentation folder.
- Update this document if new strict typing features or practices are introduced in PHP.

## Links to Related Documentation
- [Code Quality](./CODE_QUALITY.md)
- [PHPStan Implementation Guide](./PHPSTAN-IMPLEMENTATION-GUIDE.md)
- [Naming Conventions](./NAMING-CONVENTIONS.md)
- [Service Provider Best Practices](./SERVICE-PROVIDER-BEST-PRACTICES.md)
- [Filament Best Practices](./FILAMENT-BEST-PRACTICES.md)
=======
# PHP Strict Types Convention

## Regola Generale

Tutti i file PHP del progetto che contengono logica di business DEVONO iniziare con la dichiarazione `declare(strict_types=1);` subito dopo il tag di apertura PHP.

### File che Richiedono strict_types
- Controllers
- Models
- Actions
- Services
- Traits
- Interfaces
- Tests
- Helpers

### File che NON Richiedono strict_types
- File di vista Blade (.blade.php)
- File di configurazione (config/*.php)
- File di routing (routes/*.php)
- File di traduzione (lang/*.php)

## Formato Corretto

```php
<?php

declare(strict_types=1);

namespace Example;
// ... resto del codice
```

## Motivazione

L'uso di `declare(strict_types=1);` offre diversi vantaggi:

1. **Type Safety**: Forza il type checking rigoroso per:
   - Parametri delle funzioni
   - Valori di ritorno delle funzioni
   - Assegnazioni di proprietà tipizzate

2. **Prevenzione Errori**: Aiuta a catturare errori di tipo in fase di sviluppo invece che in runtime

3. **Codice Più Pulito**: Rende esplicite le intenzioni riguardo ai tipi di dati attesi

4. **Migliore Integrazione con Tools**: Facilita l'analisi statica del codice con strumenti come PHPStan

## Implementazione

- Tutti i nuovi file PHP devono includere questa dichiarazione
- I file esistenti devono essere aggiornati per includere questa dichiarazione quando vengono modificati
- La dichiarazione deve essere posizionata immediatamente dopo il tag di apertura PHP e prima di qualsiasi altro codice

## Verifica

È possibile verificare la presenza di questa dichiarazione usando il seguente comando grep:

```bash
find Modules -name "*.php" -type f -exec grep -L "declare(strict_types=1)" {} \;
```

Questo comando mostrerà tutti i file PHP che non hanno la dichiarazione `strict_types`.
>>>>>>> 9d6070e (.)
