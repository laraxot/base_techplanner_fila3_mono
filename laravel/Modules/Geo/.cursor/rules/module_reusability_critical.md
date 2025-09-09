# REGOLA CRITICA: Moduli Riutilizzabili Project-Agnostic

## Principio Assoluto
I moduli riutilizzabili (Notify, User, Xot, UI, Cms, Blog, Geo) NON devono MAI contenere riferimenti hardcoded a nomi di progetti specifici.

## Violazioni Gravi
❌ **VIETATO ASSOLUTO:**
```php
// Nomi progetti hardcoded
'content' => 'Benvenuto su SaluteOra!',
'created_by' => 'admin@saluteora.com',
use Modules\SaluteOra\Models\User;
'database' => 'saluteora_test',
```

## Pattern Obbligatori
✅ **SEMPRE utilizzare:**
```php
// Pattern dinamici
'content' => 'Benvenuto su ' . config('app.name') . '!',
'created_by' => 'admin@' . config('app.domain', 'example.com'),
$userClass = XotData::make()->getUserClass();
$testDb = config('database.default') . '_test',
```

## Metodi XotData Richiesti
```php
use Modules\Xot\Datas\XotData;

// Classe User dinamica
$userClass = XotData::make()->getUserClass();
$user = $userClass::factory()->create();

// Namespace progetto
$namespace = XotData::make()->getProjectNamespace();

// Nome modulo principale  
$mainModule = XotData::make()->main_module;
```

## Controlli Automatici
```bash
# Verifica hardcoding nei moduli riutilizzabili
./bashscripts/check_module_reusability.sh
```

## Enforcement
- PHPStan custom rules per rilevare hardcoding
- CI/CD checks prima di ogni merge
- Review obbligatoria per modifiche ai moduli riutilizzabili

*Ultimo aggiornamento: gennaio 2025*
