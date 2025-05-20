<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateWorkersTable.
 */
return new class() extends XotBaseMigration {

    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('appointment_id')
                    ->constrained()
                    ->cascadeOnDelete();
                $table->string('name');
                $table->string('status')->nullable();
                $table->text('notes')->nullable();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('appointment_id')) {
                    $table->integer('appointment_id')
                        ->index()
                        ->nullable();
                }
                if (! $this->hasColumn('client_id')) {
                    $table->integer('client_id')
                        ->index()
                        ->nullable();
                }
                
                //if ($table->hasForeignKey('machines', 'machines_client_id_foreign')) {
                //    $table->dropForeign('machines_client_id_foreign');
                //}
                $table->integer('client_id')
                        ->nullable()
                        ->change();
                $table->integer('appointment_id')
                        ->nullable()
                        ->change();
                if ($this->hasColumn('status')) {
                    $table->string('status')->nullable()->change();
                }
                if (!$this->hasColumn('status')) {
                    $table->string('status')->nullable();
                }
                $this->updateTimestamps($table, true);
            }
        );
    }
};
