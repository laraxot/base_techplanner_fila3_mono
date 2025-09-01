# Git Conflict Resolution System

This system provides intelligent, automated resolution of git conflict markers across your codebase. It handles over 200 files with conflicts by applying different strategies based on file type.

## 🚀 Quick Start

```bash
# Make scripts executable
chmod +x *.php

# Run a dry run first to see what would be processed
php master-conflict-resolver.php --dry-run

# Execute the conflict resolution
php master-conflict-resolver.php
```

## 📁 Scripts Overview

### 1. `master-conflict-resolver.php` - Main Orchestrator
- **Purpose**: Coordinates the entire conflict resolution process
- **Features**:
  - Finds all files with conflict markers
  - Categorizes files by type (language, documentation, other)
  - Applies appropriate resolution strategies
  - Generates comprehensive reports
  - Creates backups before modifications

**Usage:**
```bash
php master-conflict-resolver.php [--dry-run] [--help]
```

### 2. `resolve-language-conflicts.php` - Language File Handler
- **Purpose**: Intelligently resolves conflicts in PHP language/translation files
- **Strategy**:
  - Keeps both versions when they have different keys
  - Chooses the more complete version when keys are identical
  - Preserves proper PHP array syntax
  - Merges arrays recursively

**Features:**
- Smart PHP array parsing and merging
- Preserves language key uniqueness
- Detailed logging of merge decisions

### 3. `resolve-documentation-conflicts.php` - Documentation Handler
- **Purpose**: Resolves conflicts in Markdown documentation files
- **Strategy**:
  - Chooses more comprehensive titles/headers
  - Merges list content intelligently
  - Preserves markdown formatting
  - Handles code blocks appropriately

**Features:**
- Header level analysis
- List item deduplication
- Content similarity detection
- Safe merging of different content sections

### 4. `resolve-other-conflicts.php` - General File Handler
- **Purpose**: Handles PHP, SVG, JSON, Blade, and other file types
- **Strategy**:
  - Defaults to HEAD version for safety
  - Performs syntax validation where possible
  - Creates detailed review reports
  - Marks complex conflicts for manual review

**Features:**
- File type-specific resolution logic
- PHP syntax validation
- JSON validity checking
- Comprehensive reporting for manual review

## 🔧 Resolution Strategies by File Type

### Language Files (`*/lang/*.php`, `*/resources/lang/*.php`)
1. **Array Merging**: Combines unique keys from both versions
2. **Value Selection**: For duplicate keys, chooses the more complete value
3. **Syntax Preservation**: Maintains proper PHP array formatting
4. **Recursive Merging**: Handles nested arrays appropriately

### Documentation Files (`*.md`)
1. **Header Priority**: Lower level headers (more important) take precedence
2. **List Merging**: Combines and deduplicates list items
3. **Content Analysis**: Uses similarity detection to choose best version
4. **Safe Merging**: Combines different content when appropriate

### Other Files (`*.php`, `*.svg`, `*.json`, `*.blade.php`, etc.)
1. **Safety First**: Defaults to HEAD version to avoid breaking changes
2. **Syntax Validation**: Validates PHP and JSON syntax when possible
3. **Element Analysis**: For SVG, chooses version with more drawing elements
4. **Review Marking**: Flags complex conflicts for manual inspection

## 📊 Logging and Reporting

### Log Files Generated:
- `conflict-resolution-master.log` - Overall process log
- `language-conflicts-resolved.log` - Language file resolution details
- `documentation-conflicts-resolved.log` - Documentation resolution details  
- `other-conflicts-resolved.log` - Other file resolution details

### Reports Generated:
- `conflict-resolution-summary-TIMESTAMP.md` - Comprehensive summary report
- `conflict-resolution-report-FILENAME-TIMESTAMP.txt` - Per-file detailed reports

### Backups Created:
- Every modified file gets a backup: `filename.backup.YYYY-MM-DD_HH-MM-SS`
- Backups are automatically removed if no conflicts were found

## 🔍 What Gets Logged:

### For Each Conflict Resolution:
- File path and line number
- Resolution strategy used
- Reason for choice (e.g., "longer content", "valid syntax", "more elements")
- For language files: detailed merge information
- For other files: syntax validation results

### Summary Statistics:
- Total files processed by category
- Success/failure counts
- Files marked for manual review
- Processing duration

## ⚠️ Safety Features

### Backups
- Automatic backup creation before any modification
- Timestamped backup files for easy identification
- Backups only kept if conflicts were actually resolved

### Dry Run Mode
- Test the system without making any changes
- See exactly what files would be processed
- Review categorization and resolution strategy

### Manual Review Marking
- Complex conflicts are flagged for human review
- Detailed reports explain why manual review is needed
- Review reports include both versions of conflicted content

### Validation
- PHP syntax checking for PHP files
- JSON validity checking for JSON files
- SVG structure analysis for SVG files

## 🎯 Use Cases

## 📋 Execution Plan

### Phase 1: Preparation
1. Make scripts executable: `chmod +x *.php`
2. Run dry run to analyze conflicts: `php master-conflict-resolver.php --dry-run`
3. Review the dry run output and file categorization

### Phase 2: Execution
1. Execute resolution: `php master-conflict-resolver.php`
2. Monitor the console output for real-time progress
3. Review the generated summary report

### Phase 3: Validation
1. Check files marked for manual review
2. Test application functionality
3. Review backup files if needed
4. Commit resolved files when satisfied

### Phase 4: Cleanup (Optional)
1. Remove backup files after successful testing
2. Archive log files for future reference
3. Document any manual changes made

## 🚨 Important Notes

- **Always run with --dry-run first** to understand what will be changed
- **Test your application** after running the conflict resolution
- **Review files marked for manual review** before committing
- **Keep backups** until you're certain everything works correctly
- **Commit in phases** if you have many files to make rollback easier

## 🆘 Troubleshooting

### If a script fails:
1. Check the specific log file for error details
2. Verify file permissions and disk space
3. Look for syntax errors in the conflict blocks
4. Use backups to restore if needed

### If results are unexpected:
1. Review the detailed per-file reports
2. Check the specific resolution strategy used
3. Use backups to restore and try manual resolution
4. Adjust the scripts if needed for your specific patterns

### For complex cases:
1. Use the individual resolution scripts directly
2. Modify the resolution strategies in the scripts
3. Process files in smaller batches
4. Combine automated and manual resolution

## 🔧 Customization

The scripts are designed to be modifiable. You can:
- Adjust resolution priorities in each specialized script
- Add new file type handlers
- Modify the categorization logic
- Extend the reporting functionality
- Add additional validation rules

Each script is well-documented and modular for easy customization.