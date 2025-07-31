<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Actions\Database;

use Symfony\Component\Process\Process;

/**
 * Class AnalyzeMdbStructureAction.
 *
 * Analyzes the structure of an Access .mdb database using mdbtools
 */
final class AnalyzeMdbStructureAction
{
    /**
     * Execute the analysis.
     *
     * @param  string  $mdbPath  Path to the .mdb file
     * @return array<string, array<string, array<string, string>>>
     */
    public function execute(string $mdbPath): array
    {
        // Get tables list
        $tables = $this->getTables($mdbPath);
        $structure = [];

        foreach ($tables as $table) {
            $structure[$table] = $this->getTableColumns($mdbPath, $table);
        }

        return $structure;
    }

    /**
     * Get list of tables from the database.
     *
     * @return array<string>
     */
    private function getTables(string $mdbPath): array
    {
        $process = new Process(['mdb-tables', $mdbPath]);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return array_filter(explode(' ', trim($process->getOutput())));
    }

    /**
     * Get columns structure for a specific table.
     *
     * @return array<string, array<string, string>>
     */
    private function getTableColumns(string $mdbPath, string $table): array
    {
        $process = new Process(['mdb-schema', $mdbPath, $table]);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $output = $process->getOutput();
        $columns = [];

        // Parse the schema output
        preg_match_all('/\s+(\w+)\s+(\w+)(?:\((\d+)\))?/', $output, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $name = $match[1];
            $type = $match[2];
            $size = $match[3] ?? null;

            $columns[$name] = [
                'type' => $type,
                'size' => $size,
                'nullable' => true, // Default to true as mdb-schema doesn't show this info
            ];
        }

        return $columns;
    }
}
