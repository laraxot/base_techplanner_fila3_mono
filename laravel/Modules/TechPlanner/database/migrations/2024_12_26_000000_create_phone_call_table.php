<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    public function up(): void
    {
        $this->tableCreate(
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');  // Relazione con Client
                $table->datetime('date');
                $table->integer('duration')->nullable();  // Durata in secondi
                $table->text('notes')->nullable();
                $table->enum('call_type', ['inbound', 'outbound']);
                $this->addCommonFields($table);
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
