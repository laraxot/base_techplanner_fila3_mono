---
# 📝 Documentazione Script Git

> **Revisione manuale:** File rivisto per eliminare duplicazioni, conflitti e marker. Strutturato per massima chiarezza, con esempi pratici e riferimenti architetturali.

> **Backlink:** [README globale](./README.md) · [scripts_conflict_resolution.md](./scripts_conflict_resolution.md)

---

## Obiettivo
Fornire una panoramica aggiornata e priva di conflitti sugli script bash per la gestione avanzata di Git e subtree nel progetto.

## Script principali

### `git_config_setup`
Funzione centralizzata (in `custom.sh`) per impostare:
- `core.ignorecase`, `core.fileMode`, `core.autocrlf`, `core.eol`, `core.symlinks`, `core.longpaths`

### `git_pull_subtrees.sh`
- Pull multiplo dei subtree
- Backup opzionale
- Gestione `gitmodules.ini` e organizzazioni custom

### `git_pull_subtree.sh`
- Pull di un singolo subtree
- Gestione errori e logging avanzato
- Supporto branch personalizzati

### `git_push_subtrees.sh`
- Push verso remoti multipli
- Logging e gestione errori

## Best Practice
- Usare sempre `git_config_setup`
- Eseguire backup prima di operazioni critiche
- Validare i log e aggiornare `gitmodules.ini`

## Risoluzione conflitti
- In caso di merge, usare script di backup e seguire la strategia documentata in [scripts_conflict_resolution.md](./scripts_conflict_resolution.md)

## Collegamenti
- [README globale](./README.md)
- [scripts_conflict_resolution.md](./scripts_conflict_resolution.md)
- [git_subtree_conflicts.md](./git_subtree_conflicts.md)

---

> Ogni modifica agli script va testata manualmente e tracciata nella documentazione.- `core.autocrlf`: false (no conversione automatica line endings)
<<<<<<< HEAD
# Script Git per la Gestione dei Subtree
=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
=======
=======
=======
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
# Script Git
>>>>>>> f1e7ef1046 (.)
>>>>>>> ec52a6b4 (.)
=======
# Script Git
=======
=======
<<<<<<< HEAD
=======
# Script Git
=======
>>>>>>> develop
=======
=======
=======
=======
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
# Script Git
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> f1e7ef1046 (.)
>>>>>>> 71ff9e32 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
=======
=======
>>>>>>> 9de04485 (.)
# Script Git
>>>>>>> ea169dcc (.)

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 04d882f8f6 (.)
=======
>>>>>>> f52d0712 (.)
=======
>>>>>>> 04d882f8f6 (.)
>>>>>>> 71ff9e32 (.)
=======
>>>>>>> ea169dcc (.)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 71ff9e32 (.)

1. Sistema avanzato di logging con timestamp, colori ed emoji
2. Gestione errori robusta con fallback automatici
3. Supporto per branch personalizzati
4. Strategie multiple di pull con tentativi sequenziali:
   - Pull standard con squash
   - Pull senza squash
   - Split e merge con branch temporaneo
   - Backup e ripristino completo
5. Logging dettagliato in file di log

**Risoluzione conflitti applicata**:
- Integrato il miglior sistema di logging con timestamp e output colorato
- Migliorata la gestione degli errori con messaggi più descrittivi
- Ottimizzato il flusso di backup/ripristino per una maggiore robustezza
- Unificate le strategie di fallback in caso di errori
- Aggiunto logging su file per facilitare il debugging

**Uso**:
```bash
./bashscripts/git_pull_subtree.sh <path> <remote_repo>
```

**Parametri**:
- `<path>`: Il percorso del subtree locale
- `<remote_repo>`: L'URL del repository remoto
=======
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati
>>>>>>> f1e7ef1046 (.)
<<<<<<< HEAD
=======
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati
>>>>>>> f52d0712 (.)
=======
>>>>>>> 71ff9e32 (.)
=======
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati
>>>>>>> ea169dcc (.)

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 71ff9e32 (.)
### git_sync_subtree.sh
Script ottimizzato per la sincronizzazione di un singolo subtree. Caratteristiche principali:
1. Sistema avanzato di logging con timestamp e codici colore
2. Gestione robusta degli errori con fallback automatici
3. Strategia di sincronizzazione in più passaggi:
   - Pull del subtree con tentativo di squash
   - Merge con strategia subtree
   - Split e push forzato tramite branch temporaneo
   - Push di backup con metodo standard

