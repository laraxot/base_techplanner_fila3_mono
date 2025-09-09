# Principi di Ereditarietà nelle Classi SaluteOra

## Regola Fondamentale: No Duplicate Declarations

Le classi che estendono altre classi  **NON devono ridichiarare** interfacce, trait o metodi già presenti nella classe genitore, a meno che non ne modifichino il comportamento.

## Esempi Corretti vs Errati

### ❌ Errato: Duplicazione di Interfacce/Trait

```php
// Classe base
abstract class XotBasePage extends Page implements HasForms
{
    use InteractsWithForms;
    // ...
}

// Classe figlia - ERRATO
class SendSmsPage extends XotBasePage implements HasForms // ⚠️ Duplicato!
{
    use InteractsWithForms; // ⚠️ Duplicato!
    // ...
}
```

### ✅ Corretto: Nessuna Duplicazione

```php
// Classe base
abstract class XotBasePage extends Page implements HasForms
{
    use InteractsWithForms;
    // ...
}

// Classe figlia - CORRETTO
class SendSmsPage extends XotBasePage
{
    // Non ridichiarare interfacce o trait già definiti nella classe base
    // ...
}
```

## Motivazioni

1. **Principio DRY (Don't Repeat Yourself)**:
   - Evita duplicazione del codice
   - Riduce il rischio di incoerenze quando la classe base cambia
   - Migliora la leggibilità
   - Facilita la manutenzione

2. **Chiarezza Contrattuale**:
   - Le implementazioni delle interfacce/trait sono gestite dalla classe base
   - Evita confusione sul "contratto" che la classe deve rispettare
   - Rende più chiara la gerarchia delle classi

3. **Ottimizzazione**:
   - Evita overhead di dichiarazioni ridondanti
   - Riduce la dimensione del codice
   - Semplifica l'analisi statica

## Eccezioni

L'unico caso in cui è accettabile ridichiarare un'interfaccia è quando:

1. Si sovrascrive il comportamento dell'interfaccia in modo significativo, modificando i metodi ereditati
2. È necessario esplicitare che la classe implementa un'interfaccia specifica per motivi di documentazione

## Verifica del Codice

Per identificare dichiarazioni duplicate, usare:

```bash

# Trova classi che estendono XotBasePage e implementano HasForms
grep -r --include="*.php" "extends XotBasePage implements HasForms" /var/www/html/_bases/base_techplanner_fila3_mono/laravel/Modules/
```

## Riferimenti

- [PSR-1: Basic Coding Standard](https://www.php-fig.org/psr/psr-1/)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [DRY Principle](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself)
- [PHP OOP Best Practices](https://phptherightway.com/#object-oriented-programming)
