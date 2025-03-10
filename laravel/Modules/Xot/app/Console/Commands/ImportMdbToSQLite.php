<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;

use function Safe\shell_exec;

class ImportMdbToSQLite extends Command
{
    /**
     * Il nome e la firma del comando.
     *
     * @var string
     */
    protected $signature = 'xot:import-mdb-to-sqlite';

    /**
     * La descrizione del comando.
     *
     * @var string
     */
    protected $description = 'Importa un file .mdb in SQLite con un processo passo-passo';

    /**
     * Esegui il comando.
     *
     * @return void
     */
    public function handle()
    {
        // Chiedi il percorso del file .mdb
        $mdbFile = $this->ask('Per favore, inserisci il percorso del file .mdb');

        // Chiedi il nome del file SQLite
        $sqliteDb = $this->ask('Per favore, inserisci il nome del database SQLite (includi l\'estensione .sqlite)');

        // Mostra i parametri ricevuti (opzionale, per verificare)
        $this->info("File .mdb: $mdbFile");
        $this->info("Database SQLite: $sqliteDb");

        // Esporta le tabelle dal file .mdb
        $this->info('Esportando tabelle dal file .mdb in CSV...');
        $tables = $this->exportTablesToCSV($mdbFile);

        // Crea le tabelle SQLite
        $this->info('Creando tabelle nel database SQLite...');
        $this->createTablesInSQLite($mdbFile, $sqliteDb);

        // Carica i dati CSV nelle tabelle SQLite
        $this->info('Importando i dati CSV nelle tabelle SQLite...');
        $this->importDataToSQLite($tables, $sqliteDb);

        $this->info('Processo completato!');
    }

    /**
     * Esporta tutte le tabelle dal file .mdb in formato CSV.
     *
     * @param string $mdbFile
     *
     * @return array
     */
    private function exportTablesToCSV($mdbFile)
    {
        $tables = [];
        $tableList = shell_exec("mdb-tables $mdbFile");

        // Esporta ogni tabella in un file CSV
        foreach (explode("\n", trim($tableList)) as $table) {
            if (empty($table)) {
                continue;
            }
            $tables[] = $table;
            $csvFile = storage_path("app/{$table}.csv");
            shell_exec("mdb-export $mdbFile $table > $csvFile");
        }

        return $tables;
    }

    /**
     * Crea le tabelle nel database SQLite basandosi sullo schema del file .mdb.
     *
     * @param string $mdbFile
     * @param string $sqliteDb
     */
    private function createTablesInSQLite($mdbFile, $sqliteDb)
    {
        $schema = shell_exec("mdb-schema $mdbFile sqlite");
        $tables = explode(";\n", $schema);

        foreach ($tables as $tableSchema) {
            if (empty($tableSchema)) {
                continue;
            }
            // Adatta le virgolette per SQLite
            $tableSchema = str_replace('`', '"', $tableSchema);

            // Crea la tabella in SQLite
            $command = "sqlite3 $sqliteDb \"$tableSchema;\"";
            shell_exec($command);
        }
    }

    /**
     * Importa i dati CSV nelle tabelle SQLite.
     *
     * @param array  $tables
     * @param string $sqliteDb
     */
    private function importDataToSQLite($tables, $sqliteDb)
    {
        foreach ($tables as $table) {
            $csvFile = storage_path("app/{$table}.csv");
            $command = "sqlite3 $sqliteDb \".mode csv\" \".import $csvFile $table\"";
            shell_exec($command);
        }
    }
}
