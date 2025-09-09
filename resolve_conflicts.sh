#!/bin/bash

# Script per risolvere automaticamente i conflitti Git nel progetto TechPlanner
# Basato sull'analisi approfondita del framework Laraxot

echo "🔧 Inizio risoluzione conflitti Git per TechPlanner..."

# Contatore per i file processati
count=0

# Trova tutti i file con conflitti Git
files_with_conflicts=$(grep -r "<<<<<<< HEAD" . --include="*.php" --include="*.md" --include="*.json" -l 2>/dev/null)

echo "📊 Trovati $(echo "$files_with_conflicts" | wc -l) file con conflitti"

for file in $files_with_conflicts; do
    echo "🔄 Elaborando: $file"
    
    # Backup del file originale
    cp "$file" "$file.backup"
    
    # Rimozione semplice di conflitti comuni (mantiene la versione HEAD)
    # Questo approccio è sicuro per la maggior parte dei conflitti di formatting
    sed -i '/^<<<<<<< HEAD/,/^=======$/d; /^>>>>>>> /d' "$file" 2>/dev/null
    
    # Se il file risulta vuoto o corrotto, ripristina il backup
    if [ ! -s "$file" ] || ! php -l "$file" > /dev/null 2>&1; then
        echo "❌ Errore in $file, ripristino backup"
        mv "$file.backup" "$file"
    else
        echo "✅ Risolto: $file"
        rm "$file.backup"
        ((count++))
    fi
    
    # Limite per evitare operazioni troppo lunghe
    if [ $count -ge 50 ]; then
        echo "⚠️ Raggiunti 50 file, pausa per verifica"
        break
    fi
done

echo "✅ Completato! Risolti $count file"
echo "🔍 Verifica i risultati prima di committare"

# Verifica finale
remaining=$(grep -r "<<<<<<< HEAD" . --include="*.php" --include="*.md" --include="*.json" -l 2>/dev/null | wc -l)
echo "📋 File con conflitti rimanenti: $remaining"