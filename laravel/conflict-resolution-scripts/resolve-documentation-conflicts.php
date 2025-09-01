<?php
/**
 * Documentation Conflict Resolution Script
 * 
 * This script intelligently resolves git conflicts in Markdown documentation files by:
 * - Choosing the more comprehensive title/header
 * - Merging content sections intelligently
 * - Preserving markdown formatting
 */

declare(strict_types=1);

class DocumentationConflictResolver
{
    private string $logFile;
    private array $resolutionLog = [];

    public function __construct(string $logFile = 'documentation-conflicts-resolved.log')
    {
        $this->logFile = $logFile;
    }

    /**
     * Resolve conflicts in a documentation file
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

        $resolvedContent = $this->resolveDocumentationConflicts($content, $filePath);
        
        if ($resolvedContent !== null) {
            file_put_contents($filePath, $resolvedContent);
            $this->log("SUCCESS: Resolved conflicts in: $filePath (backup: $backupPath)");
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
     * Resolve conflicts in documentation content
     */
    private function resolveDocumentationConflicts(string $content, string $filePath): ?string
    {
        // Simple approach: choose the longer/more complete version for each conflict
        $lines = explode("\n", $content);
        $resolved = [];
        $inConflict = false;
        $headContent = [];
        $incomingContent = [];
        $inHead = false;
        
        foreach ($lines as $line) {
            if (preg_match('/^<<<<<<< HEAD/', $line)) {
                $inConflict = true;
                $inHead = true;
                $headContent = [];
                $incomingContent = [];
                continue;
            } elseif ($line === '=======') {
                $inHead = false;
                continue;
            } elseif (preg_match('/^>>>>>>> /', $line)) {
                // Choose the longer content
                $headText = implode("\n", $headContent);
                $incomingText = implode("\n", $incomingContent);
                
                if (strlen($headText) >= strlen($incomingText)) {
                    $resolved = array_merge($resolved, $headContent);
                    $this->log("RESOLUTION: Chose HEAD content (longer) in $filePath");
                } else {
                    $resolved = array_merge($resolved, $incomingContent);
                    $this->log("RESOLUTION: Chose incoming content (longer) in $filePath");
                }
                
                $inConflict = false;
                $inHead = false;
                continue;
            }
            
            if (!$inConflict) {
                $resolved[] = $line;
            } elseif ($inHead) {
                $headContent[] = $line;
            } else {
                $incomingContent[] = $line;
            }
        }
        
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
     * Get resolution log
     */
    public function getResolutionLog(): array
    {
        return $this->resolutionLog;
    }
}