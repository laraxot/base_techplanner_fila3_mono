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

# Export relationships
mdb-schema "$MDB_FILE" -R > "$OUTPUT_DIR/relationships.txt"

echo "Relationships analysis completed. Check $OUTPUT_DIR/relationships.txt for results."
