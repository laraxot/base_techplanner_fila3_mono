<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\TechPlanner\Actions\UpdateAllAppointmentsAction;
use Modules\TechPlanner\Models\Appointment;
use Modules\TechPlanner\Jobs\UpdateAppointmentJob;
use Tests\TestCase;

/**
 * Test unitario per l'action UpdateAllAppointmentsAction.
 *
 * @covers \Modules\TechPlanner\Actions\UpdateAllAppointmentsAction
 */
class UpdateAllAppointmentsActionTest extends TestCase
{
    use RefreshDatabase;

    private UpdateAllAppointmentsAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->action = new UpdateAllAppointmentsAction();
        

        $this->action = new UpdateAllAppointmentsAction;

        
        $this->action = new UpdateAllAppointmentsAction();
        
        // Disabilita le code per i test
        Queue::fake();
    }

    /** @test */
    public function it_can_execute_action(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(5)->create();
        $updateData = [
            'status' => 'Confirmed',
            'priority' => 'High',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('appointments', [
            'id' => $appointments->first()->id,
            'status' => 'Confirmed',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_updates_all_appointments_with_given_data(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(3)->create([
            'status' => 'Pending',
            'priority' => 'Low',
        ]);

        $updateData = [
            'status' => 'Confirmed',
            'priority' => 'High',
            'notes' => 'Bulk update completed',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'status' => 'Confirmed',
                'priority' => 'High',
                'notes' => 'Bulk update completed',
            ]);
        }
    }

    /** @test */
    public function it_handles_empty_update_data(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();

        // Act
        $result = $this->action->execute([]);

        // Assert
        $this->assertTrue($result);
        // Verifica che gli appuntamenti non siano stati modificati
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'status' => $appointment->status,
                'priority' => $appointment->priority,
            ]);
        }
    }

    /** @test */
    public function it_handles_single_appointment_update(): void
    {
        // Arrange
        $appointment = Appointment::factory()->create([
            'status' => 'Pending',
            'priority' => 'Low',
        ]);

        $updateData = [
            'status' => 'Confirmed',
            'priority' => 'High',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'Confirmed',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_handles_large_number_of_appointments(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(100)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(100, Appointment::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_preserves_existing_data_not_in_update(): void
    {
        // Arrange
        $appointment = Appointment::factory()->create([
            'title' => 'Test Appointment',
            'description' => 'Test Description',
            'status' => 'Pending',
            'priority' => 'Low',
            'notes' => 'Original notes',
        ]);

        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'title' => 'Test Appointment',
            'description' => 'Test Description',
            'status' => 'Confirmed',
            'priority' => 'Low',
            'notes' => 'Original notes',
        ]);
    }

    /** @test */
    public function it_handles_null_values_in_update_data(): void
    {
        // Arrange
        $appointment = Appointment::factory()->create([
            'status' => 'Confirmed',
            'priority' => 'High',
            'notes' => 'Some notes',
        ]);

        $updateData = [
            'status' => null,
            'priority' => null,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => null,
            'priority' => null,
            'notes' => 'Some notes',
        ]);
    }

    /** @test */
    public function it_handles_boolean_values(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(3)->create([
            'is_urgent' => false,
            'is_confirmed' => false,
        ]);

        $updateData = [
            'is_urgent' => true,
            'is_confirmed' => true,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'is_urgent' => true,
                'is_confirmed' => true,
            ]);
        }
    }

    /** @test */
    public function it_handles_date_values(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $updateDate = now()->addDays(30);

        $updateData = [
            'appointment_date' => $updateDate,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'appointment_date' => $updateDate->format('Y-m-d'),
            ]);
        }
    }

    /** @test */
    public function it_handles_decimal_values(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'cost' => 100.00,
            'insurance_coverage' => 80.00,
        ]);

        $updateData = [
            'cost' => 150.00,
            'insurance_coverage' => 90.00,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'cost' => 150.00,
                'insurance_coverage' => 90.00,
            ]);
        }
    }

    /** @test */
    public function it_handles_json_values(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $metadata = [
            'source' => 'Bulk Import',
            'updated_by' => 'System',
            'update_timestamp' => now()->toISOString(),
        ];

        $updateData = ['metadata' => $metadata];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
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
        $appointments = Appointment::factory()->count(3)->create([
            'status' => 'Pending',
        ]);

        $updateData = [
            'status' => 'Confirmed',
            'invalid_column' => 'invalid_value', // Questo causerà un errore
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun appuntamento sia stato aggiornato
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'status' => 'Pending',
            ]);
        }
    }

    /** @test */
    public function it_logs_update_operation(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che l'operazione sia stata registrata nel log
        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'appointment_update',
            'description' => 'Bulk update of appointments',
            'subject_type' => Appointment::class,
        ]);
    }

    /** @test */
    public function it_creates_audit_trail(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'status' => 'Pending',
        ]);

        $updateData = [
            'status' => 'Confirmed',
            'priority' => 'High',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che sia stato creato un audit trail
        $this->assertDatabaseHas('audit_trails', [
            'action' => 'bulk_update',
            'model_type' => Appointment::class,
            'changes' => json_encode($updateData),
        ]);
    }

    /** @test */
    public function it_handles_concurrent_updates(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(5)->create();
        $updateData = ['status' => 'Confirmed'];

        // Simula aggiornamenti concorrenti
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->action->execute($updateData);
        }

        // Assert
        $this->assertContainsOnly(true, $results);
        $this->assertEquals(5, Appointment::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_handles_empty_appointment_table(): void
    {
        // Arrange
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function it_handles_soft_deleted_appointments(): void
    {
        // Arrange
        $activeAppointments = Appointment::factory()->count(2)->create();
        $deletedAppointments = Appointment::factory()->count(2)->create();
        

        // Soft delete alcuni appuntamenti
        $deletedAppointments->each(function ($appointment) {
            $appointment->delete();
        });

        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo gli appuntamenti attivi siano stati aggiornati
        foreach ($activeAppointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'status' => 'Confirmed',
            ]);
        }
        // Verifica che gli appuntamenti soft deleted non siano stati aggiornati
        foreach ($deletedAppointments as $appointment) {
            $this->assertDatabaseMissing('appointments', [
                'id' => $appointment->id,
                'status' => 'Confirmed',
            ]);
        }
    }

    /** @test */
    public function it_handles_validation_errors(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $invalidData = [
            'title' => '', // Titolo non valido
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun appuntamento sia stato aggiornato
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'title' => $appointment->title,
            ]);
        }
    }

    /** @test */
    public function it_handles_mass_assignment_protection(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $protectedData = [
            'id' => 999, // Campo protetto
            'created_at' => now()->subYear(), // Campo protetto
            'status' => 'Confirmed', // Campo consentito
        ];

        // Act
        $result = $this->action->execute($protectedData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo i campi non protetti siano stati aggiornati
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id, // ID non dovrebbe essere cambiato
                'status' => 'Confirmed', // Status dovrebbe essere aggiornato
            ]);
        }
    }

    /** @test */
    public function it_handles_relationship_updates(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $updateData = [
            'patient_id' => 1,
            'doctor_id' => 1,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'patient_id' => 1,
                'doctor_id' => 1,
            ]);
        }
    }

    /** @test */
    public function it_handles_enum_values(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'type' => 'Consultation',
            'status' => 'Pending',
        ]);

        $updateData = [
            'type' => 'Treatment',
            'status' => 'Confirmed',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'type' => 'Treatment',
                'status' => 'Confirmed',
            ]);
        }
    }

    /** @test */
    public function it_handles_text_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $longText = str_repeat('This is a very long text field content. ', 50);
        

        $updateData = [
            'description' => $longText,
            'notes' => 'Updated notes',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'description' => $longText,
                'notes' => 'Updated notes',
            ]);
        }
    }

    /** @test */
    public function it_handles_array_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $arrayData = [
            'symptoms' => ['fever', 'cough', 'fatigue'],
            'medications' => [
                'current' => ['aspirin'],
                'allergies' => ['penicillin'],
            ],
        ];

        $updateData = ['medical_data' => $arrayData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'medical_data' => json_encode($arrayData),
            ]);
        }
    }

    /** @test */
    public function it_handles_nullable_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'location' => 'Main Office',
            'contact_person' => 'John Doe',
        ]);

        $updateData = [
            'location' => null,
            'contact_person' => null,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'location' => null,
                'contact_person' => null,
            ]);
        }
    }

    /** @test */
    public function it_handles_updated_at_timestamp(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $originalTimestamps = $appointments->pluck('updated_at')->toArray();

        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($appointments as $appointment) {
            $appointment->refresh();
            $this->assertGreaterThan(
                $appointment->created_at,
                $appointment->updated_at
            );
        }
    }

    /** @test */
    public function it_handles_custom_attributes(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $updateData = [
            'custom_field_1' => 'Custom Value 1',
            'custom_field_2' => 'Custom Value 2',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'custom_field_1' => 'Custom Value 1',
                'custom_field_2' => 'Custom Value 2',
            ]);
        }
    }

    /** @test */
    public function it_handles_encrypted_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create();
        $sensitiveData = [
            'patient_notes' => 'Confidential patient information',
            'diagnosis_code' => 'ICD-10-CM',
        ];

        $updateData = ['sensitive_info' => $sensitiveData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'sensitive_info' => json_encode($sensitiveData),
            ]);
        }
    }

    /** @test */
    public function it_handles_conditional_updates(): void
    {
        // Arrange
        $confirmedAppointments = Appointment::factory()->count(2)->create(['status' => 'Confirmed']);
        $pendingAppointments = Appointment::factory()->count(2)->create(['status' => 'Pending']);

        $updateData = [
            'priority' => 'High',
            'notes' => 'Updated via bulk action',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che tutti gli appuntamenti siano stati aggiornati
        $allAppointments = $confirmedAppointments->merge($pendingAppointments);
        foreach ($allAppointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'priority' => 'High',
                'notes' => 'Updated via bulk action',
            ]);
        }
    }

    /** @test */
    public function it_handles_batch_size_limits(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(1000)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1000, Appointment::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_handles_memory_optimization(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(500)->create();
        $updateData = ['status' => 'Confirmed'];

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
        $appointments = Appointment::factory()->count(100)->create();
        $updateData = ['status' => 'Confirmed'];

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
    public function it_handles_appointment_specific_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(3)->create([
            'duration' => 30,
            'follow_up_days' => 7,
            'reminder_hours' => 24,
        ]);

        $updateData = [
            'duration' => 60,
            'follow_up_days' => 14,
            'reminder_hours' => 48,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'duration' => 60,
                'follow_up_days' => 14,
                'reminder_hours' => 48,
            ]);
        }
    }

    /** @test */
    public function it_handles_appointment_scheduling_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'start_time' => '09:00',
            'end_time' => '09:30',
            'timezone' => 'UTC',
        ]);

        $updateData = [
            'start_time' => '10:00',
            'end_time' => '11:00',
            'timezone' => 'Europe/Rome',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'start_time' => '10:00',
                'end_time' => '11:00',
                'timezone' => 'Europe/Rome',
            ]);
        }
    }

    /** @test */
    public function it_handles_appointment_medical_fields(): void
    {
        // Arrange
        $appointments = Appointment::factory()->count(2)->create([
            'diagnosis' => 'Common cold',
            'prescription' => 'Rest and fluids',
            'lab_results' => 'Normal',
        ]);

        $updateData = [
            'diagnosis' => 'Updated diagnosis',
            'prescription' => 'Updated prescription',
            'lab_results' => 'Updated results',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($appointments as $appointment) {
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'diagnosis' => 'Updated diagnosis',
                'prescription' => 'Updated prescription',
                'lab_results' => 'Updated results',
            ]);
        }
    }
}
