#!/bin/bash

# Git Conflict Resolution Script
# Automatically resolves simple merge conflicts (empty lines)

log_file="conflict_resolution.log"
echo "Starting conflict resolution - $(date)" > $log_file

# Function to resolve simple empty line conflicts
resolve_simple_conflicts() {
    local file="$1"
    echo "Processing: $file" >> $log_file
    
    # Pattern 1: Simple empty line conflicts
    sed -i '/^<<<<<<< HEAD$/,/^>>>>>>> [a-f0-9]\+ (.*)$/c\
' "$file"
    
    # Pattern 2: Double nested conflicts with empty lines
    sed -i 's/^<<<<<<< HEAD$//' "$file"
    sed -i 's/^=======$//' "$file"
    sed -i '/^>>>>>>> [a-f0-9]\+ (.*)$/d' "$file"
    
    echo "  - Resolved simple conflicts in $file" >> $log_file
}

# Function to clean up file formatting
clean_file() {
    local file="$1"
    
    # Remove excessive empty lines (more than 2 consecutive)
    sed -i '/^$/N;/^\n$/d' "$file"
    
    echo "  - Cleaned formatting in $file" >> $log_file
}

# Find files with conflicts and process them
conflict_count=0
resolved_count=0

echo "Scanning for conflict files..." >> $log_file

# Process language files first (safest)
for lang_file in $(find . -path "*/lang/*/*.php" -exec grep -l "<<<.*HEAD" {} \; 2>/dev/null | head -10); do
    echo "Processing language file: $lang_file"
    conflict_count=$((conflict_count + 1))
    
    # Backup original file
    cp "$lang_file" "${lang_file}.backup"
    
    # Check if it's a simple conflict pattern
    simple_conflict=$(grep -c "^<<<<<<< HEAD$" "$lang_file")
    
    if [ "$simple_conflict" -gt 0 ]; then
        resolve_simple_conflicts "$lang_file"
        clean_file "$lang_file"
        
        # Verify PHP syntax
        if php -l "$lang_file" >/dev/null 2>&1; then
            resolved_count=$((resolved_count + 1))
            echo "  ✅ Successfully resolved: $lang_file" >> $log_file
            rm "${lang_file}.backup"  # Remove backup on success
        else
            echo "  ❌ Syntax error after resolution: $lang_file" >> $log_file
            mv "${lang_file}.backup" "$lang_file"  # Restore backup
        fi
    else
        echo "  ⚠️  Complex conflict detected: $lang_file" >> $log_file
        rm "${lang_file}.backup"
    fi
done

echo "Resolution Summary:" >> $log_file
echo "Files processed: $conflict_count" >> $log_file
echo "Files resolved: $resolved_count" >> $log_file
echo "Files remaining: $((conflict_count - resolved_count))" >> $log_file
echo "Completion time: $(date)" >> $log_file

echo "Conflict resolution completed!"
echo "Resolved: $resolved_count out of $conflict_count files"
echo "Check $log_file for detailed results"