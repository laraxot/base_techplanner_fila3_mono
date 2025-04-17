<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * CreateMedicalDirectorTable Migration
 */
return new class extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('license_number')->nullable();
            $table->string('specialization')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $this->addCommonFields($table);
        });
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $table->string('name')->nullable()->change();
                if (! $this->hasColumn('client_id')) {
                    $table->foreignId('client_id')->nullable();
                }
                if (! $this->hasColumn('last_name')) {
                    $table->string('last_name')->nullable();
                }
                if (! $this->hasColumn('first_name')) {
                    $table->string('first_name')->nullable();
                }
                if (! $this->hasColumn('residence')) {
                    $table->string('residence')->nullable();
                }
                if (! $this->hasColumn('address')) {
                    $table->string('address')->nullable();
                }
                if (! $this->hasColumn('street_number')) {
                    $table->string('street_number')->nullable();
                }
                if (! $this->hasColumn('province')) {
                    $table->string('province')->nullable();
                }
                if (! $this->hasColumn('birth_place')) {
                    $table->string('birth_place')->nullable();
                }
                if (! $this->hasColumn('birth_date')) {
                    $table->date('birth_date')->nullable();
                }
                if (! $this->hasColumn('start_date')) {
                    $table->date('start_date')->nullable();
                }
                if (! $this->hasColumn('end_date')) {
                    $table->date('end_date')->nullable();
                }

                $this->updateTimestamps($table, true);
            }
        );
    }
};
