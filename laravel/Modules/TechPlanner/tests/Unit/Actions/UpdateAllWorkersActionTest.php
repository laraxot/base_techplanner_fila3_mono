<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\TechPlanner\Actions\UpdateAllWorkersAction;
use Modules\TechPlanner\Jobs\UpdateWorkerJob;
use Modules\TechPlanner\Models\Worker;
use Tests\TestCase;

/**
 * Test unitario per l'action UpdateAllWorkersAction.
 *
 * @covers \Modules\TechPlanner\Actions\UpdateAllWorkersAction
 */
class UpdateAllWorkersActionTest extends TestCase
{
    use RefreshDatabase;

    private UpdateAllWorkersAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = new UpdateAllWorkersAction();

        $this->action = new UpdateAllWorkersAction();

        $this->action = new UpdateAllWorkersAction();

        // Disabilita le code per i test
        Queue::fake();
    }

    /** @test */
    public function it_can_execute_action(): void
    {
        // Arrange
        $workers = Worker::factory()->count(5)->create();
        $updateData = [
            'status' => 'Active',
            'department' => 'Engineering',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('workers', [
            'id' => $workers->first()->id,
            'status' => 'Active',
            'department' => 'Engineering',
        ]);
    }

    /** @test */
    public function it_updates_all_workers_with_given_data(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(3)
            ->create([
                'status' => 'Inactive',
                'department' => 'Sales',
            ]);

        $updateData = [
            'status' => 'Active',
            'department' => 'Engineering',
            'notes' => 'Department transfer completed',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'status' => 'Active',
                'department' => 'Engineering',
                'notes' => 'Department transfer completed',
            ]);
        }
    }

    /** @test */
    public function it_handles_empty_update_data(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();

        // Act
        $result = $this->action->execute([]);

        // Assert
        $this->assertTrue($result);
        // Verifica che i lavoratori non siano stati modificati
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'status' => $worker->status,
                'department' => $worker->department,
            ]);
        }
    }

    /** @test */
    public function it_handles_single_worker_update(): void
    {
        // Arrange
        $worker = Worker::factory()->create([
            'status' => 'Inactive',
            'department' => 'Sales',
        ]);

        $updateData = [
            'status' => 'Active',
            'department' => 'Engineering',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'status' => 'Active',
            'department' => 'Engineering',
        ]);
    }

    /** @test */
    public function it_handles_large_number_of_workers(): void
    {
        // Arrange
        $workers = Worker::factory()->count(100)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(100, Worker::where('status', 'Active')->count());
    }

    /** @test */
    public function it_preserves_existing_data_not_in_update(): void
    {
        // Arrange
        $worker = Worker::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'Inactive',
            'department' => 'Sales',
            'notes' => 'Original notes',
        ]);

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'Active',
            'department' => 'Sales',
            'notes' => 'Original notes',
        ]);
    }

    /** @test */
    public function it_handles_null_values_in_update_data(): void
    {
        // Arrange
        $worker = Worker::factory()->create([
            'status' => 'Active',
            'department' => 'Engineering',
            'notes' => 'Some notes',
        ]);

        $updateData = [
            'status' => null,
            'department' => null,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'status' => null,
            'department' => null,
            'notes' => 'Some notes',
        ]);
    }

    /** @test */
    public function it_handles_boolean_values(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(3)
            ->create([
                'is_active' => false,
                'is_verified' => false,
            ]);

        $updateData = [
            'is_active' => true,
            'is_verified' => true,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'is_active' => true,
                'is_verified' => true,
            ]);
        }
    }

    /** @test */
    public function it_handles_date_values(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $updateDate = now()->addDays(30);

        $updateData = [
            'next_review_date' => $updateDate,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'next_review_date' => $updateDate->format('Y-m-d'),
            ]);
        }
    }

    /** @test */
    public function it_handles_decimal_values(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'hourly_rate' => 15.00,
                'overtime_rate' => 22.50,
            ]);

        $updateData = [
            'hourly_rate' => 18.00,
            'overtime_rate' => 27.00,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'hourly_rate' => 18.00,
                'overtime_rate' => 27.00,
            ]);
        }
    }

    /** @test */
    public function it_handles_json_values(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $metadata = [
            'source' => 'Bulk Import',
            'updated_by' => 'System',
            'update_timestamp' => now()->toISOString(),
        ];

        $updateData = ['metadata' => $metadata];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'metadata' => json_encode($metadata),
            ]);
        }
    }

    /** @test */
    public function it_returns_false_on_database_error(): void
    {
        // Arrange
        $invalidData = [
            'invalid_column' => 'invalid_value',
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
    }

    /** @test */
    public function it_handles_transaction_rollback_on_error(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(3)
            ->create([
                'status' => 'Inactive',
            ]);

        $updateData = [
            'status' => 'Active',
            'invalid_column' => 'invalid_value', // Questo causerà un errore
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun lavoratore sia stato aggiornato
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'status' => 'Inactive',
            ]);
        }
    }

    /** @test */
    public function it_logs_update_operation(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che l'operazione sia stata registrata nel log
        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'worker_update',
            'description' => 'Bulk update of workers',
            'subject_type' => Worker::class,
        ]);
    }

    /** @test */
    public function it_creates_audit_trail(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'status' => 'Inactive',
            ]);

        $updateData = [
            'status' => 'Active',
            'department' => 'Engineering',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che sia stato creato un audit trail
        $this->assertDatabaseHas('audit_trails', [
            'action' => 'bulk_update',
            'model_type' => Worker::class,
            'changes' => json_encode($updateData),
        ]);
    }

    /** @test */
    public function it_handles_concurrent_updates(): void
    {
        // Arrange
        $workers = Worker::factory()->count(5)->create();
        $updateData = ['status' => 'Active'];

        // Simula aggiornamenti concorrenti
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->action->execute($updateData);
        }

        // Assert
        $this->assertContainsOnly(true, $results);
        $this->assertEquals(5, Worker::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_empty_worker_table(): void
    {
        // Arrange
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(0, Worker::count());
    }

    /** @test */
    public function it_handles_soft_deleted_workers(): void
    {
        // Arrange
        $activeWorkers = Worker::factory()->count(2)->create();
        $deletedWorkers = Worker::factory()->count(2)->create();

        // Soft delete alcuni lavoratori
        $deletedWorkers->each(function ($worker) {
            $worker->delete();
        });

        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo i lavoratori attivi siano stati aggiornati
        foreach ($activeWorkers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'status' => 'Active',
            ]);
        }
        // Verifica che i lavoratori soft deleted non siano stati aggiornati
        foreach ($deletedWorkers as $worker) {
            $this->assertDatabaseMissing('workers', [
                'id' => $worker->id,
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_validation_errors(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $invalidData = [
            'email' => 'invalid-email', // Email non valida
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun lavoratore sia stato aggiornato
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'email' => $worker->email,
            ]);
        }
    }

    /** @test */
    public function it_handles_mass_assignment_protection(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $protectedData = [
            'id' => 999, // Campo protetto
            'created_at' => now()->subYear(), // Campo protetto
            'status' => 'Active', // Campo consentito
        ];

        // Act
        $result = $this->action->execute($protectedData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo i campi non protetti siano stati aggiornati
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id, // ID non dovrebbe essere cambiato
                'status' => 'Active', // Status dovrebbe essere aggiornato
            ]);
        }
    }

    /** @test */
    public function it_handles_relationship_updates(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $updateData = [
            'department_id' => 1,
            'supervisor_id' => 1,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'department_id' => 1,
                'supervisor_id' => 1,
            ]);
        }
    }

    /** @test */
    public function it_handles_enum_values(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'type' => 'Full-time',
                'status' => 'Inactive',
            ]);

        $updateData = [
            'type' => 'Part-time',
            'status' => 'Active',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'type' => 'Part-time',
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_text_fields(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $longText = str_repeat('This is a very long text field content. ', 50);

        $updateData = [
            'description' => $longText,
            'notes' => 'Updated notes',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'description' => $longText,
                'notes' => 'Updated notes',
            ]);
        }
    }

    /** @test */
    public function it_handles_array_fields(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $arrayData = [
            'skills' => ['PHP', 'Laravel', 'MySQL'],
            'certifications' => [
                'type' => 'Professional',
                'expiry' => '2025-12-31',
            ],
        ];

        $updateData = ['metadata' => $arrayData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'metadata' => json_encode($arrayData),
            ]);
        }
    }

    /** @test */
    public function it_handles_nullable_fields(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'phone' => '+1234567890',
                'address' => '123 Main St',
            ]);

        $updateData = [
            'phone' => null,
            'address' => null,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'phone' => null,
                'address' => null,
            ]);
        }
    }

    /** @test */
    public function it_handles_updated_at_timestamp(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $originalTimestamps = $workers->pluck('updated_at')->toArray();

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($workers as $worker) {
            $worker->refresh();
            $this->assertGreaterThan($worker->created_at, $worker->updated_at);
        }
    }

    /** @test */
    public function it_handles_custom_attributes(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $updateData = [
            'custom_field_1' => 'Custom Value 1',
            'custom_field_2' => 'Custom Value 2',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'custom_field_1' => 'Custom Value 1',
                'custom_field_2' => 'Custom Value 2',
            ]);
        }
    }

    /** @test */
    public function it_handles_encrypted_fields(): void
    {
        // Arrange
        $workers = Worker::factory()->count(2)->create();
        $sensitiveData = [
            'tax_id' => '123-45-6789',
            'ssn' => '987-65-4321',
        ];

        $updateData = ['sensitive_info' => $sensitiveData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'sensitive_info' => json_encode($sensitiveData),
            ]);
        }
    }

    /** @test */
    public function it_handles_conditional_updates(): void
    {
        // Arrange
        $activeWorkers = Worker::factory()->count(2)->create(['status' => 'Active']);
        $inactiveWorkers = Worker::factory()->count(2)->create(['status' => 'Inactive']);

        $updateData = [
            'priority' => 'High',
            'notes' => 'Updated via bulk action',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che tutti i lavoratori siano stati aggiornati
        $allWorkers = $activeWorkers->merge($inactiveWorkers);
        foreach ($allWorkers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'priority' => 'High',
                'notes' => 'Updated via bulk action',
            ]);
        }
    }

    /** @test */
    public function it_handles_batch_size_limits(): void
    {
        // Arrange
        $workers = Worker::factory()->count(1000)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1000, Worker::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_memory_optimization(): void
    {
        // Arrange
        $workers = Worker::factory()->count(500)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $memoryBefore = memory_get_usage();
        $result = $this->action->execute($updateData);
        $memoryAfter = memory_get_usage();

        // Assert
        $this->assertTrue($result);
        // Verifica che l'uso della memoria sia ragionevole (non più del doppio)
        $this->assertLessThan($memoryBefore * 2, $memoryAfter);
    }

    /** @test */
    public function it_handles_performance_monitoring(): void
    {
        // Arrange
        $workers = Worker::factory()->count(100)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $startTime = microtime(true);
        $result = $this->action->execute($updateData);
        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        // Assert
        $this->assertTrue($result);
        // Verifica che l'esecuzione sia ragionevolmente veloce (meno di 5 secondi)
        $this->assertLessThan(5.0, $executionTime);
    }

    /** @test */
    public function it_handles_worker_specific_fields(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(3)
            ->create([
                'position' => 'Developer',
                'level' => 'Junior',
                'start_date' => '2023-01-01',
            ]);

        $updateData = [
            'position' => 'Senior Developer',
            'level' => 'Senior',
            'start_date' => '2024-01-01',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'position' => 'Senior Developer',
                'level' => 'Senior',
                'start_date' => '2024-01-01',
            ]);
        }
    }

    /** @test */
    public function it_handles_worker_scheduling_fields(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'work_schedule' => '9-5',
                'break_time' => '12:00-13:00',
            ]);

        $updateData = [
            'work_schedule' => '8-4',
            'break_time' => '11:30-12:30',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'work_schedule' => '8-4',
                'break_time' => '11:30-12:30',
            ]);
        }
    }

    /** @test */
    public function it_handles_worker_availability_fields(): void
    {
        // Arrange
        $workers = Worker::factory()
            ->count(2)
            ->create([
                'is_available' => false,
                'available_from' => '09:00',
                'available_until' => '17:00',
            ]);

        $updateData = [
            'is_available' => true,
            'available_from' => '08:00',
            'available_until' => '18:00',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($workers as $worker) {
            $this->assertDatabaseHas('workers', [
                'id' => $worker->id,
                'is_available' => true,
                'available_from' => '08:00',
                'available_until' => '18:00',
            ]);
        }
    }
}
