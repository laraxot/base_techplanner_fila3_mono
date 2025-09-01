# Testing – Pest Only + No RefreshDatabase (Laraxot)

## Regola Assoluta
- Usare SEMPRE Pest per i test (syntax funzionale: `describe`, `it`, `test`).
- NON usare MAI `RefreshDatabase`.
- Usare `.env.testing` (SQLite in memoria o DB dedicato) per isolamento e performance.

## Motivazioni
- Pest rende i test più espressivi, veloci da scrivere e manutenere.
- `RefreshDatabase` è lento (migrazioni ad ogni test) e non necessario con un ambiente testing dedicato.
- `.env.testing` + SQLite `:memory:` ⇒ feedback rapido, CI più veloce, nessun conflitto con dati reali.

## Pattern Corretto (Pest)
```php
<?php

declare(strict_types=1);

use Modules\Employee\Models\WorkHour;

it('stores a clock in', function (): void {
    $user = user();
    actingAs($user);

    WorkHour::create([...]);

    expect(WorkHour::count())->toBe(1);
});
```

## Pattern Vietato
```php
<?php

use Illuminate\Foundation\Testing\RefreshDatabase; // ❌ VIETATO

class WorkHourTest extends TestCase // ❌ PHPUnit style
{
    use RefreshDatabase; // ❌ VIETATO
}
```

## Configurazione Obbligatoria
- `.env.testing` (esempio):
```env
APP_ENV=testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
```

## Check automatici (locale)
- Script: `bashscripts/check_pest_only.sh` segnala:
  - file test in stile PHPUnit (`class .*Test extends`)
  - uso di `RefreshDatabase`

## Applicazione
- Nuovi test: solo Pest.
- Test legacy: pianificare migrazione a Pest; bloccare nuove aggiunte non conformi.

Ultimo aggiornamento: 2025-09-01
