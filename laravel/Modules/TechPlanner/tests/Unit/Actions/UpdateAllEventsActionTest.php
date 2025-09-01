<?php

declare(strict_types=1);




namespace Modules\TechPlanner\Tests\Unit\Actions;
use Illuminate\Support\Facades\Queue;
use Modules\TechPlanner\Actions\UpdateAllEventsAction;
use Modules\TechPlanner\Models\Event;
use Modules\TechPlanner\Jobs\UpdateEventJob;
use Modules\TechPlanner\Tests\Unit\Actions\TestCase;

/**
 * Test unitario per l'action UpdateAllEventsAction.
 *
 * @covers \Modules\TechPlanner\Actions\UpdateAllEventsAction
 */
class UpdateAllEventsActionTest extends TestCase
{

    private UpdateAllEventsAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->action = new UpdateAllEventsAction();
        
        // Disabilita le code per i test
        Queue::fake();
    }

    /** @test */
    public function it_can_execute_action(): void
    {
        // Arrange
        $events = Event::factory()->count(5)->create();
        $updateData = [
            'status' => 'Confirmed',
            'priority' => 'High',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('events', [
            'id' => $events->first()->id,
            'status' => 'Confirmed',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_updates_all_events_with_given_data(): void
    {
        // Arrange
        $events = Event::factory()->count(3)->create([
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
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
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
        $events = Event::factory()->count(2)->create();

        // Act
        $result = $this->action->execute([]);

        // Assert
        $this->assertTrue($result);
        // Verifica che gli eventi non siano stati modificati
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'status' => $event->status,
                'priority' => $event->priority,
            ]);
        }
    }

    /** @test */
    public function it_handles_single_event_update(): void
    {
        // Arrange
        $event = Event::factory()->create([
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
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'status' => 'Confirmed',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_handles_large_number_of_events(): void
    {
        // Arrange
        $events = Event::factory()->count(100)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(100, Event::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_preserves_existing_data_not_in_update(): void
    {
        // Arrange
        $event = Event::factory()->create([
            'title' => 'Test Event',
            'description' => 'Test Description',
            'status' => 'Pending',
            'priority' => 'Low',
            'notes' => 'Original notes',
        ]);

        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'title' => 'Test Event',
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
        $event = Event::factory()->create([
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
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'status' => null,
            'priority' => null,
            'notes' => 'Some notes',
        ]);
    }

    /** @test */
    public function it_handles_boolean_values(): void
    {
        // Arrange
        $events = Event::factory()->count(3)->create([
            'is_public' => false,
            'is_recurring' => false,
        ]);

        $updateData = [
            'is_public' => true,
            'is_recurring' => true,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'is_public' => true,
                'is_recurring' => true,
            ]);
        }
    }

    /** @test */
    public function it_handles_date_values(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $updateDate = now()->addDays(30);

        $updateData = [
            'start_date' => $updateDate,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'start_date' => $updateDate->format('Y-m-d'),
            ]);
        }
    }

    /** @test */
    public function it_handles_decimal_values(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
            'budget' => 1000.00,
            'cost' => 500.00,
        ]);

        $updateData = [
            'budget' => 2000.00,
            'cost' => 1000.00,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'budget' => 2000.00,
                'cost' => 1000.00,
            ]);
        }
    }

    /** @test */
    public function it_handles_json_values(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $metadata = [
            'source' => 'Bulk Import',
            'updated_by' => 'System',
            'update_timestamp' => now()->toISOString(),
        ];

        $updateData = ['metadata' => $metadata];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
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
        $events = Event::factory()->count(3)->create([
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
        // Verifica che nessun evento sia stato aggiornato
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'status' => 'Pending',
            ]);
        }
    }

    /** @test */
    public function it_logs_update_operation(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che l'operazione sia stata registrata nel log
        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'event_update',
            'description' => 'Bulk update of events',
            'subject_type' => Event::class,
        ]);
    }

    /** @test */
    public function it_creates_audit_trail(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
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
            'model_type' => Event::class,
            'changes' => json_encode($updateData),
        ]);
    }

    /** @test */
    public function it_handles_concurrent_updates(): void
    {
        // Arrange
        $events = Event::factory()->count(5)->create();
        $updateData = ['status' => 'Confirmed'];

        // Simula aggiornamenti concorrenti
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->action->execute($updateData);
        }

        // Assert
        $this->assertContainsOnly(true, $results);
        $this->assertEquals(5, Event::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_handles_empty_event_table(): void
    {
        // Arrange
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(0, Event::count());
    }

    /** @test */
    public function it_handles_soft_deleted_events(): void
    {
        // Arrange
        $activeEvents = Event::factory()->count(2)->create();
        $deletedEvents = Event::factory()->count(2)->create();
        
        // Soft delete alcuni eventi
        $deletedEvents->each(function ($event) {
            $event->delete();
        });

        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo gli eventi attivi siano stati aggiornati
        foreach ($activeEvents as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'status' => 'Confirmed',
            ]);
        }
        // Verifica che gli eventi soft deleted non siano stati aggiornati
        foreach ($deletedEvents as $event) {
            $this->assertDatabaseMissing('events', [
                'id' => $event->id,
                'status' => 'Confirmed',
            ]);
        }
    }

    /** @test */
    public function it_handles_validation_errors(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $invalidData = [
            'title' => '', // Titolo non valido
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun evento sia stato aggiornato
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'title' => $event->title,
            ]);
        }
    }

    /** @test */
    public function it_handles_mass_assignment_protection(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
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
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id, // ID non dovrebbe essere cambiato
                'status' => 'Confirmed', // Status dovrebbe essere aggiornato
            ]);
        }
    }

    /** @test */
    public function it_handles_relationship_updates(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $updateData = [
            'category_id' => 1,
            'organizer_id' => 1,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'category_id' => 1,
                'organizer_id' => 1,
            ]);
        }
    }

    /** @test */
    public function it_handles_enum_values(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
            'type' => 'Meeting',
            'status' => 'Pending',
        ]);

        $updateData = [
            'type' => 'Conference',
            'status' => 'Confirmed',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'type' => 'Conference',
                'status' => 'Confirmed',
            ]);
        }
    }

    /** @test */
    public function it_handles_text_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $longText = str_repeat('This is a very long text field content. ', 50);
        
        $updateData = [
            'description' => $longText,
            'notes' => 'Updated notes',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'description' => $longText,
                'notes' => 'Updated notes',
            ]);
        }
    }

    /** @test */
    public function it_handles_array_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $arrayData = [
            'tags' => ['important', 'business', 'meeting'],
            'participants' => [
                'max' => 50,
                'min' => 10,
            ],
        ];

        $updateData = ['metadata' => $arrayData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'metadata' => json_encode($arrayData),
            ]);
        }
    }

    /** @test */
    public function it_handles_nullable_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
            'location' => 'Main Hall',
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
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'location' => null,
                'contact_person' => null,
            ]);
        }
    }

    /** @test */
    public function it_handles_updated_at_timestamp(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $originalTimestamps = $events->pluck('updated_at')->toArray();

        $updateData = ['status' => 'Confirmed'];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($events as $event) {
            $event->refresh();
            $this->assertGreaterThan(
                $event->created_at,
                $event->updated_at
            );
        }
    }

    /** @test */
    public function it_handles_custom_attributes(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $updateData = [
            'custom_field_1' => 'Custom Value 1',
            'custom_field_2' => 'Custom Value 2',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'custom_field_1' => 'Custom Value 1',
                'custom_field_2' => 'Custom Value 2',
            ]);
        }
    }

    /** @test */
    public function it_handles_encrypted_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create();
        $sensitiveData = [
            'admin_password' => 'admin123',
            'api_key' => 'key123456',
        ];

        $updateData = ['sensitive_info' => $sensitiveData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'sensitive_info' => json_encode($sensitiveData),
            ]);
        }
    }

    /** @test */
    public function it_handles_conditional_updates(): void
    {
        // Arrange
        $confirmedEvents = Event::factory()->count(2)->create(['status' => 'Confirmed']);
        $pendingEvents = Event::factory()->count(2)->create(['status' => 'Pending']);

        $updateData = [
            'priority' => 'High',
            'notes' => 'Updated via bulk action',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che tutti gli eventi siano stati aggiornati
        $allEvents = $confirmedEvents->merge($pendingEvents);
        foreach ($allEvents as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'priority' => 'High',
                'notes' => 'Updated via bulk action',
            ]);
        }
    }

    /** @test */
    public function it_handles_batch_size_limits(): void
    {
        // Arrange
        $events = Event::factory()->count(1000)->create();
        $updateData = ['status' => 'Confirmed'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1000, Event::where('status', 'Confirmed')->count());
    }

    /** @test */
    public function it_handles_memory_optimization(): void
    {
        // Arrange
        $events = Event::factory()->count(500)->create();
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
        $events = Event::factory()->count(100)->create();
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
    public function it_handles_event_specific_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(3)->create([
            'duration' => 60,
            'max_participants' => 100,
            'registration_deadline' => '2023-12-31',
        ]);

        $updateData = [
            'duration' => 120,
            'max_participants' => 200,
            'registration_deadline' => '2024-12-31',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'duration' => 120,
                'max_participants' => 200,
                'registration_deadline' => '2024-12-31',
            ]);
        }
    }

    /** @test */
    public function it_handles_event_scheduling_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
            'start_time' => '09:00',
            'end_time' => '17:00',
            'timezone' => 'UTC',
        ]);

        $updateData = [
            'start_time' => '10:00',
            'end_time' => '18:00',
            'timezone' => 'Europe/Rome',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'start_time' => '10:00',
                'end_time' => '18:00',
                'timezone' => 'Europe/Rome',
            ]);
        }
    }

    /** @test */
    public function it_handles_event_recurring_fields(): void
    {
        // Arrange
        $events = Event::factory()->count(2)->create([
            'recurring_pattern' => 'weekly',
            'recurring_interval' => 1,
            'recurring_end_date' => '2023-12-31',
        ]);

        $updateData = [
            'recurring_pattern' => 'monthly',
            'recurring_interval' => 2,
            'recurring_end_date' => '2024-12-31',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($events as $event) {
            $this->assertDatabaseHas('events', [
                'id' => $event->id,
                'recurring_pattern' => 'monthly',
                'recurring_interval' => 2,
                'recurring_end_date' => '2024-12-31',
            ]);
        }
    }
}
