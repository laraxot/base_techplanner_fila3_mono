<?php
/**
 * Master Conflict Resolution Script
 * 
 * This script orchestrates the systematic resolution of all git conflicts by:
 * - Finding all files with conflict markers
 * - Categorizing them by type (language, documentation, other)
 * - Applying the appropriate resolution strategy
 * - Creating comprehensive reports and backups
 */

declare(strict_types=1);

require_once __DIR__ . '/resolve-language-conflicts.php';
require_once __DIR__ . '/resolve-documentation-conflicts.php';
require_once __DIR__ . '/resolve-other-conflicts.php';

class MasterConflictResolver
{
    private string $projectRoot;
    private string $logFile;
    private array $stats = [];
    private array $processedFiles = [];
    private array $failedFiles = [];

    public function __construct(string $projectRoot = null)
    {
        $this->projectRoot = $projectRoot ?? getcwd();
        $this->logFile = $this->projectRoot . '/conflict-resolution-master.log';
        
        $this->initializeStats();
    }

    /**
     * Initialize statistics tracking
     */
    private function initializeStats(): void
    {
        $this->stats = [
            'total_files' => 0,
            'language_files' => 0,
            'documentation_files' => 0,
            'other_files' => 0,
            'processed_successfully' => 0,
            'failed_processing' => 0,
            'conflicts_resolved' => 0,
            'files_for_review' => 0,
            'start_time' => time(),
            'end_time' => null
        ];
    }

    /**
     * Main execution method
     */
    public function resolveAllConflicts(bool $dryRun = false): array
    {
        $this->log("=== MASTER CONFLICT RESOLVER STARTED ===");
        $this->log("Project root: " . $this->projectRoot);
        $this->log("Dry run mode: " . ($dryRun ? 'YES' : 'NO'));

        // Find all files with conflicts
        $conflictFiles = $this->findConflictFiles();
        $this->stats['total_files'] = count($conflictFiles);
        
        $this->log("Found " . count($conflictFiles) . " files with conflict markers");

        if (empty($conflictFiles)) {
            $this->log("No conflict files found. Nothing to do.");
            return $this->generateFinalReport();
        }

        // Categorize files
        $categorizedFiles = $this->categorizeFiles($conflictFiles);
        
        $this->log("Categorized files:");
        $this->log("  Language files: " . count($categorizedFiles['language']));
        $this->log("  Documentation files: " . count($categorizedFiles['documentation']));
        $this->log("  Other files: " . count($categorizedFiles['other']));

        if ($dryRun) {
            $this->log("=== DRY RUN - NO FILES WILL BE MODIFIED ===");
            $this->logFileCategories($categorizedFiles);
            return $this->generateFinalReport();
        }

        // Process each category
        $this->processLanguageFiles($categorizedFiles['language']);
        $this->processDocumentationFiles($categorizedFiles['documentation']);
        $this->processOtherFiles($categorizedFiles['other']);

        $this->stats['end_time'] = time();
        return $this->generateFinalReport();
    }

    /**
     * Find all files with conflict markers
     */
    private function findConflictFiles(): array
    {
        $this->log("Searching for files with conflict markers...");
        
        $conflictFiles = [];
        
        // Use ripgrep for better performance
        $command = "rg -l '<<<<<<< HEAD' " . escapeshellarg($this->projectRoot) . " --type php --type markdown 2>/dev/null || find " . escapeshellarg($this->projectRoot) . " -name '*.php' -o -name '*.md' -o -name '*.svg' -o -name '*.json' -o -name '*.blade.php' -type f -exec grep -l '<<<<<<< HEAD' {} \\; 2>/dev/null";
        $output = shell_exec($command);
        
        if ($output) {
            $files = array_filter(explode("\n", trim($output)));
            $conflictFiles = array_merge($conflictFiles, $files);
        }

        return array_unique($conflictFiles);
    }

    /**
     * Categorize files by type
     */
    private function categorizeFiles(array $files): array
    {
        $categories = [
            'language' => [],
            'documentation' => [],
            'other' => []
        ];

        foreach ($files as $file) {
            $category = $this->determineFileCategory($file);
            $categories[$category][] = $file;
        }

        $this->stats['language_files'] = count($categories['language']);
        $this->stats['documentation_files'] = count($categories['documentation']);
        $this->stats['other_files'] = count($categories['other']);

        return $categories;
    }

