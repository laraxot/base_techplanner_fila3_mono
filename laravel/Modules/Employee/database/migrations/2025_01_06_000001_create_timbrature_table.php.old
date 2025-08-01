<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    /**
     * Nome della tabella.
     */
    protected string $table_name = 'attendances';

    /**
     * Esegue la migrazione.
     */
    public function up(): void
    {
        // Verifica se la tabella esiste già
        if ($this->hasTable($this->table_name)) {
            echo 'Tabella ['.$this->table_name.'] già esistente';

            return;
        }

        // Crea la tabella attendances
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            // Chiave esterna verso la tabella users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Data e ora della presenza
            $table->dateTime('timestamp');
            
            // Tipo di presenza (entry/exit)
            $table->enum('type', ['entry', 'exit']);
            
            // Metodo di registrazione
            $table->enum('method', ['badge', 'pin', 'biometric', 'app', 'web'])->default('badge');
            
            // Localizzazione (opzionale)
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            
            // Note aggiuntive
            $table->text('notes')->nullable();
            
            // Stato della presenza
            $table->enum('status', ['valid', 'corrected', 'cancelled'])->default('valid');
            
            // Flag per registrazioni manuali
            $table->boolean('is_manual')->default(false);
            
            // Utente che ha creato/modificato la presenza
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Timestamp standard
            $table->timestamps();
            
            // Indici per migliorare le performance
            $table->index(['user_id', 'timestamp']);
            $table->index(['timestamp']);
            $table->index(['type']);
            $table->index(['status']);
        });

        echo 'Tabella ['.$this->table_name.'] creata con successo!';
    }
}; 