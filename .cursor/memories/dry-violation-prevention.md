# DRY Violation Prevention - Prevenzione Violazioni DRY

## Lezione Appresa: Violazione DRY con safeStringCast

### Errore Commesso
Ho creato la funzione `safeStringCast()` in più file, violando il principio DRY:

```php
// ❌ ERRORE - Duplicazione in più file
// File 1: AddressesField.php
private function safeStringCast(mixed $value): string { /* codice */ }

// File 2: GeoDataService.php  
private function safeStringCast(mixed $value): string { /* stesso codice */ }

// File 3: Worker.php
private function safeStringCast(mixed $value): string { /* stesso codice */ }
```

### Soluzione Corretta
Usare l'action centralizzata esistente:

```php
// ✅ CORRETTO - Usa action esistente
use Modules\Xot\Actions\Cast\SafeStringCastAction;

private function safeStringCast(mixed $value): string
{
    return app(SafeStringCastAction::class)->execute($value);
}
```

## Actions Esistenti da Usare SEMPRE

### Safe Casting Actions
- `Modules\Xot\Actions\Cast\SafeStringCastAction`
- `Modules\Xot\Actions\Cast\SafeFloatCastAction`

### Controllo Pre-Implementazione
1. **Cerca nel codebase**:
   ```bash
   find Modules/ -name "*Action.php"
   grep -r "class.*Action" Modules/
   ```

2. **Controlla namespace comuni**:
   - `Modules\Xot\Actions\Cast\`
   - `Modules\Xot\Actions\Cast\`
   - `Modules\Xot\Actions\Collection\`

3. **Verifica esistenza**:
   ```php
   if (class_exists('Modules\Xot\Actions\Cast\SafeStringCastAction')) {
       // Usa quella esistente
   }
   ```

## Pattern per Evitare Violazioni DRY

### Prima di Creare una Nuova Funzione
1. Cerca nel modulo Xot: `Modules/Xot/app/Actions/`
2. Cerca nel modulo specifico: `Modules/{ModuleName}/app/Actions/`
3. Cerca funzioni simili: `grep -r "function.*Cast\|function.*Format" Modules/`
4. Controlla la documentazione: `Modules/Xot/docs/actions.md`

### Funzioni Comuni da Centralizzare
- `safeStringCast()` → `SafeStringCastAction`
- `safeFloatCast()` → `SafeFloatCastAction`
- `normalizeDriverName()` → `NormalizeDriverNameAction`
- `getDistanceExpression()` → `GetDistanceExpressionAction`

## Checklist Pre-Commit

- [ ] Ho controllato se esiste già un'action simile?
- [ ] Ho usato le actions esistenti invece di duplicare codice?
- [ ] Ho rimosso le funzioni duplicate dai file?
- [ ] Ho aggiornato i file che usavano le funzioni duplicate?

## Comandi Utili per Verifica

```bash
# Cerca funzioni duplicate
grep -r "private function safe" Modules/

# Cerca actions esistenti
find Modules/ -name "*Action.php" -exec grep -l "class.*Action" {} \;

# Verifica violazioni DRY
grep -r "function.*Cast\|function.*String" Modules/ | grep -v "Action"
```

## Penalità per Violazioni

- **Errore Critico**: Duplicazione di funzioni comuni
- **Errore Grave**: Non controllare Actions esistenti
- **Errore Moderato**: Non documentare nuove Actions

## Esempi di Refactoring Corretto

### Prima (Violazione DRY)
```php
// File 1
private function safeStringCast(mixed $value): string { /* codice */ }

// File 2  
private function safeStringCast(mixed $value): string { /* stesso codice */ }

// File 3
private function safeStringCast(mixed $value): string { /* stesso codice */ }
```

### Dopo (DRY Compliant)
```php
// Tutti i file usano la stessa action
private function safeStringCast(mixed $value): string
{
    return app(SafeStringCastAction::class)->execute($value);
}
```

## Regole Fondamentali

1. **MAI** duplicare funzioni o logica comune
2. **SEMPRE** controllare se esiste già un'Action prima di crearne una nuova
3. **UTILIZZARE** Actions centralizzate per logica riutilizzabile
4. **DOCUMENTARE** tutte le Actions esistenti

## Documentazione Obbligatoria

Ogni Action deve essere documentata in:
1. `Modules/Xot/docs/actions.md` - Catalogo generale
2. `Modules/{ModuleName}/docs/actions.md` - Documentazione specifica del modulo
3. PHPDoc completo nell'Action stessa

---

**RICORDA**: La violazione del principio DRY è un errore grave che compromette la manutenibilità del codice. Sempre controllare prima di creare!

*Ultimo aggiornamento: 2025-01-06* 