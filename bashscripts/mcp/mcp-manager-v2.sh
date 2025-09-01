#!/bin/bash

# Script di gestione dei server MCP per base_predict_fila3_mono
# Versione 2.0 - Supporto per server MySQL personalizzato
# Autore: Cascade AI Assistant
# Data: 2025-05-13

PROJECT_DIR="/var/www/html/_bases/base_predict_fila3_mono"
LOGS_DIR="$PROJECT_DIR/storage/logs/mcp"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
MYSQL_CONNECTOR="$PROJECT_DIR/scripts/mysql-db-connector.js"
=======
MYSQL_CONNECTOR="$PROJECT_DIR/bashscripts/mcp/mysql-db-connector.js"
>>>>>>> 337c5266 (.)
=======
MYSQL_CONNECTOR="$PROJECT_DIR/bashscripts/mcp/mysql-db-connector.js"
=======
MYSQL_CONNECTOR="$PROJECT_DIR/scripts/mysql-db-connector.js"
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
MYSQL_CONNECTOR="$PROJECT_DIR/scripts/mysql-db-connector.js"
>>>>>>> 9de04485 (.)

# Crea la directory dei log se non esiste
mkdir -p "$LOGS_DIR"
chmod -R 777 "$LOGS_DIR"

# Funzione per mostrare l'aiuto
show_help() {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    echo "Utilizzo: /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh [comando] [server]"
=======
    echo "Utilizzo: ./bashscripts/mcp/mcp-manager-v2.sh [comando] [server]"
>>>>>>> 337c5266 (.)
=======
    echo "Utilizzo: ./bashscripts/mcp/mcp-manager-v2.sh [comando] [server]"
=======
    echo "Utilizzo: /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh [comando] [server]"
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    echo "Utilizzo: /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh [comando] [server]"
>>>>>>> 9de04485 (.)
    echo ""
    echo "Comandi disponibili:"
    echo "  start [server]    - Avvia uno o tutti i server MCP"
    echo "  stop [server]     - Ferma uno o tutti i server MCP"
    echo "  status [server]   - Mostra lo stato di uno o tutti i server MCP"
    echo "  restart [server]  - Riavvia uno o tutti i server MCP"
    echo "  logs [server]     - Mostra i log di uno o tutti i server MCP"
    echo "  install [server]  - Installa uno o tutti i server MCP"
    echo ""
    echo "Server disponibili:"
    echo "  sequential-thinking - Server per il pensiero sequenziale"
    echo "  memory             - Server per la memorizzazione di informazioni"
    echo "  fetch              - Server per le richieste HTTP"
    echo "  filesystem         - Server per le operazioni sul filesystem"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    echo "  postgres           - Server per database PostgreSQL"
    echo "  redis              - Server per Redis"
=======
>>>>>>> 337c5266 (.)
=======
=======
    echo "  postgres           - Server per database PostgreSQL"
    echo "  redis              - Server per Redis"
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    echo "  postgres           - Server per database PostgreSQL"
    echo "  redis              - Server per Redis"
>>>>>>> 9de04485 (.)
    echo "  puppeteer          - Server per l'automazione del browser"
    echo "  mysql              - Server personalizzato per MySQL (usa .env di Laravel)"
    echo "  all                - Tutti i server (default se non specificato)"
    echo ""
    echo "Esempi:"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start mysql    - Avvia il server MCP MySQL"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start          - Avvia tutti i server MCP"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh status         - Mostra lo stato di tutti i server MCP"
=======
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh start mysql    - Avvia il server MCP MySQL"
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh start          - Avvia tutti i server MCP"
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh status         - Mostra lo stato di tutti i server MCP"
>>>>>>> 337c5266 (.)
=======
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh start mysql    - Avvia il server MCP MySQL"
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh start          - Avvia tutti i server MCP"
    echo "  ./bashscripts/mcp/mcp-manager-v2.sh status         - Mostra lo stato di tutti i server MCP"
=======
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start mysql    - Avvia il server MCP MySQL"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start          - Avvia tutti i server MCP"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh status         - Mostra lo stato di tutti i server MCP"
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start mysql    - Avvia il server MCP MySQL"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh start          - Avvia tutti i server MCP"
    echo "  /var/www/html/_bases/base_predict_fila3_mono/bashscripts/mcp/mcp-manager-v2.sh status         - Mostra lo stato di tutti i server MCP"
>>>>>>> 9de04485 (.)
}

# Funzione per ottenere il PID di un server MCP
get_pid() {
    local server_name=$1
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    if [ "$server_name" = "mysql" ]; then
        ps aux | grep "MYSQL_DB_CONNECTOR_PID_MARKER" | grep -v grep | awk '{print $2}'
    else
        ps aux | grep "@modelcontextprotocol/server-$server_name" | grep -v grep | awk '{print $2}'
    fi
}

