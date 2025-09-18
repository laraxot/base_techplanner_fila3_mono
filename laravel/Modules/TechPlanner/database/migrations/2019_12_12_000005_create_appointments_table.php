<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateWorkersTable.
 */
return new class extends XotBaseMigration {
    /**
     * db up.
     *
     * @return void
     */
    public function up()
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->datetime('date');
            $table->text('notes')->nullable();
        });

        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            if ($this->hasColumn('date')) {
                $table->datetime('date')->change();
            }
            $this->updateTimestamps($table, true);
        });
    }
};
