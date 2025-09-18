<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * CreateDeviceVerificationTable Migration
 */
return new class extends XotBaseMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade');
            $table->date('verification_date')->nullable();
            $table->string('status')->nullable();
            $this->addCommonFields($table);
        });
    }
};