# Funzione per installare un server MCP
install_server() {
    local server_name=$1
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
    if [ "$server_name" = "mysql" ]; then
        echo "📦 Installazione delle dipendenze per il server MySQL personalizzato..."
        cd "$PROJECT_DIR" && npm install --save mysql2 dotenv
        
=======
=======
>>>>>>> 85c5198c (.)

    if [ "$server_name" = "mysql" ]; then
        echo "📦 Installazione delle dipendenze per il server MySQL personalizzato..."
        cd "$PROJECT_DIR" && npm install --save mysql2 dotenv

<<<<<<< HEAD
>>>>>>> 337c5266 (.)
=======
=======
=======
>>>>>>> 9de04485 (.)
    
    if [ "$server_name" = "mysql" ]; then
        echo "📦 Installazione delle dipendenze per il server MySQL personalizzato..."
        cd "$PROJECT_DIR" && npm install --save mysql2 dotenv
        
<<<<<<< HEAD
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
        if [ $? -eq 0 ]; then
            echo "✅ Dipendenze per il server MySQL personalizzato installate con successo"
            return 0
        else
            echo "❌ Errore nell'installazione delle dipendenze per il server MySQL personalizzato"
            return 1
        fi
    else
        echo "📦 Installazione del server MCP $server_name..."
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        
=======
>>>>>>> 337c5266 (.)
=======
=======
        
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
        
>>>>>>> 9de04485 (.)
        # Verifica se il server è già installato
        if npm list -g | grep -q "@modelcontextprotocol/server-$server_name"; then
            echo "✅ Server MCP $server_name è già installato globalmente"
        else
            echo "🔄 Installazione globale di @modelcontextprotocol/server-$server_name..."
            npm install -g @modelcontextprotocol/server-$server_name
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            
=======
>>>>>>> 337c5266 (.)
=======
=======
            
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
            
>>>>>>> 9de04485 (.)
            if [ $? -eq 0 ]; then
                echo "✅ Server MCP $server_name installato globalmente con successo"
            else
                echo "❌ Errore nell'installazione globale del server MCP $server_name"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                
                # Prova con installazione locale
                echo "🔄 Tentativo di installazione locale di @modelcontextprotocol/server-$server_name..."
                cd "$PROJECT_DIR" && npm install @modelcontextprotocol/server-$server_name
                
=======
=======
>>>>>>> 85c5198c (.)

                # Prova con installazione locale
                echo "🔄 Tentativo di installazione locale di @modelcontextprotocol/server-$server_name..."
                cd "$PROJECT_DIR" && npm install @modelcontextprotocol/server-$server_name

<<<<<<< HEAD
>>>>>>> 337c5266 (.)
=======
=======
=======
>>>>>>> 9de04485 (.)
                
                # Prova con installazione locale
                echo "🔄 Tentativo di installazione locale di @modelcontextprotocol/server-$server_name..."
                cd "$PROJECT_DIR" && npm install @modelcontextprotocol/server-$server_name
                
<<<<<<< HEAD
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
                if [ $? -eq 0 ]; then
                    echo "✅ Server MCP $server_name installato localmente con successo"
                else
                    echo "❌ Errore nell'installazione locale del server MCP $server_name"
                    return 1
                fi
            fi
        fi
    fi
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    return 0
}

