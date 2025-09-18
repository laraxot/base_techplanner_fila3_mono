<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Predict\Models\Predict;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    protected ?string $model_class = Predict::class;

    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->text('content')->nullable();
                $table->string('status')->default('draft');
                $table->timestamp('published_at')->nullable();
                $table->string('featured_image')->nullable();
                $table->float('rating')->default(0);
                $table->integer('order')->default(0);
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (!$this->hasColumn('slug')) {
                    $table->string('slug')->nullable();
                }
                
                if (!$this->hasColumn('extra')) {
                    $table->schemalessAttributes('extra');
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}; 