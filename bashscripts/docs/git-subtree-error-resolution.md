# 🚀 Gestione Errori Git Subtree

## 📋 Struttura del Sistema

Il sistema di gestione dei subtree è composto da tre componenti principali:

1. `git_sync_subtree.sh` - Script principale di sincronizzazione
2. `git_push_subtree.sh` - Gestore delle operazioni di push
3. `git_pull_subtree.sh` - Gestore delle operazioni di pull

## 🔄 Flusso Operativo

### 1. Script Principale (`git_sync_subtree.sh`)
- **Input**: `<path>` e `<remote_repo>`
- **Preparazione**:
  - Normalizzazione CRLF
  - Impostazione permessi
- **Sequenza**:
  1. Push subtree
  2. Pull subtree

### 2. Push Script (`git_push_subtree.sh`)

<<<<<<< HEAD
<<<<<<< HEAD

=======
```bash
=======
<<<<<<< HEAD
=======

=======
```bash
<<<<<<< HEAD
>>>>>>> 3a6821ae8 (aggiornamento cartella bashscripts)
=======
```bash
>>>>>>> f1e7ef1046 (.)
=======
>>>>>>> f71d08e230 (.)
=======
>>>>>>> ec52a6b4 (.)
=======
```bash
=======
=======
```bash
<<<<<<< HEAD

=======
>>>>>>> develop

<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
```bash
>>>>>>> 3a6821ae8 (aggiornamento cartella bashscripts)
=======
```bash
>>>>>>> f1e7ef1046 (.)
=======
>>>>>>> f71d08e230 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
```bash

>>>>>>> ea169dcc (.)
# 1. Inizializzazione
git init
git checkout -b "$BRANCH"

# 2. Configurazione remoto
git remote add origin "$REMOTE_REPO"
git fetch --all

# 3. Commit e push
git add -A
git commit -am "🔧 Aggiornamento subtree"
<<<<<<< HEAD
git merge origin/"$BRANCH" --allow-unrelated-histories
=======
<<<<<<< HEAD
git merge origin/"$BRANCH" --allow-unrelated-histories"
=======
<<<<<<< HEAD
git merge origin/"$BRANCH" --allow-unrelated-histories"
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
>>>>>>> f1e7ef1046 (.)
=======
=======
<<<<<<< HEAD
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
>>>>>>> develop
git merge origin/"$BRANCH" --allow-unrelated-histories"
>>>>>>> 1831d11e78 (.)
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
>>>>>>> f1e7ef1046 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
>>>>>>> ea169dcc (.)
git push -u origin "$BRANCH"
```

### 3. Pull Script (`git_pull_subtree.sh`)
```bash
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

=======

=======
<<<<<<< HEAD
>>>>>>> f1e7ef1046 (.)
=======
<<<<<<< HEAD

>>>>>>> f71d08e230 (.)
=======
=======
>>>>>>> 71ff9e32 (.)
=======

>>>>>>> develop
=======

<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> f71d08e230 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======

>>>>>>> ea169dcc (.)
# 1. Pull standard
git subtree pull -P "$LOCAL_PATH" "$REMOTE_REPO" "$BRANCH" --squash

# 2. Fallback 1
git subtree pull -P "$LOCAL_PATH" "$REMOTE_REPO" "$BRANCH"

# 3. Fallback 2
git fetch "$REMOTE_REPO" "$BRANCH" --depth=1
git merge -s subtree FETCH_HEAD --allow-unrelated-histories
<<<<<<< HEAD

aurmich/dev
=======
<<<<<<< HEAD
```

=======
<<<<<<< HEAD
```

<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
```

>>>>>>> f1e7ef1046 (.)
=======
=======
<<<<<<< HEAD
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
```

=======
```

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
>>>>>>> develop
```

>>>>>>> 1831d11e78 (.)
=======
```

>>>>>>> f1e7ef1046 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
```

>>>>>>> ea169dcc (.)
Esegue una sequenza complessa di operazioni:
```bash
1. git add -A && git commit -am "."
2. git push -u origin $REMOTE_BRANCH
3. git subtree push -P $LOCAL_PATH $REMOTE_REPO $REMOTE_BRANCH
4. git push -f $REMOTE_REPO $(git subtree split --prefix=$LOCAL_PATH):$REMOTE_BRANCH
5. git subtree split --prefix=$LOCAL_PATH -b $TEMP_BRANCH
6. git push -f $REMOTE_REPO $TEMP_BRANCH:$REMOTE_BRANCH
7. git branch -D $TEMP_BRANCH
8. git subtree push -P $LOCAL_PATH $REMOTE_REPO $REMOTE_BRANCH
9. git rebase --rebase-merges --strategy subtree $REMOTE_BRANCH
```

<<<<<<< HEAD
### 3. Pull Script (`git_pull_subtree.sh`)
=======
<<<<<<< HEAD
=======
=======
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> f1e7ef1046 (.)
=======
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
Esegue una sequenza con fallback:
```bash
1. git subtree pull -P $LOCAL_PATH $REMOTE_REPO $REMOTE_BRANCH --squash
2. Se fallisce, prova: git subtree pull -P $LOCAL_PATH $REMOTE_REPO $REMOTE_BRANCH
3. Se fallisce ancora:
   - git fetch $REMOTE_REPO $REMOTE_BRANCH --depth=1
   - git merge -s subtree FETCH_HEAD --allow-unrelated-histories
4. git rebase --rebase-merges --strategy subtree $REMOTE_BRANCH
<<<<<<< HEAD

 43df3e0 (.)
aurmich/dev
=======
<<<<<<< HEAD
=======
=======
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> f1e7ef1046 (.)
=======
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
```

