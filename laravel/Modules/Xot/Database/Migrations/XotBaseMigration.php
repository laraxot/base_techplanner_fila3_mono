<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Webmozart\Assert\Assert;

/**
 * Classe base per le migrazioni.
 */
abstract class XotBaseMigration extends Migration
{
    /**
     * Nome della tabella.
     *
     * @var string
     */
    protected string $table = '';

    /**
     * Connessione al database.
     *
     * @var string|null
     */
    protected $connection = null;

    /**
     * Run the migrations.
     */
    abstract public function up(): void;

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connection = $this->getConnection();
        Schema::connection($connection)->dropIfExists($this->table);
    }

    /**
     * Ottiene la connessione al database.
     *
     * @return string
     */
    public function getConnection()
    {
        return $this->connection ?? config('database.default');
    }

    /**
     * Crea la tabella se non esiste.
     *
     * @param callable $callback
     * @return void
     */
    protected function tableCreate(callable $callback): void
    {
        $connection = $this->getConnection();

        if (Schema::connection($connection)->hasTable($this->table)) {
            $this->outputWarning("Table [{$this->table}] already exists on connection [{$connection}]");
            return;
        }

        Schema::connection($connection)->create($this->table, $callback);
        $this->outputSuccess("Table [{$this->table}] created successfully on connection [{$connection}]");
    }

    /**
     * Aggiorna la tabella se esiste.
     *
     * @param callable $callback
     * @return void
     */
    protected function tableUpdate(callable $callback): void
    {
        $connection = $this->getConnection();

        if (!Schema::connection($connection)->hasTable($this->table)) {
            $this->outputWarning("Table [{$this->table}] does not exist on connection [{$connection}]");

            // Verifica se la tabella esiste in altre connessioni
            $connections = config('database.connections');
            foreach ($connections as $connName => $connConfig) {
                if ($connName === $connection) {
                    continue;
                }

                try {
                    if (Schema::connection($connName)->hasTable($this->table)) {
                        $this->outputError("Table [{$this->table}] exists on connection [{$connName}], but not on [{$connection}]");
                        $this->outputError("Check if the model is using the correct connection");
                        break;
                    }
                } catch (\Exception $e) {
                    // Ignora errori di connessione
                }
            }

            return;
        }

        Schema::connection($connection)->table($this->table, $callback);
        $this->outputSuccess("Table [{$this->table}] updated successfully on connection [{$connection}]");
    }

    /**
     * Aggiunge i timestamp alla tabella.
     *
     * @param Blueprint $table
     * @param bool $softDeletes
     * @return void
     */
    protected function updateTimestamps(Blueprint $table, bool $softDeletes = false): void
    {
        $table->timestamps();

        if ($softDeletes) {
            $table->softDeletes();
        }
    }

    /**
     * Verifica se una colonna esiste nella tabella.
     *
     * @param string $column
     * @return bool
     */
    protected function hasColumn(string $column): bool
    {
        $connection = $this->getConnection();
        return Schema::connection($connection)->hasColumn($this->table, $column);
    }

    /**
     * Verifica se un indice esiste nella tabella.
     *
     * @param string $index
     * @return bool
     */
    protected function hasIndex(string $index): bool
    {
        $connection = $this->getConnection();

        $indexes = DB::connection($connection)
            ->select("SHOW INDEX FROM {$this->table} WHERE Key_name = '{$index}'");

        return count($indexes) > 0;
    }

    /**
     * Output di un messaggio di successo.
     *
     * @param string $message
     * @return void
     */
    protected function outputSuccess(string $message): void
    {
        if (app()->runningInConsole()) {
            $this->write("<info>{$message}</info>");
        }
    }

    /**
     * Output di un messaggio di avviso.
     *
     * @param string $message
     * @return void
     */
    protected function outputWarning(string $message): void
    {
        if (app()->runningInConsole()) {
            $this->write("<comment>{$message}</comment>");
        }
    }

    /**
     * Output di un messaggio di errore.
     *
     * @param string $message
     * @return void
     */
    protected function outputError(string $message): void
    {
        if (app()->runningInConsole()) {
            $this->write("<error>{$message}</error>");
        }
    }

    /**
     * Scrive un messaggio nella console.
     *
     * @param string $message
     * @return void
     */
    protected function write(string $message): void
    {
        $output = app()->make(\Symfony\Component\Console\Output\OutputInterface::class);
        $output->writeln($message);
    }
}
