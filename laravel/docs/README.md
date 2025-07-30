# Documentazione del Progetto

## Regole Architetturali Fondamentali

### 1. Estensione Filament

**NON estendere MAI direttamente le classi Filament. Estendere SEMPRE le classi base con prefisso `XotBase` dal modulo Xot.**

Questa è una regola architetturale critica che garantisce:
- Compatibilità con aggiornamenti Filament
- Funzionalità personalizzate centralizzate
- Consistenza del codice in tutto il progetto
- Manutenibilità a lungo termine

**Esempio:**
```php
// ❌ ERRATO
class DoctorResource extends Resource { }

// ✅ CORRETTO
class DoctorResource extends XotBaseResource { }
```

### 2. Traduzioni

- **Sempre implementare chiavi mancanti in tutte e tre le lingue** (italiano, inglese, tedesco)
- **Mai mescolare lingue diverse** in una singola traduzione
- **Usare terminologia coerente** con il resto del sistema
- **Per campi upload file**: placeholder deve indicare l'azione (es. "Carica Fattura") NON il contenuto

### 3. Struttura File e Cartelle

- **Nelle cartelle docs**: usare solo caratteri minuscoli, eccezione README.md
- **In Blade templates**: usare `@lang` invece di `@trans`

## Struttura della Documentazione

### Patterns
- [Pattern di Estensione Filament](/docs/patterns/filament-extension.md)
- [Actions Pattern](/docs/patterns/actions.md)
- [Queueable Actions](/docs/patterns/queueable-actions.md)

### Architettura
- [Regole Architetturali Filament](/docs/architecture/filament-extension-rules.md)
- [Module Namespaces](/docs/architecture/module-namespaces.md)

### Errori e Fix
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

## Controlli Pre-Implementazione

Prima di implementare qualsiasi funzionalità Filament:

1. **Verificare la mappatura delle classi** nella documentazione
2. **Controllare che non esistano metodi final** da sovrascrivere
3. **Implementare traduzioni complete** in tutte le lingue
4. **Seguire i pattern architetturali** definiti

## Documentazione Correlata

- [Architettura Filament-Xot](/Modules/Xot/docs/filament/xot_filament_architecture.md)
- [Pattern di Estensione Xot](/Modules/Xot/docs/filament_extension_pattern.md) 