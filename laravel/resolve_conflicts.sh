#!/bin/bash

# Script per risolvere i conflitti git prendendo sempre la versione corrente (HEAD)
# Questo script risolve automaticamente i conflitti mantenendo la versione corrente

echo "🔍 Cercando file con marcatori di conflitto git..."

# Trova tutti i file con marcatori di conflitto
git_files=$(git diff --name-only --diff-filter=U 2>/dev/null || true)
conflict_files=$(grep -rl "^<<<<<<<" . --include="*.php" --include="*.js" --include="*.css" --include="*.html" --include="*.blade.php" --include="*.json" --include="*.yaml" --include="*.yml" --include="*.md" --include="*.txt" 2>/dev/null || true)

# Combina le due liste e rimuovi duplicati
all_files=$(echo "$git_files" "$conflict_files" | tr ' ' '\n' | sort -u | grep -v "^$")

if [ -z "$all_files" ]; then
    echo "✅ Nessun conflitto trovato!"
    exit 0
fi

echo "📁 File con conflitti trovati:"
echo "$all_files"
echo ""

# Crea directory di backup per i file originali
backup_dir="conflict_backup_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$backup_dir"

for file in $all_files; do
    if [ ! -f "$file" ]; then
        echo "⚠️  File $file non trovato, salto..."
        continue
    fi
    
    echo "🔄 Elaborando: $file"
    
    # Crea backup del file originale
    cp "$file" "$backup_dir/$(basename "$file").backup"
    
    # Risolvi i conflitti mantenendo sempre la versione corrente (HEAD)
    # Pattern: <<<<<<< HEAD (nostra versione) ======= (loro versione) >>>>>>> branch-name
    
    # Usa sed per rimuovere i marcatori di conflitto e mantenere solo la parte HEAD
    # Pattern: <<<<<<< HEAD (nostra versione) ======= (loro versione) >>>>>>> branch-name
    
    # Risolve i conflitti mantenendo solo la parte HEAD
    # Usa un approccio più semplice e affidabile
    sed -i '/^<<<<<<< HEAD/,/^=======/ {\
        /^<<<<<<< HEAD/d;\
        /^=======$/d;\
    };\
    /^=======/,/^>>>>>>>/ {\
        /^=======$/d;\
        /^>>>>>>>/d;\
    }' "$file"
    
    # Rimuovi eventuali righe vuote multiple create dal processo
    sed -i '/^$/{N;/^\n$/D}' "$file"
    
    echo "✅ Conflitti risolti in $file (mantenuta versione HEAD)"
done

echo ""
echo "🎯 Tutti i conflitti sono stati risolti mantenendo la versione corrente (HEAD)"
echo "📦 Backup dei file originali salvati in: $backup_dir/"
echo ""
echo "📋 Prossimi passi:"
echo "1. Verifica i cambiamenti con: git diff"
echo "2. Aggiungi i file risolti: git add ."
echo "3. Completa il merge: git commit -m 'Risolti conflitti mantenendo versione HEAD'"
echo ""

# Mostra stato git per conferma
echo "📊 Stato attuale:"
git status --short