#!/bin/bash

# Check if MDB file path is provided
if [ -z "$1" ]; then
    echo "Usage: $0 <path_to_mdb_file>"
    exit 1
fi

MDB_FILE="$1"
OUTPUT_DIR="$(dirname "$0")/../database/mdb_analysis"

# Create output directory if it doesn't exist
mkdir -p "$OUTPUT_DIR"

# Get list of tables
mdb-tables -1 "$MDB_FILE" > "$OUTPUT_DIR/tables.txt"

# For each table, export its structure
while IFS= read -r table; do
    echo "Analyzing table: $table"
    mdb-schema "$MDB_FILE" "$table" > "$OUTPUT_DIR/${table}_schema.sql"
    mdb-export -I "$MDB_FILE" "$table" > "$OUTPUT_DIR/${table}_create.sql"
    mdb-export "$MDB_FILE" "$table" > "$OUTPUT_DIR/${table}_data.csv"
done < "$OUTPUT_DIR/tables.txt"

echo "Analysis completed. Check $OUTPUT_DIR for results."
