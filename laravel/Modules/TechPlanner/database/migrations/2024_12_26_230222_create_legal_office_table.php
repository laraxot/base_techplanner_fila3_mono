<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * CreateLegalOfficeTable Migration
 */
return new class extends XotBaseMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $this->addCommonFields($table);
        });
    }
};