## 🚨 Analisi Errori Comuni

### 1. Errore: Prefix Mancante
```
fatal: you must provide the --prefix option
```

**Causa**: Variabili `LOCAL_PATH` o `REMOTE_REPO` non definite

**Soluzione**:
```bash
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

=======

=======
<<<<<<< HEAD
>>>>>>> f1e7ef1046 (.)
=======
<<<<<<< HEAD

>>>>>>> f71d08e230 (.)
=======
=======
>>>>>>> 71ff9e32 (.)
=======

>>>>>>> develop
=======

<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> f71d08e230 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======

>>>>>>> ea169dcc (.)
# Verifica variabili
if [ -z "$LOCAL_PATH" ] || [ -z "$REMOTE_REPO" ]; then
    echo "❌ Error: Missing required variables"
    exit 1
fi
```

### 2. Errore: Push Rejected
```
! [rejected] dev -> dev (non-fast-forward)
```

<<<<<<< HEAD


=======
<<<<<<< HEAD
=======
=======
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> f1e7ef1046 (.)
=======
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
**Causa**: Divergenze tra repository locale e remoto

**Soluzione**:
```bash

# Aggiorna repository locale
git fetch origin "$BRANCH"
git merge origin/"$BRANCH" --allow-unrelated-histories"
<<<<<<< HEAD
=======
# Aggiorna repository locale
git fetch origin "$BRANCH"
=======
git merge origin/"$BRANCH" --allow-unrelated-histories"
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
# Aggiorna repository locale
git fetch origin "$BRANCH"
git merge origin/"$BRANCH" --allow-unrelated-histories"
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> f1e7ef1046 (.)
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

# Riprova push
if ! git push -u origin "$BRANCH"; then
    git pull --rebase origin "$BRANCH"
    git push -u origin "$BRANCH"
fi
```

## 🛠️ Best Practices

### 1. Prima dell'Esecuzione
- ✔️ Commit/stash delle modifiche pendenti
- ✔️ Verifica branch corrente
- ✔️ Controllo stato repository

### 2. Durante l'Esecuzione
- 👀 Monitora l'output
- ⏳ Non interrompere gli script
- 📝 Controlla i log

### 3. Dopo l'Esecuzione
- 🔍 Verifica stato subtree
- 📊 Controlla storia commit
- 🔄 Verifica sincronizzazione

## 📝 Note sulla Manutenzione

1. **Strategia Push**:
   - Utilizzo di `--force` push in casi specifici
   - Rebase per storia pulita
   - Meccanismi di fallback per pull

2. **Gestione Errori**:
   - Logging dettagliato
   - Verifica permessi
   - Controlli pre-esecuzione

## 🔍 Suggerimenti per il Debugging

1. **Debug Verbose**:
   ```bash
   set -x  # Attiva debug verbose
   ```

2. **Logging Dettagliato**:
   ```bash
   log() {
       echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1"
   }
   ```

3. **Verifica Permessi**:
   ```bash
   chmod +x *.sh
   ```

## 📚 Documentazione Aggiuntiva

- [Git Subtree Documentation](https://git-scm.com/book/en/v2/Git-Tools-Advanced-Merging)
- [Git Subtree Tutorial](https://www.atlassian.com/git/tutorials/git-subtree)
- [Git Subtree vs Submodule](https://git-scm.com/book/en/v2/Git-Tools-Submodules)

---

<div align="center">
  <sub>Built with ❤️ by the development team</sub>
</div>
<<<<<<< HEAD

aurmich/dev
**Causa**: Questo errore si verifica nella sequenza di push quando ci sono divergenze tra il repository locale e remoto.

**Soluzione**:
1. Prima del push, assicurarsi che il repository locale sia aggiornato:
```bash
git fetch origin $REMOTE_BRANCH
git merge origin/$REMOTE_BRANCH --allow-unrelated-histories
```

2. Modificare la sequenza di push per gestire meglio i conflitti:
```bash
if ! git push -u origin "$REMOTE_BRANCH"; then
    git pull --rebase origin "$REMOTE_BRANCH"
    git push -u origin "$REMOTE_BRANCH"
fi
```

## Best Practices per l'Uso

1. **Prima dell'Esecuzione**:
   - Committare o stashare modifiche pendenti
   - Assicurarsi di essere sul branch corretto
   - Verificare lo stato del repository remoto

2. **Durante l'Esecuzione**:
   - Monitorare l'output per errori specifici
   - Non interrompere gli script durante l'esecuzione

3. **Dopo l'Esecuzione**:
   - Verificare lo stato del subtree
   - Controllare la storia dei commit
   - Verificare la sincronizzazione con il remote

## Note sulla Manutenzione

1. Gli script utilizzano una strategia aggressiva con `--force` push in alcuni casi
2. Il rebase viene utilizzato per mantenere una storia pulita
3. Sono implementati meccanismi di fallback per il pull
4. La gestione degli errori potrebbe essere migliorata con più logging

## Suggerimenti per il Debugging

1. Aggiungere `set -x` all'inizio degli script per debug verbose
2. Implementare logging più dettagliato
3. Verificare i permessi degli script

 43df3e0 (.)
aurmich/dev
=======
<<<<<<< HEAD
=======
=======
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> f1e7ef1046 (.)
=======
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