    /**
     * Determine file category based on path and extension
     */
    private function determineFileCategory(string $filePath): string
    {
        $pathLower = strtolower($filePath);
        
        // Check for language files
        if (preg_match('/\/lang\/|\/resources\/lang\/|\/translations\//', $pathLower) && 
            pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
            return 'language';
        }

        // Check for documentation files
        if (pathinfo($filePath, PATHINFO_EXTENSION) === 'md') {
            return 'documentation';
        }

        // Everything else
        return 'other';
    }

    /**
     * Process language files
     */
    private function processLanguageFiles(array $files): void
    {
        if (empty($files)) {
            return;
        }

        $this->log("\n=== PROCESSING LANGUAGE FILES ===");
        $resolver = new LanguageConflictResolver();

        foreach ($files as $file) {
            $this->log("Processing language file: " . basename($file));
            
            if ($resolver->resolveConflicts($file)) {
                $this->processedFiles[] = $file;
                $this->stats['processed_successfully']++;
            } else {
                $this->failedFiles[] = $file;
                $this->stats['failed_processing']++;
            }
        }
    }

    /**
     * Process documentation files
     */
    private function processDocumentationFiles(array $files): void
    {
        if (empty($files)) {
            return;
        }

        $this->log("\n=== PROCESSING DOCUMENTATION FILES ===");
        $resolver = new DocumentationConflictResolver();

        foreach ($files as $file) {
            $this->log("Processing documentation file: " . basename($file));
            
            if ($resolver->resolveConflicts($file)) {
                $this->processedFiles[] = $file;
                $this->stats['processed_successfully']++;
            } else {
                $this->failedFiles[] = $file;
                $this->stats['failed_processing']++;
            }
        }
    }

    /**
     * Process other files
     */
    private function processOtherFiles(array $files): void
    {
        if (empty($files)) {
            return;
        }

        $this->log("\n=== PROCESSING OTHER FILES ===");
        $resolver = new OtherConflictResolver();

        foreach ($files as $file) {
            $this->log("Processing other file: " . basename($file));
            
            if ($resolver->resolveConflicts($file)) {
                $this->processedFiles[] = $file;
                $this->stats['processed_successfully']++;
                
                // Count files marked for review
                $reviewFiles = $resolver->getReviewFiles();
                foreach ($reviewFiles as $reviewFile) {
                    if ($reviewFile['file'] === $file) {
                        $this->stats['files_for_review']++;
                        break;
                    }
                }
            } else {
                $this->failedFiles[] = $file;
                $this->stats['failed_processing']++;
            }
        }
    }

    /**
     * Log file categories (for dry run)
     */
    private function logFileCategories(array $categorizedFiles): void
    {
        foreach ($categorizedFiles as $category => $files) {
            if (!empty($files)) {
                $this->log("\n$category files:");
                foreach ($files as $file) {
                    $relativePath = str_replace($this->projectRoot . '/', '', $file);
                    $this->log("  - $relativePath");
                }
            }
        }
    }

    /**
     * Generate final report
     */
    private function generateFinalReport(): array
    {
        $duration = $this->stats['end_time'] ? ($this->stats['end_time'] - $this->stats['start_time']) : 0;
        
        $this->log("\n=== FINAL REPORT ===");
        $this->log("Execution time: {$duration} seconds");
        $this->log("Total files found: {$this->stats['total_files']}");
        $this->log("  - Language files: {$this->stats['language_files']}");
        $this->log("  - Documentation files: {$this->stats['documentation_files']}");
        $this->log("  - Other files: {$this->stats['other_files']}");
        $this->log("Successfully processed: {$this->stats['processed_successfully']}");
        $this->log("Failed processing: {$this->stats['failed_processing']}");
        $this->log("Files for manual review: {$this->stats['files_for_review']}");

        if (!empty($this->failedFiles)) {
            $this->log("\nFAILED FILES:");
            foreach ($this->failedFiles as $file) {
                $relativePath = str_replace($this->projectRoot . '/', '', $file);
                $this->log("  - $relativePath");
            }
        }

        // Create summary report file
        $this->generateSummaryReport();

        return [
            'stats' => $this->stats,
            'processed_files' => $this->processedFiles,
            'failed_files' => $this->failedFiles
        ];
    }

