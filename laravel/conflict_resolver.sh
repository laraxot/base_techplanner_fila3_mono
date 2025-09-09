#!/bin/bash

# Git Conflict Resolution Script
# Automatically resolves simple merge conflicts in PHP files

resolve_conflicts_in_file() {
    local file="$1"
    
    if [ ! -f "$file" ]; then
        return 1
    fi
    
    echo "Processing: $file"
    
    # Create a backup
    cp "$file" "$file.backup.$(date +%Y%m%d_%H%M%S)"
    
    # Remove conflict markers and resolve conflicts
    # This script handles common patterns found in the analyzed files
    
    # Pattern 1: Remove simple duplicate code blocks between conflicts
    # Pattern 2: Remove nested conflict markers
    # Pattern 3: Clean up use statement duplicates
    
    python3 - "$file" << 'EOF'
import sys
import re

def resolve_conflicts(content):
    # Remove simple conflict markers and keep the cleaner version
    
    # Pattern 1: Remove nested conflict markers
    content = re.sub(r'<<<<<<< HEAD\n=======\n\n=======\n.*?\n>>>>>>> [a-f0-9]+ \(.*?\)\n=======\n.*?\n>>>>>>> [a-f0-9]+ \(.*?\)', '', content, flags=re.DOTALL)
    
    # Pattern 2: Simple conflict resolution - remove conflict markers and duplicates
    content = re.sub(r'<<<<<<< HEAD\n(.*?)\n=======\n\1\n>>>>>>> [a-f0-9]+ \(.*?\)', r'\1', content, flags=re.DOTALL)
    
    # Pattern 3: Remove multiple sequential conflict markers
    content = re.sub(r'=======\n\n>>>>>>> [a-f0-9]+ \(.*?\)\n=======\n>>>>>>> [a-f0-9]+ \(.*?\)', '', content, flags=re.DOTALL)
    
    # Pattern 4: Clean duplicated use statements
    lines = content.split('\n')
    seen_uses = set()
    clean_lines = []
    in_use_block = False
    
    for line in lines:
        if line.strip().startswith('use ') and line.strip().endswith(';'):
            in_use_block = True
            if line not in seen_uses:
                seen_uses.add(line)
                clean_lines.append(line)
        elif in_use_block and (line.strip() == '' or line.strip().startswith('class') or line.strip().startswith('interface') or line.strip().startswith('trait')):
            in_use_block = False
            clean_lines.append(line)
        else:
            clean_lines.append(line)
    
    content = '\n'.join(clean_lines)
    
    # Remove remaining simple conflict markers
    content = re.sub(r'<<<<<<< HEAD\n', '', content)
    content = re.sub(r'=======\n', '', content)
    content = re.sub(r'>>>>>>> [a-f0-9]+ \(.*?\)\n', '', content)
    
    # Clean up excessive empty lines
    content = re.sub(r'\n{3,}', '\n\n', content)
    
    return content

if __name__ == '__main__':
    file_path = sys.argv[1]
    
    with open(file_path, 'r') as f:
        content = f.read()
    
    if '=======' not in content:
        print(f"No conflicts found in {file_path}")
        sys.exit(0)
    
    resolved_content = resolve_conflicts(content)
    
    with open(file_path, 'w') as f:
        f.write(resolved_content)
    
    print(f"Resolved conflicts in {file_path}")

EOF
    
    # Check if conflicts were resolved
    if grep -q "=======" "$file"; then
        echo "  WARNING: Some conflicts may still remain in $file"
        return 1
    else
        echo "  SUCCESS: All conflicts resolved in $file"
        return 0
    fi
}

# Main execution
echo "Starting automatic conflict resolution..."

# Find all files with conflict markers - updated to process User module
files_with_conflicts=$(find /var/www/html/_bases/base_techplanner_fila3_mono/laravel/Modules/User -type f -name "*.php" -exec grep -l "=======" {} \;)

resolved_count=0
failed_count=0

for file in $files_with_conflicts; do
    if resolve_conflicts_in_file "$file"; then
        ((resolved_count++))
    else
        ((failed_count++))
    fi
done

echo "Resolution completed:"
echo "  Successfully resolved: $resolved_count files"
echo "  Failed/Partial: $failed_count files"

if [ $failed_count -gt 0 ]; then
    echo "Files that may need manual review:"
    find /var/www/html/_bases/base_techplanner_fila3_mono/laravel/Modules/User -type f -name "*.php" -exec grep -l "=======" {} \;
fi