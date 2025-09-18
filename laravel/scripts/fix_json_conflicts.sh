#!/bin/bash

# --------------------------------------------------------------------------
# Git Conflict Resolution Script for JSON Files
# --------------------------------------------------------------------------
# This script automates the resolution of Git conflicts in JSON files
# by taking the HEAD version for most files.
#
# Usage: ./scripts/fix_json_conflicts.sh
# --------------------------------------------------------------------------

# --- Configuration ---
BASE_DIR="/var/www/_bases/base_techplanner_fila3_mono/laravel"
BACKUP_DIR="$BASE_DIR/backups/json_conflicts_$(date +%Y%m%d%H%M%S)"
LOG_FILE="$BASE_DIR/logs/json_conflicts_$(date +%Y%m%d%H%M%S).log"

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
log_message "info" "Backup directory created: $BACKUP_DIR"

# --- Find all JSON files with Git conflict markers ---
CONFLICT_FILES=$(find "$BASE_DIR/Modules" -name "*.json" -exec grep -l "<<<<<<< HEAD" {} \; 2>/dev/null)
NUM_CONFLICT_FILES=$(echo "$CONFLICT_FILES" | wc -l)

if [ -z "$CONFLICT_FILES" ]; then
    log_message "success" "No Git conflicts found in JSON files."
    exit 0
fi

log_message "warning" "Found $NUM_CONFLICT_FILES JSON files with Git conflicts."

# --- Conflict Resolution Function ---
resolve_conflict() {
    local file="$1"
    local filename=$(basename "$file")

    log_message "info" "Processing file: $file"
    cp "$file" "$BACKUP_DIR/$(basename "$file").bak"
    log_message "info" "Backup created for $filename"

    # Use sed to remove conflict markers and keep the HEAD section
    sed -i '/<<<<<<< HEAD/,/=======/ { /<<<<<<< HEAD/! { /=======/! d } }' "$file"
    sed -i '/>>>>>>>/d' "$file"
    sed -i '/=======/d' "$file"
    sed -i '/<<<<<<< HEAD/d' "$file"

    # Basic validation
    jq . "$file" &>/dev/null
    if [ $? -ne 0 ]; then
        log_message "error" "JSON syntax error in $file after resolution. Manual review needed."
        return 1
    fi
    log_message "success" "Resolved conflicts in $filename (ours strategy)."
    return 0
}

# --- Iterate and resolve conflicts ---
RESOLVED_COUNT=0
UNRESOLVED_COUNT=0
for file in $CONFLICT_FILES; do
    if resolve_conflict "$file"; then
        RESOLVED_COUNT=$((RESOLVED_COUNT + 1))
    else
        UNRESOLVED_COUNT=$((UNRESOLVED_COUNT + 1))
    fi
done

log_message "info" "--- JSON Conflict Resolution Summary ---"
log_message "success" "Total files resolved: $RESOLVED_COUNT"
log_message "error" "Total files requiring manual review: $UNRESOLVED_COUNT"
log_message "info" "All backups are in: $BACKUP_DIR"
log_message "info" "Detailed log in: $LOG_FILE"

if [ "$UNRESOLVED_COUNT" -gt 0 ]; then
    log_message "warning" "Please manually review the unresolved files."
    exit 1
else
    log_message "success" "All JSON conflicts processed."
    exit 0
fi
