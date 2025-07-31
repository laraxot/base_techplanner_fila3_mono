<?php

namespace Modules\TechPlanner\Database\Seeders;

use Carbon\Carbon;

class MdbDataExtractor
{
    protected $mdbFile;

    protected $outputFile;

    public function __construct(string $mdbFile, string $outputFile)
    {
        $this->mdbFile = $mdbFile;
        $this->outputFile = $outputFile;
    }

    public function extract(): void
    {
        // Estrai le tabelle
        $tables = $this->executeCommand("mdb-tables -1 {$this->mdbFile}");

        $sql = '-- Dump generato il '.Carbon::now()->format('Y-m-d H:i:s')."\n\n";

        foreach ($tables as $table) {
            if (strpos($table, 'MSys') === 0) {
                continue; // Salta le tabelle di sistema
            }

            $sql .= $this->processTable($table);
        }

        file_put_contents($this->outputFile, $sql);
    }

    protected function processTable(string $table): string
    {
        $sql = "-- Tabella: {$table}\n";

        // Ottieni i dati della tabella
        $data = $this->executeCommand("mdb-export {$this->mdbFile} \"{$table}\"");

        if (empty($data)) {
            return $sql."-- Nessun dato trovato\n\n";
        }

        // Converti i nomi delle colonne
        $headers = str_getcsv($data[0]);
        $columns = $this->translateColumns($headers);

        $tableName = $this->translateTableName($table);
        $sql .= "INSERT INTO {$tableName} (".implode(', ', $columns).") VALUES\n";

        // Processa ogni riga
        $values = [];
        for ($i = 1; $i < count($data); $i++) {
            $row = str_getcsv($data[$i]);
            $processedRow = $this->processRow($row, $headers);
            if ($processedRow) {
                $values[] = '('.implode(', ', $processedRow).')';
            }
        }

        $sql .= implode(",\n", $values).";\n\n";

        return $sql;
    }

    protected function translateTableName(string $table): string
    {
        $translations = [
            'Apparecchi' => 'devices',
            'VerificheApparecchi' => 'device_verifications',
            // Aggiungi altre traduzioni qui
        ];

        return $translations[$table] ?? $table;
    }

    protected function translateColumns(array $columns): array
    {
        $translations = [
            // Apparecchi -> devices
            'IdApparecchio' => 'id',
            'IdCliente' => 'client_id',
            'TipoApparecchio' => 'device_type',
            'Marca' => 'brand',
            'Modello' => 'model',
            'MatricolaTestata' => 'headset_serial',
            'MatricolaTubo' => 'tube_serial',
            'PotenzaKv' => 'power_kv',
            'CorrenteMa' => 'current_ma',
            'DataPrimaVerifica' => 'first_verification_date',
            'Note' => 'notes',

            // VerificheApparecchi -> device_verifications
            'IdVerifica' => 'id',
            'IdApparecchio' => 'device_id',
            'DataVerifica' => 'verification_date',
            'DataProssimaVerifica' => 'next_verification_date',
            'Esito' => 'result',
            'ParametriEsposizione' => 'exposure_parameters',
            'TipoVerifica' => 'verification_type',
            // Aggiungi altre traduzioni qui
        ];

        return array_map(function ($col) use ($translations) {
            return $translations[$col] ?? $col;
        }, $columns);
    }

    protected function processRow(array $row, array $headers): array
    {
        $processed = [];
        foreach ($row as $i => $value) {
            $column = $headers[$i];

            // Gestisci i valori NULL
            if ($value === '' || $value === 'NULL') {
                $processed[] = 'NULL';

                continue;
            }

            // Gestisci le date
            if (strpos($column, 'Data') === 0) {
                $date = Carbon::createFromFormat('d/m/Y', $value);
                $processed[] = "'".$date->format('Y-m-d')."'";

                continue;
            }

            // Gestisci le stringhe
            $processed[] = "'".addslashes($value)."'";
        }

        // Aggiungi i campi created_at, updated_at, created_by, updated_by
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $processed[] = "'".$now."'"; // created_at
        $processed[] = "'".$now."'"; // updated_at
        $processed[] = "'system'"; // created_by
        $processed[] = "'system'"; // updated_by

        return $processed;
    }

    protected function executeCommand(string $command): array
    {
        exec($command, $output, $returnVar);

        return $output;
    }
}
