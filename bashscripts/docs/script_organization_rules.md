# Regole Organizzazione Script

## Regola Fondamentale

**TUTTI GLI SCRIPT DEVONO ESSERE POSIZIONATI IN `bashscripts/`**

### Struttura Corretta
```
bashscripts/
├── utils/                    # Script di utilità generali
├── git/                      # Script per gestione Git
├── composer/                 # Script per Composer
├── php/                      # Script PHP
└── docs/                     # Documentazione
```

## Regole Specifiche

### 1. Posizionamento
- ✅ **CORRETTO**: `bashscripts/utils/fix_encryption_error.sh`
- ❌ **ERRATO**: `laravel/fix_encryption_error.sh`

### 2. Categorizzazione
- **utils/**: Script di utilità generali
- **git/**: Script per gestione Git
- **composer/**: Script per gestione Composer
- **php/**: Script PHP
- **docs/**: Documentazione

### 3. Permessi
```bash
chmod +x bashscripts/utils/script.sh
```

## Regole di Memoria per AI

1. **MAI** creare script fuori da `bashscripts/`
2. **SEMPRE** categorizzare appropriatamente
3. **SEMPRE** documentare in `bashscripts/docs/`
4. **SEMPRE** rendere eseguibili con `chmod +x`

---

*Regole create il: $(date)*