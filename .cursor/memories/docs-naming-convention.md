# Memoria: Convenzione Naming Docs (2025-01-06)

## Regola Critica da Rispettare SEMPRE
**TUTTI** i file e le sottocartelle nelle directory `docs/` DEVONO usare **SOLO** caratteri minuscoli, con l'unica eccezione di `README.md`.

## Errori Comuni da Evitare
- ❌ `CodingStandards.md` → ✅ `coding-standards.md`
- ❌ `API_Documentation.md` → ✅ `api-documentation.md`
- ❌ `UserModule.md` → ✅ `user-module.md`
- ❌ `Best_Practices.md` → ✅ `best-practices.md`
- ❌ `SetupInstructions.md` → ✅ `setup-instructions.md`

## Cartelle da Controllare
- `docs/` (root)
- `Modules/*/docs/` (tutti i moduli)
- `Themes/*/docs/` (tutti i temi)

## Pattern Corretto
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

## Controllo Automatico
Prima di creare qualsiasi file docs, verificare:
1. Nome in minuscolo
2. Trattini invece di underscore
3. Nessuna maiuscola (eccetto README.md)
4. Estensione .md corretta

## Ultimo aggiornamento
2025-01-06 