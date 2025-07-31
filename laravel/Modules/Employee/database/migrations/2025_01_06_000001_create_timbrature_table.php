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
    protected string $table_name = 'timbrature';

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

        // Crea la tabella timbrature
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            // Chiave esterna verso la tabella users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Data e ora della timbratura
            $table->dateTime('data_timbratura');
            
            // Tipo di timbratura (entrata/uscita)
            $table->enum('tipo', ['entrata', 'uscita']);
            
            // Metodo di timbratura
            $table->enum('metodo', ['badge', 'pin', 'biometrico', 'app', 'web'])->default('badge');
            
            // Localizzazione (opzionale)
            $table->string('latitudine')->nullable();
            $table->string('longitudine')->nullable();
            $table->string('indirizzo')->nullable();
            
            // Note aggiuntive
            $table->text('note')->nullable();
            
            // Stato della timbratura
            $table->enum('stato', ['valida', 'corretta', 'annullata'])->default('valida');
            
            // Flag per timbrature manuali
            $table->boolean('is_manuale')->default(false);
            
            // Utente che ha creato/modificato la timbratura
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Timestamp standard
            $table->timestamps();
            
            // Indici per migliorare le performance
            $table->index(['user_id', 'data_timbratura']);
            $table->index(['data_timbratura']);
            $table->index(['tipo']);
            $table->index(['stato']);
        });

        echo 'Tabella ['.$this->table_name.'] creata con successo!';
    }
}; 