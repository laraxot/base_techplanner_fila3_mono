# XOT Framework Documentation

## 🚨 CRITICAL RULES - READ FIRST

### 1. XotBase/LangBase Extension Rule (MANDATORY)
**NEVER extend Filament classes directly. ALWAYS extend XotBase OR LangBase abstract classes.**

⚠️ **CRITICAL**: Check if module is multilingual FIRST!

```php
// ❌ WRONG
use Filament\Resources\Pages\ListRecords;
class MyPage extends ListRecords { }

// ✅ FOR NON-MULTILINGUAL MODULES
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
class MyPage extends XotBaseListRecords { }

// ✅ FOR MULTILINGUAL MODULES (Cms, Blog, News)
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
class MyPage extends LangBaseListRecords { }
```

### 2. Method Signature Rule (CRITICAL)
**ALWAYS match parent/trait method signatures exactly - static vs non-static matters!**

### 3. Abstract Method Rule
**ALL abstract methods from parent classes and traits MUST be implemented.**

---

## Quick Start for Error Prevention

**Before ANY Filament work:**
1. **🚨 MULTILINGUAL CHECK**: Is the module multilingual? (Use LangBase* if yes, XotBase* if no)
2. Read [`claude-code-rules.md`](./claude-code-rules.md) - **MANDATORY**
3. Check [`error-prevention/`](./error-prevention/) for known error patterns  
4. Follow pre-implementation checklist
5. Test immediately after changes

## Architecture Rules

### 2. Traduzioni

- **Sempre implementare chiavi mancanti in tutte e tre le lingue** (italiano, inglese, tedesco)
- **Mai mescolare lingue diverse** in una singola traduzione
- **Usare terminologia coerente** con il resto del sistema
- **Per campi upload file**: placeholder deve indicare l'azione (es. "Carica Fattura") NON il contenuto

### 3. Struttura File e Cartelle

- **Nelle cartelle docs**: usare solo caratteri minuscoli, eccezione README.md
- **In Blade templates**: usare `@lang` invece di `@trans`

## 📚 Documentation Structure

### Essential Documentation (READ FIRST)
- [`claude-code-rules.md`](./claude-code-rules.md) - **CRITICAL**: Essential rules that must never be broken
- [`xotbase-extension-rules.md`](./xotbase-extension-rules.md) - XotBase extension patterns and mappings

### Error Prevention (CRITICAL)
- [`error-prevention/multilingual-pattern-analysis.md`](./error-prevention/multilingual-pattern-analysis.md) - **NEW**: Critical analysis of multilingual pattern errors
- [`error-prevention/multilingual-detection-commands.md`](./error-prevention/multilingual-detection-commands.md) - Commands to detect multilingual modules  
- [`error-prevention/method-signature-errors.md`](./error-prevention/method-signature-errors.md) - Method signature conflict analysis
- [`error-prevention/filament-xotbase-patterns.md`](./error-prevention/filament-xotbase-patterns.md) - Correct XotBase implementation patterns

### Legacy Documentation
- [Pattern di Estensione Filament](/docs/patterns/filament-extension.md) 
- [Actions Pattern](/docs/patterns/actions.md)
- [Queueable Actions](/docs/patterns/queueable-actions.md)
- [Regole Architetturali Filament](/docs/architecture/filament-extension-rules.md)
- [Module Namespaces](/docs/architecture/module-namespaces.md)
- [Encryption Error Fix](/docs/encryption_error_fix.md)

## Moduli

### Xot
- [Architettura Filament-Xot](/Modules/Xot/docs/filament/xot_filament_architecture.md)
- [Pattern di Estensione](/Modules/Xot/docs/filament_extension_pattern.md)

### Notify
- [Pattern di Estensione Filament](/Modules/Notify/docs/filament_extension_pattern.md)

## Temi

### One
- [Documentazione Tema One](/Themes/One/docs/README.md)

### Sixteen
- [Documentazione Tema Sixteen](/Themes/Sixteen/docs/README.md)

## 🔍 Pre-Implementation Checklist

**Before ANY Filament implementation:**

### Critical Checks
- [ ] Read [`claude-code-rules.md`](./claude-code-rules.md) 
- [ ] Verify XotBase class exists for the Filament class you need
- [ ] Check abstract methods that need implementation
- [ ] Verify method signatures match parent/trait exactly

### Implementation Checks  
- [ ] Using XotBase class instead of direct Filament class
- [ ] All abstract methods implemented
- [ ] Method signatures match (especially static vs non-static)
- [ ] No PHP fatal errors when loading page

### Quality Checks
- [ ] Page loads successfully
- [ ] Functionality works as expected  
- [ ] Caches cleared if needed
- [ ] New errors documented if encountered

## 🚨 Most Common Fatal Errors

1. **"Cannot make non static method... static"** → Method signature mismatch
2. **"Class contains N abstract method"** → Missing abstract method implementation
3. **"Method...::route does not exist"** → Incorrect route usage on Page classes

**Solution**: Check [`error-prevention/`](./error-prevention/) documentation for detailed fixes.

## Documentazione Correlata

- [Architettura Filament-Xot](/Modules/Xot/docs/filament/xot_filament_architecture.md)
- [Pattern di Estensione Xot](/Modules/Xot/docs/filament_extension_pattern.md) 