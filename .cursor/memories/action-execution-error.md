# Memoria: Errore Pattern Action Execution (2025-01-06)

## Errore Critico Commesso
Ho usato **metodo statico** invece del pattern corretto per le Actions:

```php
// ❌ ERRATO - Ho fatto questo errore
\Modules\Xot\Actions\Cast\SafeStringCastAction::cast($item)

// ✅ CORRETTO - Pattern giusto
app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($item)
```

## Motivazione dell'Errore
1. **Confusione con Helper Classes**: Ho trattato l'Action come una classe statica
2. **Non ho seguito Spatie QueueableAction**: Le Actions devono essere istanziate tramite container
3. **Violazione convenzioni Laraxot**: Ogni Action deve essere eseguita tramite `execute()`

## Pattern Corretto OBBLIGATORIO

### Struttura Action
```php
class SafeStringCastAction
{
    use QueueableAction; // OBBLIGATORIO

    public function execute(mixed $value): string // OBBLIGATORIO
    {
        // Logica qui
    }
}
```

### Utilizzo Corretto
```php
// Pattern corretto SEMPRE
$result = app(SafeStringCastAction::class)->execute($value);

// Con dependency injection
public function process(SafeStringCastAction $action)
{
    $result = $action->execute($value);
}
```

## Checklist Pre-Implementazione OBBLIGATORIA

PRIMA di usare qualsiasi Action, verificare SEMPRE:

- [ ] L'Action usa `use QueueableAction`
- [ ] L'Action ha metodo `execute()` (non statico)
- [ ] Uso `app(ActionClass::class)->execute()`
- [ ] NON uso `ActionClass::metodo()` (statico)
- [ ] NON uso `new ActionClass()` (diretta)

## Errori da MAI Commettere

1. **❌ MAI**: `ActionClass::metodo()` (statico)
2. **❌ MAI**: `new ActionClass()` (diretta)
3. **❌ MAI**: `ActionClass::execute()` (statico)
4. **❌ MAI**: Metodi statici nelle Actions

## Validazione Automatica

Prima di ogni commit, eseguire:
```bash
# Cerca usi errati di metodi statici
grep -r "Action::" Modules/ --include="*.php" | grep -v "use\|namespace"

# Cerca chiamate dirette
grep -r "new.*Action" Modules/ --include="*.php"
```

## Riferimenti Critici
- Regola: `.cursor/rules/action-execution-pattern.md`
- Pattern: Spatie QueueableAction
- Convenzione: Laraxot Actions Pattern

**RICORDA SEMPRE**: Actions = Container + execute(), MAI statici! 