# DRY Actions Rules - Regole per Actions Centralizzate

## Principio Fondamentale: DRY (Don't Repeat Yourself)

**IMPORTANTE**: Prima di creare una nuova action, controlla SEMPRE se esiste già nel codebase!

### 1. Actions Esistenti da Usare

#### Safe Casting Actions
- `Modules\Xot\Actions\String\SafeStringCastAction` - Per conversione sicura a string
- `Modules\Xot\Actions\Cast\SafeFloatCastAction` - Per conversione sicura a float

#### String Processing Actions
- `Modules\Xot\Actions\String\NormalizeDriverNameAction` - Per normalizzare nomi di driver

#### Geo Actions
- `Modules\Xot\Actions\Geo\GetDistanceExpressionAction` - Per calcolo espressioni SQL distanza

#### Come Usare le Actions Esistenti

```php
// ❌ SBAGLIATO - Duplicazione di codice
private function safeStringCast(mixed $value): string
{
    if (is_string($value)) {
        return $value;
    }
    if (is_null($value)) {
        return '';
    }
    // ... altro codice duplicato
}

// ✅ CORRETTO - Usa l'action esistente
private function safeStringCast(mixed $value): string
{
    return app(SafeStringCastAction::class)->execute($value);
}
```

### 2. Controllo Pre-Creazione

Prima di creare una nuova action:

1. **Cerca nel codebase**:
   ```bash
   grep -r "class.*Action" Modules/
   find Modules/ -name "*Action.php"
   ```

2. **Controlla namespace comuni**:
   - `Modules\Xot\Actions\Cast\`
   - `Modules\Xot\Actions\Cast\`
   - `Modules\Xot\Actions\Collection\`

3. **Verifica se esiste già**:
   ```php
   // Controlla se esiste
   if (class_exists('Modules\Xot\Actions\Cast\SafeStringCastAction')) {
       // Usa quella esistente
   }
   ```

### 3. Pattern per Actions Centralizzate

```php
<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

use Spatie\QueueableAction\QueueableAction;

class SafeStringCastAction
{
    use QueueableAction;

    public function execute(mixed $value): string
    {
        // Logica centralizzata
    }
}
```

### 4. Violazioni DRY Comuni da Evitare

#### ❌ Funzioni Duplicate
- `safeStringCast()` in più file
- `safeFloatCast()` in più file
- `normalizeDriverName()` in più factory
- `getDistanceExpression()` in più trait

#### ✅ Soluzioni Centralizzate
- Usa `SafeStringCastAction`
- Usa `SafeFloatCastAction`
- Usa `NormalizeDriverNameAction`
- Usa `GetDistanceExpressionAction`

### 5. Checklist Pre-Commit

- [ ] Ho controllato se esiste già un'action simile?
- [ ] Ho usato le actions esistenti invece di duplicare codice?
- [ ] Ho rimosso le funzioni duplicate dai file?
- [ ] Ho aggiornato i file che usavano le funzioni duplicate?

### 6. Comandi Utili

```bash
# Cerca funzioni duplicate
grep -r "private function safe" Modules/

# Cerca actions esistenti
find Modules/ -name "*Action.php" -exec grep -l "class.*Action" {} \;

# Verifica violazioni DRY
grep -r "function.*Cast\|function.*String" Modules/ | grep -v "Action"
```

### 7. Esempi di Refactoring

#### Prima (Violazione DRY)
```php
// File 1
private function safeStringCast(mixed $value): string { /* codice */ }

// File 2  
private function safeStringCast(mixed $value): string { /* stesso codice */ }

// File 3
private function safeStringCast(mixed $value): string { /* stesso codice */ }
```

#### Dopo (DRY Compliant)
```php
// Tutti i file usano la stessa action
private function safeStringCast(mixed $value): string
{
    return app(SafeStringCastAction::class)->execute($value);
}
```

### 8. Regole di Naming

- Actions: `VerbNounAction` (es. `SafeStringCastAction`)
- Namespace: `Modules\Xot\Actions\Category\`
- File: `VerbNounAction.php`

### 9. Documentazione

Ogni action deve avere:
- PHPDoc completo
- Esempi di utilizzo
- Test unitari
- Documentazione nel README del modulo

---

**RICORDA**: La violazione del principio DRY è un errore grave che compromette la manutenibilità del codice. Sempre controllare prima di creare! 