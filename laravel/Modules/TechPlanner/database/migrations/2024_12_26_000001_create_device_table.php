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
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('model')->nullable();
                $table->string('serial_number')->nullable();
                $table->string('inventory_number')->nullable();
                $table->date('purchase_date')->nullable();
                $table->date('warranty_expiration')->nullable();
                $table->text('notes')->nullable();
                $this->addCommonFields($table);
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $table->string('name')->nullable()->change();
                if (! $this->hasColumn('type')) {
                    $table->string('type')->nullable();
                }
                if (! $this->hasColumn('brand')) {
                    $table->string('brand')->nullable();
                }
                if (! $this->hasColumn('model')) {
                    $table->string('model')->nullable();
                }
                if (! $this->hasColumn('headset_serial')) {
                    $table->string('headset_serial')->nullable();
                }
                if (! $this->hasColumn('tube_serial')) {
                    $table->string('tube_serial')->nullable();
                }
                if (! $this->hasColumn('kv')) {
                    $table->decimal('kv', 5, 2)->nullable();
                }
                if (! $this->hasColumn('ma')) {
                    $table->decimal('ma', 5, 2)->nullable();
                }
                if (! $this->hasColumn('serial_number')) {
                    $table->string('serial_number')->nullable();
                }
                if (! $this->hasColumn('inventory_number')) {
                    $table->string('inventory_number')->nullable();
                }
                if (! $this->hasColumn('purchase_date')) {
                    $table->date('purchase_date')->nullable();
                }
                if (! $this->hasColumn('first_verification_date')) {
                    $table->date('first_verification_date')->nullable();
                }
                if (! $this->hasColumn('warranty_expiration')) {
                    $table->date('warranty_expiration')->nullable();
                }
                if (! $this->hasColumn('notes')) {
                    $table->text('notes')->nullable();
                }
                // $this->updateCommonFields($table);
                $this->updateTimestamps($table, true);
            }
        );
    }
};