# Funzione per avviare un server MCP
start_server() {
    local server_name=$1
    local pid=$(get_pid "$server_name")
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    if [ -n "$pid" ]; then
        echo "⚠️ Il server MCP $server_name è già in esecuzione con PID $pid"
        return 0
    fi
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
    # Gestione speciale per il server MySQL personalizzato
=======
>>>>>>> 337c5266 (.)
=======
=======
    
    # Gestione speciale per il server MySQL personalizzato
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
    # Gestione speciale per il server MySQL personalizzato
>>>>>>> 9de04485 (.)
    if [ "$server_name" = "mysql" ]; then
        if [ ! -f "$MYSQL_CONNECTOR" ]; then
            echo "❌ Script connector MySQL non trovato: $MYSQL_CONNECTOR"
            return 1
        fi
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        
        echo "🚀 Avvio del server MCP MySQL personalizzato..."
        cd "$PROJECT_DIR" && node "$MYSQL_CONNECTOR" > "$LOGS_DIR/mysql.log" 2>&1 &
    else
        # Verifica se il server è installato
        if ! npm list -g | grep -q "@modelcontextprotocol/server-$server_name" && ! npm list | grep -q "@modelcontextprotocol/server-$server_name"; then
            echo "⚠️ Server MCP $server_name non è installato. Installazione in corso..."
            install_server "$server_name"
        fi
        
        echo "🚀 Avvio del server MCP $server_name..."
        cd "$PROJECT_DIR" && npx -y @modelcontextprotocol/server-$server_name > "$LOGS_DIR/$server_name.log" 2>&1 &
    fi
    
    # Attendi che il server si avvii
    sleep 3
    
=======
=======
>>>>>>> 85c5198c (.)
        echo "🚀 Avvio del server MCP MySQL personalizzato..."
        cd "$PROJECT_DIR" && node "$MYSQL_CONNECTOR" > "$LOGS_DIR/mysql.log" 2>&1 &
    elif [ "$server_name" = "postgres" ]; then
        if [ -z "$POSTGRES_URL" ]; then
            echo "❌ Variabile d'ambiente POSTGRES_URL non impostata. Impossibile avviare il server MCP Postgres."
            return 1
        fi
        echo "🚀 Avvio del server MCP Postgres..."
        cd "$PROJECT_DIR" && npx -y @modelcontextprotocol/server-postgres "$POSTGRES_URL" > "$LOGS_DIR/postgres.log" 2>&1 &
    elif [ "$server_name" = "redis" ]; then
        if ! command -v redis-server &> /dev/null; then
            echo "❌ Redis non è installato. Impossibile avviare il server MCP Redis."
            return 1
        fi
        if ! redis-server --test-memory 1 &> /dev/null; then
            echo "❌ Redis non è in esecuzione su localhost:6379. Avvia Redis prima di continuare."
            return 1
        fi
        export REDIS_URL="redis://localhost:6379"
        echo "🚀 Avvio del server MCP Redis..."
        cd "$PROJECT_DIR" && npx -y @modelcontextprotocol/server-redis --stdio > "$LOGS_DIR/redis.log" 2>&1 &
    else
        echo "❌ Server MCP $server_name non supportato da questo script."
        return 1
    fi
    sleep 3
<<<<<<< HEAD
>>>>>>> 337c5266 (.)
=======
=======
=======
>>>>>>> 9de04485 (.)
        
        echo "🚀 Avvio del server MCP MySQL personalizzato..."
        cd "$PROJECT_DIR" && node "$MYSQL_CONNECTOR" > "$LOGS_DIR/mysql.log" 2>&1 &
    else
        # Verifica se il server è installato
        if ! npm list -g | grep -q "@modelcontextprotocol/server-$server_name" && ! npm list | grep -q "@modelcontextprotocol/server-$server_name"; then
            echo "⚠️ Server MCP $server_name non è installato. Installazione in corso..."
            install_server "$server_name"
        fi
        
        echo "🚀 Avvio del server MCP $server_name..."
        cd "$PROJECT_DIR" && npx -y @modelcontextprotocol/server-$server_name > "$LOGS_DIR/$server_name.log" 2>&1 &
    fi
    
    # Attendi che il server si avvii
    sleep 3
    
<<<<<<< HEAD
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
    pid=$(get_pid "$server_name")
    if [ -n "$pid" ]; then
        echo "✅ Server MCP $server_name avviato con PID $pid"
        return 0
    else
        echo "❌ Errore nell'avvio del server MCP $server_name"
        if [ "$server_name" = "mysql" ]; then
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/mysql.log"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        else
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/$server_name.log"
=======
=======
>>>>>>> 85c5198c (.)
        elif [ "$server_name" = "postgres" ]; then
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/postgres.log"
        elif [ "$server_name" = "redis" ]; then
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/redis.log"
<<<<<<< HEAD
>>>>>>> 337c5266 (.)
=======
=======
        else
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/$server_name.log"
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
        else
            echo "📋 Ultimi log:"
            tail -n 10 "$LOGS_DIR/$server_name.log"
>>>>>>> 9de04485 (.)
        fi
        return 1
    fi
}

# Funzione per fermare un server MCP
stop_server() {
    local server_name=$1
    local pid=$(get_pid "$server_name")
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    if [ -z "$pid" ]; then
        echo "⚠️ Il server MCP $server_name non è in esecuzione"
        return 0
    fi
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
    echo "🛑 Arresto del server MCP $server_name con PID $pid..."
    kill -9 "$pid" 2>/dev/null
    sleep 2
    
=======
=======
>>>>>>> 85c5198c (.)

    echo "🛑 Arresto del server MCP $server_name con PID $pid..."
    kill -9 "$pid" 2>/dev/null
    sleep 2

<<<<<<< HEAD
>>>>>>> 337c5266 (.)
=======
=======
=======
>>>>>>> 9de04485 (.)
    
    echo "🛑 Arresto del server MCP $server_name con PID $pid..."
    kill -9 "$pid" 2>/dev/null
    sleep 2
    
<<<<<<< HEAD
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
    pid=$(get_pid "$server_name")
    if [ -z "$pid" ]; then
        echo "✅ Server MCP $server_name arrestato"
        return 0
    else
        echo "❌ Errore nell'arresto del server MCP $server_name"
        echo "⚠️ Tentativo di arresto forzato..."
        kill -9 "$pid" 2>/dev/null
        sleep 1
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        
=======
>>>>>>> 337c5266 (.)
=======
=======
        
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
        
>>>>>>> 9de04485 (.)
        pid=$(get_pid "$server_name")
        if [ -z "$pid" ]; then
            echo "✅ Server MCP $server_name arrestato forzatamente"
            return 0
        else
            echo "❌ Impossibile arrestare il server MCP $server_name"
            return 1
        fi
    fi
}