    /**
     * Generate summary report file
     */
    private function generateSummaryReport(): void
    {
        $reportFile = $this->projectRoot . '/conflict-resolution-summary-' . date('Y-m-d_H-i-s') . '.md';
        
        $report = "# Git Conflict Resolution Summary\n\n";
        $report .= "**Date:** " . date('Y-m-d H:i:s') . "\n";
        $report .= "**Duration:** " . ($this->stats['end_time'] - $this->stats['start_time']) . " seconds\n\n";
        
        $report .= "## Statistics\n\n";
        $report .= "| Category | Count |\n";
        $report .= "|----------|-------|\n";
        $report .= "| Total files found | {$this->stats['total_files']} |\n";
        $report .= "| Language files | {$this->stats['language_files']} |\n";
        $report .= "| Documentation files | {$this->stats['documentation_files']} |\n";
        $report .= "| Other files | {$this->stats['other_files']} |\n";
        $report .= "| Successfully processed | {$this->stats['processed_successfully']} |\n";
        $report .= "| Failed processing | {$this->stats['failed_processing']} |\n";
        $report .= "| Files for manual review | {$this->stats['files_for_review']} |\n\n";

        if (!empty($this->processedFiles)) {
            $report .= "## Successfully Processed Files\n\n";
            foreach ($this->processedFiles as $file) {
                $relativePath = str_replace($this->projectRoot . '/', '', $file);
                $report .= "- `$relativePath`\n";
            }
            $report .= "\n";
        }

        if (!empty($this->failedFiles)) {
            $report .= "## Failed Files (Require Manual Intervention)\n\n";
            foreach ($this->failedFiles as $file) {
                $relativePath = str_replace($this->projectRoot . '/', '', $file);
                $report .= "- `$relativePath`\n";
            }
            $report .= "\n";
        }

        $report .= "## Next Steps\n\n";
        $report .= "1. Review the individual log files for detailed information\n";
        $report .= "2. Check backup files (*.backup.*) if you need to revert changes\n";
        $report .= "3. Manually review files marked for review\n";
        $report .= "4. Test the application to ensure everything works correctly\n";
        $report .= "5. Commit the resolved files when satisfied\n\n";
        
        $report .= "## Log Files Generated\n\n";
        $report .= "- Master log: `conflict-resolution-master.log`\n";
        $report .= "- Language conflicts: `language-conflicts-resolved.log`\n";
        $report .= "- Documentation conflicts: `documentation-conflicts-resolved.log`\n";
        $report .= "- Other conflicts: `other-conflicts-resolved.log`\n";

        file_put_contents($reportFile, $report);
        $this->log("Summary report generated: $reportFile");
    }

    /**
     * Log a message
     */
    private function log(string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        
        echo $message . "\n";
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }

    /**
     * Get processing statistics
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}

// CLI usage
if (isset($argc)) {
    $dryRun = in_array('--dry-run', $argv) || in_array('-d', $argv);
    $help = in_array('--help', $argv) || in_array('-h', $argv);
    
    if ($help) {
        echo "Git Conflict Resolution Master Script\n\n";
        echo "Usage: php master-conflict-resolver.php [options]\n\n";
        echo "Options:\n";
        echo "  --dry-run, -d    Show what would be processed without making changes\n";
        echo "  --help, -h       Show this help message\n\n";
        echo "This script will:\n";
        echo "1. Find all files with git conflict markers\n";
        echo "2. Categorize them by type (language, documentation, other)\n";
        echo "3. Apply appropriate resolution strategies\n";
        echo "4. Create backups and detailed reports\n\n";
        exit(0);
    }
    
    $resolver = new MasterConflictResolver();
    $results = $resolver->resolveAllConflicts($dryRun);
    
    echo "\n=== EXECUTION COMPLETE ===\n";
    echo "Check the summary report and log files for details.\n";
    
    if ($dryRun) {
        echo "This was a dry run - no files were modified.\n";
        echo "Run without --dry-run to actually resolve conflicts.\n";
    } else {
        echo "Files have been processed and backups created.\n";
        echo "Please review the results before committing changes.\n";
    }
}