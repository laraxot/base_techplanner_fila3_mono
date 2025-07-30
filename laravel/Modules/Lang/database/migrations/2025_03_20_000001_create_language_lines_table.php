<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Lang\Models\Translation;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Migrazione per la creazione della tabella language_lines.
 * 
 * Questa tabella gestisce le traduzioni del sistema multilanguage,
 * memorizzando le chiavi di traduzione e i testi in formato JSON
 * per supportare multiple lingue.
 * 
 * @see docs/migration_standards.md
 */
return new class extends XotBaseMigration
{
    /**
     * Nome della tabella.
     *
     * @var string
     */
    protected string $table = 'language_lines';
    
    /**
     * Connessione al database.
     *
     * @var string
     */
    protected ?string $connection = 'mysql';

    /**
     * Classe del modello associato.
     *
     * @var string|null
     */
    protected ?string $model_class = Translation::class;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->id();
                $table->string('group')->index()->comment('Translation group (e.g., validation, auth)');
                $table->string('key')->comment('Translation key');
                $table->json('text')->comment('Translation text in JSON format');
                $table->string('locale')->index()->comment('Language locale (e.g., en, it, de)');
                $table->unique(['group', 'key', 'locale'], 'language_lines_unique');
                
                // Utilizziamo updateTimestamps per gestire created_at, updated_at e deleted_at
                $this->updateTimestamps($table, true);
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // Verifica se le colonne esistono prima di aggiungerle
                if (! $this->hasColumn('group')) {
                    $table->string('group')->index()->comment('Translation group (e.g., validation, auth)');
                }
                
                if (! $this->hasColumn('key')) {
                    $table->string('key')->comment('Translation key');
                }
                
                if (! $this->hasColumn('text')) {
                    $table->json('text')->comment('Translation text in JSON format');
                }
                
                if (! $this->hasColumn('locale')) {
                    $table->string('locale')->index()->comment('Language locale (e.g., en, it, de)');
                }
                
                // Verifica se l'indice unique esiste
                if (! $this->hasIndex('language_lines_unique')) {
                    $table->unique(['group', 'key', 'locale'], 'language_lines_unique');
                }
                
                $this->updateTimestamps($table, true);
            }
        );
    }
};
