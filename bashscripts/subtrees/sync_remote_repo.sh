#!/bin/bash

source ./bashscripts/lib/custom.sh
# Includi lo script di parsing
source ./bashscripts/lib/parse_gitmodules_ini.sh

# Validate input
<<<<<<< HEAD
#if [ $# -ne 1 ]; then
#    echo "Usage: $0 <org>"
    #echo "Esempio: $0 laraxot"
    #exit 1
#fi
=======
if [ $# -ne 1 ]; then
    echo "Usage: $0 <org>"
    exit 1
fi
>>>>>>> 4f97354 (.)

# Chiama la funzione
parse_gitmodules gitmodules.ini

me=$( readlink -f -- "$0")
script_dir=$(dirname "$me")
ORG="$1"
curr_dir=$(pwd)

# Esegui backup se richiesto
backup_disk

# Configurazione git
git_config_setup

total=${submodules_array["total"]}
for ((i=0; i<total; i++)); do
    path=${submodules_array["path_${i}"]}
    url=${submodules_array["url_${i}"]}
<<<<<<< HEAD
    origin="origin"
    if [ -n "$ORG" ]; then
        url=$(rewrite_url "$url" "$ORG")
        origin="$ORG"
    fi
=======
    url=$(rewrite_url "$url" "$ORG")
>>>>>>> 4f97354 (.)
    # Verifica se l'URL è già presente come remote
    #if ! git remote -v | grep -q "$url"; then
    #    echo "Aggiungendo remote per $path..."
    #    git remote add "$ORG" "$url"
    #fi
<<<<<<< HEAD
    echo "Submodule $i: 📂 path: $path 🌐 URL: $url 🔑 ORG: $origin"
=======
    echo "Submodule $i: 📂 path: $path 🌐 URL: $url 🔑 ORG: $ORG"
>>>>>>> 4f97354 (.)
    cd "$path"
    
    # Controllo se .git è un file e non una directory
    if [ -f ".git" ]; then
        echo "Trovato .git come file in $path, lo elimino..."
        rm -f .git
    fi
    
    # Verifica se .git esiste prima di inizializzare
    if [ ! -d ".git" ]; then
        echo "Inizializzazione repository Git in $path..."
        git init
    else
        echo "Repository Git già inizializzato in $path"
    fi
    echo "🌐 URL: $url"
    git config --global --add safe.directory "$curr_dir/$path"
    git checkout "$BRANCH" -- || git checkout -b "$BRANCH"
<<<<<<< HEAD
    git remote add "$origin" "$url"
    git_config_setup
    #git stash || echo "🔄 Non ci sono modifiche da salvare"
    dummy_push "$origin" "$BRANCH" "."
    
    git fetch --unshallow
    git fetch "$origin" "$BRANCH" --depth=1
    git pull "$origin" "$BRANCH" --autostash  --depth=1
    git merge "$origin/$BRANCH" --allow-unrelated-histories
=======
    git remote add "$ORG" "$url"
    git_config_setup
    #git stash || echo "🔄 Non ci sono modifiche da salvare"
    dummy_push "$ORG" "$BRANCH" "."

    git fetch "$ORG" "$BRANCH" --depth=1
    git pull "$ORG" "$BRANCH" --autostash  --depth=1
    git merge "$ORG/$BRANCH" --allow-unrelated-histories
>>>>>>> 4f97354 (.)

    # Loop per gestire eventuali conflitti
    while ! git rebase --continue 2>/dev/null; do
        if git diff --name-only --diff-filter=U | grep .; then
            echo "⚠️  Conflitti trovati. Li sistemiamo in automatico (accettando i tuoi cambiamenti)..."
        else
            echo "✅ Nessun conflitto o già risolto"
            break
        fi
<<<<<<< HEAD
        dummy_push "$origin" "$BRANCH" "."
    done
    #git stash apply || echo "🔄 Non ci sono modifiche da ripristinare"
    # Push finale
    dummy_push "$origin" "$BRANCH" "."
=======
        dummy_push "$ORG" "$BRANCH" "."
    done
    #git stash apply || echo "🔄 Non ci sono modifiche da ripristinare"
    # Push finale
    dummy_push "$ORG" "$BRANCH" "."
>>>>>>> 4f97354 (.)

    cd "$curr_dir"
done
