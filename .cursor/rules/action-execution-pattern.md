# Regola: Pattern di Esecuzione Actions

## Principio Fondamentale
- **MAI** usare metodi statici nelle Actions
- **SEMPRE** usare il pattern `app(ActionClass::class)->execute()`
- **MAI** chiamare direttamente metodi delle Actions
- **SEMPRE** rispettare il pattern Spatie QueueableAction

## Pattern Corretto

### ✅ DO - Esecuzione Corretta
```php
// Pattern corretto per Actions
$result = app(SafeStringCastAction::class)->execute($value);

// Con dependency injection
$action = app(SafeStringCastAction::class);
$result = $action->execute($value);

// In controller con DI
public function process(Request $request, SafeStringCastAction $action)
{
    $result = $action->execute($request->input('value'));
}
```

### ❌ DON'T - Pattern Errato
```php
// ❌ MAI fare questo - chiamata statica
$result = SafeStringCastAction::cast($value);

// ❌ MAI fare questo - chiamata diretta
$action = new SafeStringCastAction();
$result = $action->cast($value);

// ❌ MAI fare questo - metodo statico
$result = SafeStringCastAction::execute($value);
```

## Struttura Action Corretta

```php
<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

use Spatie\QueueableAction\QueueableAction;

class SafeStringCastAction
{
    use QueueableAction;

    /**
     * Esegue la conversione sicura a string.
     *
     * @param mixed $value Il valore da convertire
     * @return string Il valore convertito
     */
    public function execute(mixed $value): string
    {
        // Logica di conversione
        return (string) $value;
    }
}
```

## Checklist Pre-Implementazione

Prima di usare un'Action, verificare:

- [ ] L'Action estende/usa Spatie QueueableAction
- [ ] L'Action ha il metodo `execute()`
- [ ] Non ci sono metodi statici pubblici
- [ ] Uso `app(ActionClass::class)->execute()`
- [ ] Non chiamo direttamente altri metodi

## Errori Comuni da Evitare

1. **Confusione con Helper Classes**: Le Actions non sono helper statici
2. **Chiamata diretta**: Non istanziare Actions con `new`
3. **Metodi statici**: Non creare metodi statici nelle Actions
4. **Bypass del container**: Non bypassare il container Laravel

## Validazione Pattern

```bash
# Cerca usi errati di metodi statici nelle Actions
grep -r "Action::" Modules/ --include="*.php" | grep -v "use\|namespace"

# Cerca chiamate dirette senza app()
grep -r "new.*Action" Modules/ --include="*.php"
```

## Documentazione Obbligatoria

Ogni Action deve essere documentata con:
1. Esempio di utilizzo corretto
2. Pattern di esecuzione
3. Dipendenze richieste
4. Tipi di parametri e ritorno

## Backlink e Riferimenti

- [Modules/Xot/docs/actions-pattern.md](mdc:../../laravel/Modules/Xot/docs/actions-pattern.md)
- [docs/SPATIE_ACTIONS_PATTERN.md](mdc:../../docs/SPATIE_ACTIONS_PATTERN.md)
- [.cursor/rules/DRY-actions-rules.md](mdc:../../.cursor/rules/DRY-actions-rules.md)

*Ultimo aggiornamento: 2025-01-06* 