# Funzione per mostrare lo stato di un server MCP
status_server() {
    local server_name=$1
    local pid=$(get_pid "$server_name")
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    if [ -n "$pid" ]; then
        echo "✅ Server MCP $server_name è in esecuzione con PID $pid"
        return 0
    else
        echo "❌ Server MCP $server_name non è in esecuzione"
        return 1
    fi
}

# Funzione per riavviare un server MCP
restart_server() {
    local server_name=$1
    echo "🔄 Riavvio del server MCP $server_name..."
    stop_server "$server_name"
    start_server "$server_name"
}

# Funzione per mostrare i log di un server MCP
logs_server() {
    local server_name=$1
    local log_file="$LOGS_DIR/$server_name.log"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    if [ -f "$log_file" ]; then
        echo "📋 Log del server MCP $server_name:"
        tail -n 50 "$log_file"
    else
        echo "❌ File di log per il server MCP $server_name non trovato"
        return 1
    fi
}

# Array di tutti i server MCP disponibili
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
ALL_SERVERS=("sequential-thinking" "memory" "fetch" "filesystem" "postgres" "redis" "puppeteer" "mysql")
=======
ALL_SERVERS=("mysql")
>>>>>>> 337c5266 (.)
=======
ALL_SERVERS=("mysql")
=======
ALL_SERVERS=("sequential-thinking" "memory" "fetch" "filesystem" "postgres" "redis" "puppeteer" "mysql")
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
ALL_SERVERS=("sequential-thinking" "memory" "fetch" "filesystem" "postgres" "redis" "puppeteer" "mysql")
>>>>>>> 9de04485 (.)

# Funzione per eseguire un comando su tutti i server
all_servers() {
    local command=$1
    local success=0
    local total=0
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    for server in "${ALL_SERVERS[@]}"; do
        ((total++))
        case "$command" in
            start)
                start_server "$server" && ((success++))
                ;;
            stop)
                stop_server "$server" && ((success++))
                ;;
            status)
                status_server "$server" && ((success++))
                ;;
            restart)
                restart_server "$server" && ((success++))
                ;;
            logs)
                logs_server "$server" && ((success++))
                ;;
            install)
                install_server "$server" && ((success++))
                ;;
        esac
    done
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> 337c5266 (.)
=======
=======
    
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
    
>>>>>>> 9de04485 (.)
    echo ""
    echo "📊 Riepilogo: $success/$total server MCP gestiti con successo"
}

# Controllo dei parametri
if [ $# -eq 0 ]; then
    show_help
    exit 0
fi

COMMAND=$1
SERVER=${2:-"all"}

case "$COMMAND" in
    start)
        if [ "$SERVER" = "all" ]; then
            echo "🚀 Avvio di tutti i server MCP..."
            all_servers "start"
        else
            start_server "$SERVER"
        fi
        ;;
    stop)
        if [ "$SERVER" = "all" ]; then
            echo "🛑 Arresto di tutti i server MCP..."
            all_servers "stop"
        else
            stop_server "$SERVER"
        fi
        ;;
    status)
        if [ "$SERVER" = "all" ]; then
            echo "📊 Stato di tutti i server MCP..."
            all_servers "status"
        else
            status_server "$SERVER"
        fi
        ;;
    restart)
        if [ "$SERVER" = "all" ]; then
            echo "🔄 Riavvio di tutti i server MCP..."
            all_servers "restart"
        else
            restart_server "$SERVER"
        fi
        ;;
    logs)
        if [ "$SERVER" = "all" ]; then
            echo "📋 Log di tutti i server MCP..."
            all_servers "logs"
        else
            logs_server "$SERVER"
        fi
        ;;
    install)
        if [ "$SERVER" = "all" ]; then
            echo "📦 Installazione di tutti i server MCP..."
            all_servers "install"
        else
            install_server "$SERVER"
        fi
        ;;
    help)
        show_help
        ;;
    *)
        echo "❌ Comando non riconosciuto: $COMMAND"
        show_help
        exit 1
        ;;
esac

exit 0
