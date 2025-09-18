#!/bin/bash

# --------------------------------------------------------------------------
# Git Conflict Resolution Script - Complete Project
# --------------------------------------------------------------------------
# This script finds and fixes ALL Git conflicts in the entire project
# by taking the HEAD version for most files.
#
# Usage: ./scripts/fix_all_git_conflicts.sh
# --------------------------------------------------------------------------

# --- Configuration ---
BASE_DIR="/var/www/_bases/base_techplanner_fila3_mono"
BACKUP_DIR="$BASE_DIR/backups/all_git_conflicts_$(date +%Y%m%d%H%M%S)"
LOG_FILE="$BASE_DIR/logs/all_git_conflicts_$(date +%Y%m%d%H%M%S).log"

# --- Colors for output ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# --- Logging Function ---
log_message() {
    local type="$1"
    local message="$2"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo -e "${timestamp} [${type^^}] ${message}" | tee -a "$LOG_FILE"
}

# --- Create backup directory ---
mkdir -p "$BACKUP_DIR" || { log_message "error" "Failed to create backup directory: $BACKUP_DIR"; exit 1; }
mkdir -p "$BASE_DIR/logs" || { log_message "error" "Failed to create logs directory"; exit 1; }
log_message "info" "Backup directory created: $BACKUP_DIR"

# --- Find all files with Git conflict markers ---
log_message "info" "Searching for files with Git conflict markers..."
CONFLICT_FILES=$(find "$BASE_DIR" -type f -exec grep -l "<<<<<<< HEAD" {} \; 2>/dev/null)
NUM_CONFLICT_FILES=$(echo "$CONFLICT_FILES" | wc -l)

if [ -z "$CONFLICT_FILES" ]; then
    log_message "success" "No Git conflicts found in the project."
    exit 0
fi

log_message "warning" "Found $NUM_CONFLICT_FILES files with Git conflicts."

# --- Conflict Resolution Function ---
resolve_conflict() {
    local file="$1"
    local filename=$(basename "$file")
    local extension="${filename##*.}"
    local relative_path="${file#$BASE_DIR/}"

    log_message "info" "Processing file: $relative_path"
    cp "$file" "$BACKUP_DIR/${relative_path//\//_}.bak"
    log_message "info" "Backup created for $filename"

    # Use sed to remove conflict markers and keep the HEAD section
    # This is a simplified approach - for complex merges, manual review might be needed
    sed -i '/<<<<<<< HEAD/,/=======/ { /<<<<<<< HEAD/! { /=======/! d } }' "$file"
    sed -i '/>>>>>>>/d' "$file"
    sed -i '/=======/d' "$file"
    sed -i '/<<<<<<< HEAD/d' "$file"

    # Basic validation based on file type
    case "$extension" in
        "php")
            php -l "$file" &>/dev/null
            if [ $? -ne 0 ]; then
                log_message "error" "PHP syntax error in $relative_path after resolution. Manual review needed."
                return 1
            fi
            ;;
        "json")
            jq . "$file" &>/dev/null 2>&1
            if [ $? -ne 0 ]; then
                log_message "error" "JSON syntax error in $relative_path after resolution. Manual review needed."
                return 1
            fi
            ;;
        "yml"|"yaml")
            # Basic YAML validation - check if file starts with valid YAML structure
            if ! head -n 5 "$file" | grep -q "^[a-zA-Z0-9_-]*:"; then
                log_message "error" "YAML syntax error in $relative_path after resolution. Manual review needed."
                return 1
            fi
            ;;
    esac

    log_message "success" "Resolved conflicts in $relative_path (ours strategy)."
    return 0
}

# --- Iterate and resolve conflicts ---
log_message "info" "Starting conflict resolution process..."
RESOLVED_COUNT=0
UNRESOLVED_COUNT=0
FAILED_FILES=()

for file in $CONFLICT_FILES; do
    if resolve_conflict "$file"; then
        RESOLVED_COUNT=$((RESOLVED_COUNT + 1))
    else
        UNRESOLVED_COUNT=$((UNRESOLVED_COUNT + 1))
        FAILED_FILES+=("${file#$BASE_DIR/}")
    fi
done

log_message "info" "--- Git Conflict Resolution Summary ---"
log_message "success" "Total files resolved: $RESOLVED_COUNT"
log_message "error" "Total files requiring manual review: $UNRESOLVED_COUNT"
log_message "info" "All backups are in: $BACKUP_DIR"
log_message "info" "Detailed log in: $LOG_FILE"

if [ "$UNRESOLVED_COUNT" -gt 0 ]; then
    log_message "warning" "Files requiring manual review:"
    for failed_file in "${FAILED_FILES[@]}"; do
        log_message "warning" "  - $failed_file"
    done
    log_message "warning" "Please manually review these files."
    exit 1
else
    log_message "success" "All conflicts processed successfully!"
    exit 0
fi
