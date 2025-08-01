<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    /**
     * Esegue la migrazione.
     */
    public function up(): void
    {
        // Verifica se la tabella timbrature esiste
        if (!Schema::hasTable('timbrature')) {
            echo 'Tabella [timbrature] non trovata, saltando migrazione';

            return;
        }

        // Rinomina la tabella da timbrature a attendances
        Schema::rename('timbrature', 'attendances');

        // Aggiorna i nomi delle colonne
        Schema::table('attendances', function (Blueprint $table) {
            // Rinomina data_timbratura in timestamp
            $table->renameColumn('data_timbratura', 'timestamp');
            
            // Rinomina tipo in type
            $table->renameColumn('tipo', 'type');
            
            // Rinomina metodo in method
            $table->renameColumn('metodo', 'method');
            
            // Rinomina latitudine in latitude
            $table->renameColumn('latitudine', 'latitude');
            
            // Rinomina longitudine in longitude
            $table->renameColumn('longitudine', 'longitude');
            
            // Rinomina indirizzo in address
            $table->renameColumn('indirizzo', 'address');
            
            // Rinomina note in notes
            $table->renameColumn('note', 'notes');
            
            // Rinomina stato in status
            $table->renameColumn('stato', 'status');
        });

        // Aggiorna gli enum values per type
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `type` ENUM('entry', 'exit')");
        
        // Aggiorna gli enum values per method
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `method` ENUM('badge', 'pin', 'biometric', 'app', 'web') DEFAULT 'badge'");
        
        // Aggiorna gli enum values per status
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `status` ENUM('valid', 'corrected', 'cancelled') DEFAULT 'valid'");

        // Aggiorna gli indici
        Schema::table('attendances', function (Blueprint $table) {
            // Rimuovi gli indici esistenti
            $table->dropIndex(['user_id', 'timestamp']);
            $table->dropIndex(['timestamp']);
            $table->dropIndex(['type']);
            $table->dropIndex(['status']);
            
            // Ricrea gli indici con i nuovi nomi
            $table->index(['user_id', 'timestamp']);
            $table->index(['timestamp']);
            $table->index(['type']);
            $table->index(['status']);
        });

        echo 'Tabella [timbrature] rinominata in [attendances] con successo!';
    }

    /**
     * Annulla la migrazione.
     */
    public function down(): void
    {
        // Verifica se la tabella attendances esiste
        if (!Schema::hasTable('attendances')) {
            echo 'Tabella [attendances] non trovata, saltando rollback';

            return;
        }

        // Aggiorna gli enum values per type (rollback)
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `type` ENUM('entrata', 'uscita')");
        
        // Aggiorna gli enum values per method (rollback)
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `method` ENUM('badge', 'pin', 'biometrico', 'app', 'web') DEFAULT 'badge'");
        
        // Aggiorna gli enum values per status (rollback)
        DB::statement("ALTER TABLE attendances MODIFY COLUMN `status` ENUM('valida', 'corretta', 'annullata') DEFAULT 'valida'");

        // Aggiorna i nomi delle colonne (rollback)
        Schema::table('attendances', function (Blueprint $table) {
            $table->renameColumn('timestamp', 'data_timbratura');
            $table->renameColumn('type', 'tipo');
            $table->renameColumn('method', 'metodo');
            $table->renameColumn('latitude', 'latitudine');
            $table->renameColumn('longitude', 'longitudine');
            $table->renameColumn('address', 'indirizzo');
            $table->renameColumn('notes', 'note');
            $table->renameColumn('status', 'stato');
        });

        // Rinomina la tabella da attendances a timbrature
        Schema::rename('attendances', 'timbrature');

        echo 'Tabella [attendances] rinominata in [timbrature] con successo!';
    }
}; 