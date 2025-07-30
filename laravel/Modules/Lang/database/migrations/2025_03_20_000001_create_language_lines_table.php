<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Lang\Models\Translation;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration {
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
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps($table, true);
            }
        );
    }
};