**Risoluzione conflitti applicata**:
- Integrato il miglior sistema di logging dalla versione HEAD (con timestamp)
- Adottata la variabile REMOTE_BRANCH dalla versione incoming per maggiore flessibilità
- Implementata una strategia di gestione errori più robusta con fallback automatici
- Mantenuti i commenti emoji per maggiore leggibilità
- Aggiunto push standard come backup dopo il metodo split-push

Questo script è progettato per funzionare in tandem con `git_pull_subtree.sh` e `git_push_subtree.sh`, ma può essere utilizzato anche come soluzione standalone per casi complessi di sincronizzazione subtree.

### git_sync_subtrees.sh
Script completo per la sincronizzazione di tutti i subtree definiti in `gitmodules.ini`. Caratteristiche:
1. Sistema avanzato di logging con timestamp e output colorato
2. Preservazione delle modifiche locali durante la sincronizzazione
3. Meccanismi intelligenti di backup e recovery
4. Risoluzione automatica dei conflitti più comuni
5. Supporto per organizzazioni GitHub personalizzate

**Funzionalità avanzate:**
- Creazione automatica di backup branch prima di operazioni rischiose
- Gestione dello stash per preservare modifiche non committate
- Strategie progressive di fallback in caso di errori
- Meccanismo di merge cherry-pick per preservare modifiche locali
- History minima tramite fetch con depth per migliorare le performance

**Risoluzione conflitti applicata:**
- Integrato il sistema avanzato di preservazione delle modifiche locali
- Migliorato il sistema di logging con timestamp e colorazione
- Ottimizzato il meccanismo di utilizzo della memoria tramite depth limitato
- Implementata una gestione strutturata degli errori in ogni fase
- Aggiunto supporto per la lettura diretta da `gitmodules.ini` tramite l'utility `parse_gitmodules_ini.sh`

**Uso:**
```bash
./bashscripts/git_sync_subtrees.sh [org_personalizzata]
```

**Parametri:**
- `[org_personalizzata]`: (Opzionale) Permette di specificare un'organizzazione GitHub alternativa per tutti i repository

Per una documentazione più generale sugli script di gestione Git, consultare la [documentazione centrale](../../docs/bashscripts/gestione_git.md).

=======
>>>>>>> f1e7ef1046 (.)
<<<<<<< HEAD
=======
>>>>>>> f52d0712 (.)
=======
>>>>>>> 71ff9e32 (.)
=======
>>>>>>> ea169dcc (.)
## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 1831d11e78 (.)
# Script Git
=======
## Script di sincronizzazione repository remoti
>>>>>>> 04d882f8f6 (.)
=======
=======
>>>>>>> 3c18aa7e (.)
<<<<<<< HEAD
# Script Git
>>>>>>> f1e7ef1046 (.)
=======
# Script Git
>>>>>>> f52d0712 (.)
=======
=======
>>>>>>> develop
# Script Git
>>>>>>> f1e7ef1046 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

<<<<<<< HEAD
=======
=======
>>>>>>> 3c18aa7e (.)
>>>>>>> ea169dcc (.)
# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 71ff9e32 (.)
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> 3a6821ae8 (aggiornamento cartella bashscripts)
=======
=======
>>>>>>> f000df5 (.)
>>>>>>> 3c18aa7e (.)
>>>>>>> f71d08e230 (.)
>>>>>>> ec52a6b4 (.)
=======
=======
=======
=======
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
<<<<<<< HEAD
=======
>>>>>>> f000df5 (.)
>>>>>>> 3c18aa7e (.)
>>>>>>> ea169dcc (.)
# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 337c5266 (.)
=======
>>>>>>> ea169dcc (.)
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
>>>>>>> ec52a6b4 (.)
=======
=======
=======
=======
=======
=======

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks
=======
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9de04485 (.)
=======
=======
>>>>>>> 85c5198c (.)
=======
=======
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
>>>>>>> ec52a6b4 (.)
=======
=======
=======
=======
=======
=======
=======
=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
>>>>>>> ea169dcc (.)

# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)

[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
3. Problemi di permessi: controllare fileMode e symlinks
=======

=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> 0c55086029 (.)
=======
>>>>>>> f000df5 (.)
>>>>>>> f1e7ef1046 (.)
=======
=======
=======
<<<<<<< HEAD
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
=======

[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
3. Problemi di permessi: controllare fileMode e symlinks
<<<<<<< HEAD
=======

=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
=======
>>>>>>> develop

[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
3. Problemi di permessi: controllare fileMode e symlinks
=======

=======
<<<<<<< HEAD
>>>>>>> 0c55086029 (.)
=======
>>>>>>> f000df5 (.)
>>>>>>> f1e7ef1046 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
# Script Git

Questi script sono utilizzati per automatizzare le operazioni Git nel progetto.

## Panoramica
Questa documentazione descrive gli script bash utilizzati per la gestione dei subtree git nel progetto Laraxot.

## Script Principali

### git_config_setup
Funzione centralizzata per la configurazione git, definita in `custom.sh`. Gestisce le seguenti impostazioni:
- `core.ignorecase`: false (case-sensitive)
- `core.fileMode`: false (ignora permessi)
- `core.autocrlf`: false (no conversione automatica line endings)
- `core.eol`: lf (line ending di default)
- `core.symlinks`: false (no symlinks per Windows)
- `core.longpaths`: true (supporto path lunghi Windows)

### git_pull_subtrees.sh
Script principale per il pull dei subtree. Funzionalità:
1. Configurazione git tramite `git_config_setup`
2. Backup opzionale su disco esterno
3. Gestione dei subtree definiti in gitmodules.ini
4. Supporto per organizzazioni GitHub personalizzate

### git_pull_subtree.sh
Script per il pull di un singolo subtree. Caratteristiche:
1. Gestione errori robusta
2. Logging delle operazioni
3. Supporto per branch personalizzati

### git_push_subtrees.sh
Script per il push dei subtree. Funzionalità:
1. Push verso repository remoti
2. Supporto per organizzazioni multiple
3. Gestione errori e logging

## Best Practices
1. Utilizzare sempre `git_config_setup` per la configurazione
2. Gestire i backup prima delle operazioni critiche
3. Verificare i log per eventuali errori
4. Mantenere aggiornato gitmodules.ini

## Risoluzione Problemi Comuni
1. Conflitti di merge: utilizzare gli script di backup prima di risolvere
2. Errori di path: verificare la configurazione Windows
3. Problemi di permessi: controllare fileMode e symlinks

=======
<<<<<<< HEAD
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
=======
<<<<<<< HEAD
=======
>>>>>>> d83fe8da (.)
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
>>>>>>> 1831d11e78 (.)
=======
<<<<<<< HEAD
>>>>>>> d83fe8da (.)
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
>>>>>>> 1831d11e78 (.)
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
>>>>>>> 0c55086029 (.)
=======
[Torna alla documentazione principale](../../docs/maintenance.md#git-management) 
>>>>>>> 04d882f8f6 (.)
=======
=======
=======
>>>>>>> a013e8e (.)
=======

=======
>>>>>>> ea169dcc (.)
>>>>>>> 4d4d6cb7 (.)
=======
>>>>>>> d83fe8da (.)
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
<<<<<<< HEAD
=======
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
=======
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
>>>>>>> f71d08e230 (.)
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
>>>>>>> 0c55086029 (.)
=======
[Torna alla documentazione principale](../../docs/maintenance.md#git-management) 
>>>>>>> 04d882f8f6 (.)
=======
=======
>>>>>>> 4d4d6cb7 (.)
=======
>>>>>>> develop
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
=======
<<<<<<< HEAD
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
>>>>>>> f71d08e230 (.)
>>>>>>> ec52a6b4 (.)
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
=======
[Torna alla documentazione principale](../../docs/maintenance.md#git-management) 
=======
=======
=======
=======
[Torna alla documentazione principale](/docs/maintenance.md#git-management) 
=======
=======
=======
=======
=======
=======
=======
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
