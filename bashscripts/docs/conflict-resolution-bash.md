# Risoluzione Manuale dei Conflitti negli Script Bash

> **Nota**: Per informazioni aggiuntive sui conflitti nei moduli, consulta anche [Conflitti Git nei Moduli](../../docs/conflitti_git_moduli.md)

## PERCHÉ È CRUCIALE

La risoluzione manuale dei conflitti negli script bash è particolarmente delicata per le seguenti ragioni:

- **Esecuzione critica**: Gli script bash spesso eseguono operazioni critiche sul sistema (file system, git, deployment)
- **Effetti collaterali**: Errori nella risoluzione possono causare perdita di dati o comportamenti distruttivi
- **Principio DRY**: La duplicazione di funzioni è particolarmente dannosa negli script bash
- **Coerenza funzionale**: Le funzioni devono mantenere comportamenti coerenti in tutto il sistema
- **Gestione errori**: Le strategie di gestione degli errori devono essere uniformi

## COSA FARE

### Processo di analisi e risoluzione

1. **Comprensione del contesto**
   - Identificare lo scopo dello script e delle funzioni coinvolte
   - Verificare se lo script importa librerie con `source`
   - Controllare quali funzioni sono già definite nelle librerie importate

2. **Analisi delle versioni in conflitto**
   - Confrontare le implementazioni per identificare le differenze sostanziali
   - Valutare quale versione offre:
     - Migliore gestione degli errori
     - Maggiore robustezza
     - Migliore documentazione
     - Compatibilità con il resto del sistema

3. **Risoluzione consapevole**
   - Scegliere la versione più completa e robusta
   - Se entrambe le versioni hanno vantaggi, integrarle in modo coerente
   - Assicurarsi che la funzione mantenga la stessa firma e comportamento atteso
   - Verificare che non ci siano duplicazioni con funzioni già esistenti nelle librerie

4. **Verifica e test**
   - Testare lo script dopo la risoluzione
   - Verificare che tutte le dipendenze funzionino correttamente
   - Controllare che la gestione degli errori sia appropriata

## ESEMPI PRATICI

### Conflitto in funzione di logging

```bash



 9b65b0d (.)
# Versione avanzata con livelli di log
log() {
    local level="$1"
    local message="$2"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    
    case "$level" in
        "error") echo -e "❌ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
        "success") echo -e "✅ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
        "warning") echo -e "⚠️ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
        "info") echo -e "ℹ️ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
        *) echo -e "[$timestamp] $message" | tee -a "$LOG_FILE" ;;
    esac
}



 9b65b0d (.)
# Versione semplice
log() {
    local message="$1"
    echo "📆 $(date '+%Y-%m-%d %H:%M:%S') - $message" | tee -a "$LOG_FILE"
}

 feature-branch

 9b65b0d (.)
```

**Soluzione ottimale**: Integrare entrambe le versioni mantenendo la compatibilità con il codice esistente.

```bash
# Funzione avanzata per loggare messaggi che supporta entrambi i formati
log() {
    # Supporta sia il formato avanzato con livelli che il formato semplice
    if [ $# -eq 2 ]; then
        # Formato avanzato: log "level" "message"
        local level="$1"
        local message="$2"
        local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
        
        case "$level" in
            "error") echo -e "❌ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
            "success") echo -e "✅ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
            "warning") echo -e "⚠️ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
            "info") echo -e "ℹ️ [$timestamp] $message" | tee -a "$LOG_FILE" ;;
            *) echo -e "[$timestamp] $message" | tee -a "$LOG_FILE" ;;
        esac
    else
        # Formato semplice: log "message"
        local message="$1"
        local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
        echo "📆 $timestamp - $message" | tee -a "$LOG_FILE"
    fi
}
```

### Conflitto in parametri di script

```bash



 9b65b0d (.)
# Versione che richiede 2 parametri
if [ $# -ne 2 ]; then
    echo "Usage: $0 <path> <remote_repo>"
    exit 1
fi

LOCAL_PATH="$1"
REMOTE_REPO="$2"



 9b65b0d (.)
# Versione che richiede 3 parametri
if [ $# -ne 3 ]; then
    echo "Usage: $0 <path> <remote_repo> <branch>"
    exit 1
fi

LOCAL_PATH="$1"
REMOTE_REPO="$2"
BRANCH="$3"

 feature-branch

 9b65b0d (.)
```

**Soluzione ottimale**: Valutare quale approccio è più flessibile e coerente con il resto del sistema. Se il branch è opzionale, rendere il terzo parametro opzionale con un valore predefinito.

```bash
# Versione che supporta 2 o 3 parametri
if [ $# -lt 2 ] || [ $# -gt 3 ]; then
    echo "Usage: $0 <path> <remote_repo> [branch]"
    exit 1
fi

LOCAL_PATH="$1"
REMOTE_REPO="$2"
BRANCH="${3:-main}"  # Usa il terzo parametro se fornito, altrimenti "main"
```

## COLLEGAMENTI ALLA DOCUMENTAZIONE PRINCIPALE

- [Risoluzione Manuale dei Conflitti](../../docs/CONFLICT_RESOLUTION.md) - Principi generali per la risoluzione dei conflitti
- [Principio DRY negli Script Bash](NO_DUPLICATE_FUNCTIONS_IN_SOURCED_SCRIPTS.md) - Linee guida per evitare la duplicazione di codice
- [Filosofia della Documentazione](../../docs/DOCUMENTATION_PHILOSOPHY.md) - Principi fondamentali di documentazione

---

> **NOTA IMPORTANTE**: La risoluzione dei conflitti negli script bash deve sempre privilegiare la robustezza, la gestione degli errori e il rispetto del principio DRY. Ogni conflitto risolto deve essere accompagnato da un aggiornamento della documentazione.

# Risoluzione Conflitti Bash

> **Nota**: Per informazioni aggiuntive sui conflitti nei moduli, consulta anche [Conflitti Git nei Moduli](../../docs/conflitti_git_moduli.md)
