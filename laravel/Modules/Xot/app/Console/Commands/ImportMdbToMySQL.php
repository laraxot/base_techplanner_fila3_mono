<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;
<<<<<<< HEAD
use RuntimeException;
use function Safe\shell_exec;

=======

use function Safe\shell_exec;

use Webmozart\Assert\Assert;

>>>>>>> 9d6070e (.)
class ImportMdbToMySQL extends Command
{
    /**
     * Il nome e la firma del comando.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $signature = 'xot:import-mdb-to-mysql';
=======
    protected $signature = 'mdb:import-mysql {mdbFile} {mysqlUser} {mysqlPassword} {mysqlDb}';
>>>>>>> 9d6070e (.)

    /**
     * La descrizione del comando.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $description = 'Importa un file .mdb in MySQL';
=======
    protected $description = 'Import MDB file to MySQL database';
>>>>>>> 9d6070e (.)

    /**
     * Esegui il comando.
     */
    public function handle(): int
    {
<<<<<<< HEAD
        $mdbFile = $this->ask('Inserisci il percorso del file .mdb');
        if (!is_string($mdbFile)) {
            throw new RuntimeException('Il percorso del file deve essere una stringa');
        }

        $mysqlDb = $this->ask('Inserisci il nome del database MySQL');
        if (!is_string($mysqlDb)) {
            throw new RuntimeException('Il nome del database deve essere una stringa');
        }

        $this->info("File .mdb: $mdbFile");
        $this->info("Database MySQL: $mysqlDb");

        $this->info('Esportando tabelle dal file .mdb...');
        $tables = $this->exportTablesToSQL($mdbFile);
        if (empty($tables)) {
            $this->error('Nessuna tabella trovata nel file .mdb');
            return Command::FAILURE;
        }

        $this->info('Importando le tabelle in MySQL...');
        $this->importTablesIntoMySQL($tables, $mysqlDb);

        $this->info('Importazione completata con successo!');
=======
        $mdbFile = (string) $this->argument('mdbFile');
        $mysqlUser = (string) $this->argument('mysqlUser');
        $mysqlPassword = (string) $this->argument('mysqlPassword');
        $mysqlDb = (string) $this->argument('mysqlDb');

        Assert::fileExists($mdbFile, "MDB file not found: {$mdbFile}");

        $this->info("Importing {$mdbFile} to MySQL database {$mysqlDb}");

        $this->createDatabase($mysqlUser, $mysqlPassword, $mysqlDb);
        $this->exportTablesToCSV($mdbFile);
        $this->createTablesInMySQL($mdbFile, $mysqlUser, $mysqlPassword, $mysqlDb);
        $this->importDataToMySQL($mdbFile, $mysqlUser, $mysqlPassword, $mysqlDb);

>>>>>>> 9d6070e (.)
        return Command::SUCCESS;
    }

    /**
<<<<<<< HEAD
     * Esporta tutte le tabelle dal file .mdb in formato SQL.
     *
     * @return array<int, string>
     */
    private function exportTablesToSQL(string $mdbFile): array
    {
        $tables = [];
        $tableList = shell_exec("mdb-tables $mdbFile");
        if (!$tableList) {
            return [];
        }

        // Esporta ogni tabella in un file SQL
=======
     * Crea il database MySQL se non esiste.
     */
    private function createDatabase(string $mysqlUser, string $mysqlPassword, string $mysqlDb): void
    {
        $command = "mysql -u $mysqlUser -p$mysqlPassword -e 'CREATE DATABASE IF NOT EXISTS $mysqlDb;'";
        shell_exec($command);
    }

    /**
     * Esporta tutte le tabelle dal file .mdb in formato CSV.
     */
    private function exportTablesToCSV(string $mdbFile): void
    {
        $tables = [];
        $tableList = shell_exec("mdb-tables $mdbFile");

        // Esporta ogni tabella in un file CSV
>>>>>>> 9d6070e (.)
        foreach (explode("\n", trim($tableList)) as $table) {
            if (empty($table)) {
                continue;
            }
<<<<<<< HEAD

            $tables[] = $table;
            $sqlFile = storage_path("app/{$table}.sql");
            shell_exec("mdb-schema $mdbFile mysql > $sqlFile");
            shell_exec("mdb-export -I mysql $mdbFile $table >> $sqlFile");
        }

        return $tables;
    }

    /**
     * Importa le tabelle in MySQL.
     *
     * @param array<int, string> $tables
     */
    private function importTablesIntoMySQL(array $tables, string $mysqlDb): void
    {
        foreach ($tables as $table) {
            $sqlFile = storage_path("app/{$table}.sql");
            $command = "mysql -u root $mysqlDb < $sqlFile";
=======
            $tables[] = $table;
            $csvFile = storage_path("app/{$table}.csv");
            shell_exec("mdb-export $mdbFile $table > $csvFile");
        }
    }

    /**
     * Crea le tabelle nel database MySQL basandosi sullo schema del file .mdb.
     */
    private function createTablesInMySQL(string $mdbFile, string $mysqlUser, string $mysqlPassword, string $mysqlDb): void
    {
        $schema = shell_exec("mdb-schema $mdbFile mysql");
        $tables = explode(";\n", $schema);

        foreach ($tables as $tableSchema) {
            if (empty($tableSchema)) {
                continue;
            }
            // Adatta le virgolette per MySQL
            $tableSchema = str_replace('`', '"', $tableSchema);
            // Crea la tabella in MySQL
            $command = "mysql -u $mysqlUser -p$mysqlPassword $mysqlDb -e \"$tableSchema;\"";
            shell_exec($command);
        }
    }

    /**
     * Importa i dati CSV nelle tabelle MySQL.
     */
    private function importDataToMySQL(string $mdbFile, string $mysqlUser, string $mysqlPassword, string $mysqlDb): void
    {
        $tables = $this->exportTablesToCSV($mdbFile);

        foreach ($tables as $table) {
            $csvFile = storage_path("app/{$table}.csv");
            $command = "mysql -u $mysqlUser -p$mysqlPassword $mysqlDb -e "
                ."\"LOAD DATA LOCAL INFILE '$csvFile' "
                ."INTO TABLE $table "
                ."FIELDS TERMINATED BY ',' "
                ."ENCLOSED BY '\"' "
                ."LINES TERMINATED BY '\\n' "
                .'IGNORE 1 LINES;"';
>>>>>>> 9d6070e (.)
            shell_exec($command);
        }
    }
}
