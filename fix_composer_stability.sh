#!/bin/bash

# Script per impostare minimum-stability: dev in tutti i composer.json

echo "🔧 Impostazione minimum-stability: dev in tutti i composer.json..."

# Funzione per modificare un singolo composer.json
fix_composer_json() {
    local file="$1"
    echo "📝 Modificando: $file"
    
    # Se il file non ha minimum-stability, lo aggiungiamo
    if ! grep -q '"minimum-stability"' "$file"; then
        # Aggiungiamo prima di "extra" o alla fine se non c'è extra
        if grep -q '"extra"' "$file"; then
            sed -i '/"extra"/i\    "minimum-stability": "dev",' "$file"
        else
            # Aggiungiamo prima dell'ultima parentesi chiusa
            sed -i '$ s/}$/    "minimum-stability": "dev"\n}/' "$file"
        fi
        echo "✅ Aggiunto minimum-stability: dev"
    else
        # Se esiste, lo modifichiamo
        sed -i 's/"minimum-stability": "[^"]*"/"minimum-stability": "dev"/g' "$file"
        echo "✅ Modificato minimum-stability a dev"
    fi
}

# Composer.json principale
if [ -f "laravel/composer.json" ]; then
    fix_composer_json "laravel/composer.json"
fi

# Composer.json nei moduli
for module in laravel/Modules/*/; do
    if [ -f "${module}composer.json" ]; then
        fix_composer_json "${module}composer.json"
    fi
done

# Composer.json in bashscripts
if [ -f "bashscripts/composer.json" ]; then
    fix_composer_json "bashscripts/composer.json"
fi

echo "✅ Completato! Tutti i composer.json sono stati aggiornati." 