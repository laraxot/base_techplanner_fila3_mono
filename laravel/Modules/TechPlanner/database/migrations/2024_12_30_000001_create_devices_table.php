<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('device_type')->nullable()->index();
            $table->string('brand')->nullable()->index();
            $table->string('model')->nullable()->index();
            $table->string('headset_serial')->nullable()->index();
            $table->string('tube_serial')->nullable()->index();
            $table->string('power_kv')->nullable();
            $table->string('current_ma')->nullable();
            $table->date('first_verification_date')->nullable()->index();
            $table->text('notes')->nullable();

        });

        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
