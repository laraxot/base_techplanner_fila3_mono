<?php
/**
 * Other Files Conflict Resolution Script
 * 
 * This script resolves git conflicts in other files (PHP, SVG, etc.) by:
 * - Defaulting to HEAD version for safety
 * - Logging what was chosen for manual review
 * - Creating detailed reports for complex conflicts
 */

declare(strict_types=1);

class OtherConflictResolver
{
    private string $logFile;
    private array $resolutionLog = [];
    private array $reviewFiles = [];

    public function __construct(string $logFile = 'other-conflicts-resolved.log')
    {
        $this->logFile = $logFile;
    }

    /**
     * Resolve conflicts in other files
     */
    public function resolveConflicts(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            $this->log("ERROR: File not found: $filePath");
            return false;
        }

        // Create backup
        $backupPath = $filePath . '.backup.' . date('Y-m-d_H-i-s');
        if (!copy($filePath, $backupPath)) {
            $this->log("ERROR: Could not create backup for: $filePath");
            return false;
        }

        $content = file_get_contents($filePath);
        
        if (!$this->hasConflictMarkers($content)) {
            $this->log("INFO: No conflict markers found in: $filePath");
            unlink($backupPath); // Remove backup if no conflicts
            return true;
        }

        $resolvedContent = $this->resolveOtherConflicts($content, $filePath);
        
        if ($resolvedContent !== null) {
            file_put_contents($filePath, $resolvedContent);
            $this->log("SUCCESS: Resolved conflicts in: $filePath (backup: $backupPath)");
            
            // Mark for review
            $this->reviewFiles[] = [
                'file' => $filePath,
                'reason' => 'Default HEAD resolution - manual review recommended',
                'backup' => $backupPath
            ];
            
            return true;
        } else {
            $this->log("ERROR: Could not resolve conflicts in: $filePath");
            return false;
        }
    }

    /**
     * Check if content has git conflict markers
     */
    private function hasConflictMarkers(string $content): bool
    {
        return strpos($content, '<<<<<<< HEAD') !== false ||
               strpos($content, '=======') !== false ||
               strpos($content, '>>>>>>>') !== false;
    }

    /**
     * Resolve conflicts in other file types
     */
    private function resolveOtherConflicts(string $content, string $filePath): ?string
    {
        // Simple approach: always choose HEAD for safety
        $lines = explode("\n", $content);
        $resolved = [];
        $inConflict = false;
        $inHead = false;
        
        foreach ($lines as $line) {
            if (preg_match('/^<<<<<<< HEAD/', $line)) {
                $inConflict = true;
                $inHead = true;
                continue;
            } elseif ($line === '=======') {
                $inHead = false;
                continue;
            } elseif (preg_match('/^>>>>>>> /', $line)) {
                $inConflict = false;
                $inHead = false;
                continue;
            }
            
            // If in conflict, only include HEAD content
            if (!$inConflict || $inHead) {
                $resolved[] = $line;
            }
        }
        
        $this->log("RESOLUTION: Chose HEAD version for safety in $filePath");
        return implode("\n", $resolved);
    }

    /**
     * Log resolution actions
     */
    private function log(string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        
        echo $logEntry;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }

    /**
     * Get files marked for review
     */
    public function getReviewFiles(): array
    {
        return $this->reviewFiles;
    }

    /**
     * Get resolution log
     */
    public function getResolutionLog(): array
    {
        return $this->resolutionLog;
    }
}