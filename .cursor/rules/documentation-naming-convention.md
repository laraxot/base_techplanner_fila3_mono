# Regola: Convenzione di Naming per File di Documentazione

## Regola Fondamentale
Tutti i file e le sottocartelle nelle directory `docs/` DEVONO usare **solo caratteri minuscoli**, con l'unica eccezione di `README.md`.

## Motivazione
- **Coerenza**: Mantenere una struttura uniforme in tutto il progetto
- **Navigabilità**: Facilitare la ricerca e l'organizzazione dei file
- **Compatibilità**: Evitare problemi di case-sensitivity su diversi sistemi
- **Manutenibilità**: Standardizzare la convenzione di naming

## Esempi

### ✅ CORRETTO
```
docs/
├── filament-method-naming-fix.md
├── dry-violations-fixed.md
├── phpstan-fixes-progress.md
├── README.md (unica eccezione)
└── subfolder/
    ├── best-practices.md
    └── implementation-guide.md
```

### ❌ ERRATO
```
docs/
├── Filament-Method-Naming-Fix.md
├── DRY-Violations-Fixed.md
├── PHPStan-Fixes-Progress.md
├── SubFolder/
│   ├── Best-Practices.md
│   └── Implementation-Guide.md
└── README.md
```

## Applicazione
- **File**: Tutti i file `.md` devono essere in minuscolo
- **Cartelle**: Tutte le sottocartelle devono essere in minuscolo
- **Separatori**: Usare trattini (`-`) invece di underscore (`_`) o spazi
- **Eccezione**: Solo `README.md` può contenere maiuscole

## Controllo Automatico
Prima di creare qualsiasi file di documentazione, verificare sempre:
1. Il nome del file è tutto in minuscolo
2. Il nome della cartella è tutto in minuscolo
3. Non ci sono caratteri maiuscoli eccetto in `README.md`

## Aggiornamento Memorie
Questa regola deve essere sempre ricordata e applicata automaticamente quando si creano o rinominano file di documentazione. 