# Memoria: Convenzione di Naming per File di Documentazione

## Regola Critica da Ricordare Sempre

**TUTTI i file e le sottocartelle nelle directory `docs/` DEVONO usare SOLO caratteri minuscoli, con l'unica eccezione di `README.md`.**

## Esempi di Applicazione

### ✅ CORRETTO
- `filament-method-naming-fix.md`
- `dry-violations-fixed.md`
- `phpstan-fixes-progress.md`
- `best-practices/implementation-guide.md`

### ❌ ERRATO
- `Filament-Method-Naming-Fix.md`
- `DRY-Violations-Fixed.md`
- `PHPStan-Fixes-Progress.md`
- `Best-Practices/Implementation-Guide.md`

## Controllo Automatico

Prima di creare o rinominare qualsiasi file di documentazione, verificare SEMPRE:
1. Il nome del file è tutto in minuscolo
2. Il nome della cartella è tutto in minuscolo
3. Non ci sono caratteri maiuscoli eccetto in `README.md`

## Applicazione Immediata

Questa regola deve essere applicata automaticamente quando:
- Si creano nuovi file di documentazione
- Si rinominano file esistenti
- Si organizzano cartelle di documentazione
- Si aggiornano riferimenti nei link

## Motivazione

- **Coerenza**: Struttura uniforme in tutto il progetto
- **Navigabilità**: Facilitare ricerca e organizzazione
- **Compatibilità**: Evitare problemi di case-sensitivity
- **Manutenibilità**: Standardizzare convenzioni

**IMPORTANTE**: Questa regola è CRITICA e deve essere sempre rispettata! 