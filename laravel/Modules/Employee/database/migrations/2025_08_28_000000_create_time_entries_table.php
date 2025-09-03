<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class() extends XotBaseMigration
{
    public function up(): void
    {
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->string('id', 36)->primary();

                $table->string('employee_id', 36);
                $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');

                $table->enum('type', [
                    'clock_in',
                    'clock_out',
                    'break_start',
                    'break_end',
                    'lunch_start',
                    'lunch_end',
                ]);

                $table->timestamp('timestamp');

                $table->decimal('location_lat', 10, 8)->nullable();
                $table->decimal('location_lng', 11, 8)->nullable();
                $table->string('location_name')->nullable();
                $table->decimal('location_accuracy', 8, 2)->nullable();

                $table->string('device_type')->nullable();
                $table->string('device_info')->nullable();
                $table->string('ip_address', 45)->nullable();

                $table->string('photo_path')->nullable();

                $table->text('notes')->nullable();

                $table->enum('status', [
                    'pending',
                    'approved',
                    'rejected',
                    'auto_approved',
                ])->default('pending');

                $table->string('approved_by', 36)->nullable();
                $table->timestamp('approved_at')->nullable();
                $table->text('approval_notes')->nullable();

                $table->json('metadata')->nullable();

                $table->softDeletes();

                $table->index(['employee_id', 'timestamp']);
                $table->index(['employee_id', 'type']);
                $table->index(['timestamp']);
                $table->index(['status']);
            }
        );
    }
};
