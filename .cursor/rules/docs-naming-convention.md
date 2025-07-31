# Regola: Convenzione Naming Cartelle Docs

## Principio Fondamentale
- **TUTTI** i file e le sottocartelle nelle directory `docs/` DEVONO usare **SOLO** caratteri minuscoli
- **UNICA ECCEZIONE**: `README.md` può contenere maiuscole
- **MAI** usare caratteri maiuscoli in nomi di file o cartelle docs

## Pattern Corretto

### ✅ DO - Naming Corretto
```
docs/
├── readme.md                    # ✅ Minuscolo
├── coding-standards.md          # ✅ Minuscolo con trattini
├── api-documentation.md         # ✅ Minuscolo con trattini
├── setup-instructions.md        # ✅ Minuscolo con trattini
├── troubleshooting.md           # ✅ Minuscolo
├── best-practices.md            # ✅ Minuscolo con trattini
├── modules/
│   ├── user-module.md          # ✅ Minuscolo con trattini
│   ├── auth-system.md          # ✅ Minuscolo con trattini
│   └── api-endpoints.md        # ✅ Minuscolo con trattini
└── README.md                   # ✅ UNICA ECCEZIONE - può avere maiuscole
```

### ❌ DON'T - Naming Errato
```
docs/
├── README.md                   # ✅ Corretto (eccezione)
├── CodingStandards.md          # ❌ ERRATO - maiuscole
├── API_Documentation.md        # ❌ ERRATO - maiuscole e underscore
├── Setup-Instructions.md       # ❌ ERRATO - maiuscole
├── Troubleshooting.md          # ❌ ERRATO - maiuscole
├── Best_Practices.md           # ❌ ERRATO - maiuscole e underscore
├── Modules/
│   ├── UserModule.md           # ❌ ERRATO - maiuscole
│   ├── AuthSystem.md           # ❌ ERRATO - maiuscole
│   └── APIEndpoints.md         # ❌ ERRATO - maiuscole
```

## Applicazione

### Cartelle da Controllare
- `docs/` (root)
- `Modules/*/docs/` (tutti i moduli)
- `Themes/*/docs/` (tutti i temi)

### Controlli Obbligatori
1. **Nomi file**: Solo minuscoli e trattini
2. **Nomi cartelle**: Solo minuscoli e trattini
3. **Estensioni**: `.md` per documentazione
4. **README.md**: Unica eccezione per maiuscole

## Motivazione
- **Coerenza**: Uniformità in tutto il progetto
- **Portabilità**: Compatibilità cross-platform
- **Manutenibilità**: Naming prevedibile e standardizzato
- **SEO**: URL più puliti e leggibili

## Checklist Pre-Creazione
- [ ] Nome file in minuscolo
- [ ] Usare trattini invece di underscore
- [ ] Evitare caratteri speciali
- [ ] Verificare che non esista già un file simile
- [ ] Aggiornare la documentazione correlata

## Esempi di Conversione

### Da Errato a Corretto
```
❌ CodingStandards.md → ✅ coding-standards.md
❌ API_Documentation.md → ✅ api-documentation.md
❌ UserModule.md → ✅ user-module.md
❌ Best_Practices.md → ✅ best-practices.md
❌ SetupInstructions.md → ✅ setup-instructions.md
```

## Controllo Automatico
Prima di creare qualsiasi file docs, verificare:
1. Nome in minuscolo
2. Trattini invece di underscore
3. Nessuna maiuscola (eccetto README.md)
4. Estensione .md corretta 