<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    /**
     * Table name following Laraxot philosophy.
     */
    protected string $table_name = 'time_entries';

    /**
     * Run the migration following Employee module naming standards.
     */
    public function up(): void
    {
        // Check if table already exists
        if ($this->hasTable($this->table_name)) {
            return;
        }

        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();

                $table->foreignId('employee_id')
                    ->constrained('employees')
                    ->onDelete('cascade')
                    ->comment('Reference to employee');

                $table->enum('type', ['clock_in', 'clock_out', 'break_start', 'break_end'])
                    ->comment('Type of time entry');

                $table->dateTime('timestamp')
                    ->comment('Exact time of entry');

                $table->decimal('location_lat', 10, 8)->nullable()
                    ->comment('GPS latitude coordinate');

                $table->decimal('location_lng', 11, 8)->nullable()
                    ->comment('GPS longitude coordinate');

                $table->string('location_name')->nullable()
                    ->comment('Human readable location name');

                $table->json('device_info')->nullable()
                    ->comment('Device information for tracking');

                $table->string('photo_path')->nullable()
                    ->comment('Path to verification photo');

                $table->text('notes')->nullable()
                    ->comment('Optional notes for entry');

                $table->enum('status', ['pending', 'approved', 'rejected'])
                    ->default('pending')
                    ->comment('Entry approval status');

                $table->foreignId('approved_by')->nullable()
                    ->constrained('users')
                    ->onDelete('set null')
                    ->comment('User who approved entry');

                $table->dateTime('approved_at')->nullable()
                    ->comment('When entry was approved');

                $table->timestamps();

                // Performance indexes
                $table->index(['employee_id', 'timestamp'], 'time_entries_employee_timestamp_idx');
                $table->index(['timestamp', 'type'], 'time_entries_timestamp_type_idx');
                $table->index(['status'], 'time_entries_status_idx');

                // Prevent duplicate entries within same minute
                $table->unique(['employee_id', 'timestamp', 'type'], 'time_entries_unique_entry');
            }
        );
    }
};
