<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\TechPlanner\Actions\UpdateAllClientsAction;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Jobs\UpdateClientJob;
use Tests\TestCase;

/**
 * Test unitario per l'action UpdateAllClientsAction.
 *
 * @covers \Modules\TechPlanner\Actions\UpdateAllClientsAction
 */
class UpdateAllClientsActionTest extends TestCase
{
    use RefreshDatabase;

    private UpdateAllClientsAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->action = new UpdateAllClientsAction();
        
        // Disabilita le code per i test
        Queue::fake();
    }

    /** @test */
    public function it_can_execute_action(): void
    {
        // Arrange
        $clients = Client::factory()->count(5)->create();
        $updateData = [
            'status' => 'Active',
            'priority' => 'High',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('clients', [
            'id' => $clients->first()->id,
            'status' => 'Active',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_updates_all_clients_with_given_data(): void
    {
        // Arrange
        $clients = Client::factory()->count(3)->create([
            'status' => 'Inactive',
            'priority' => 'Low',
        ]);

        $updateData = [
            'status' => 'Active',
            'priority' => 'High',
            'notes' => 'Bulk update completed',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'status' => 'Active',
                'priority' => 'High',
                'notes' => 'Bulk update completed',
            ]);
        }
    }

    /** @test */
    public function it_handles_empty_update_data(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();

        // Act
        $result = $this->action->execute([]);

        // Assert
        $this->assertTrue($result);
        // Verifica che i clienti non siano stati modificati
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'status' => $client->status,
                'priority' => $client->priority,
            ]);
        }
    }

    /** @test */
    public function it_handles_single_client_update(): void
    {
        // Arrange
        $client = Client::factory()->create([
            'status' => 'Inactive',
            'priority' => 'Low',
        ]);

        $updateData = [
            'status' => 'Active',
            'priority' => 'High',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'status' => 'Active',
            'priority' => 'High',
        ]);
    }

    /** @test */
    public function it_handles_large_number_of_clients(): void
    {
        // Arrange
        $clients = Client::factory()->count(100)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(100, Client::where('status', 'Active')->count());
    }

    /** @test */
    public function it_preserves_existing_data_not_in_update(): void
    {
        // Arrange
        $client = Client::factory()->create([
            'name' => 'Test Client',
            'email' => 'test@example.com',
            'status' => 'Inactive',
            'priority' => 'Low',
            'notes' => 'Original notes',
        ]);

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Test Client',
            'email' => 'test@example.com',
            'status' => 'Active',
            'priority' => 'Low',
            'notes' => 'Original notes',
        ]);
    }

    /** @test */
    public function it_handles_null_values_in_update_data(): void
    {
        // Arrange
        $client = Client::factory()->create([
            'status' => 'Active',
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
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'status' => null,
            'priority' => null,
            'notes' => 'Some notes',
        ]);
    }

    /** @test */
    public function it_handles_boolean_values(): void
    {
        // Arrange
        $clients = Client::factory()->count(3)->create([
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
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'is_active' => true,
                'is_verified' => true,
            ]);
        }
    }

    /** @test */
    public function it_handles_date_values(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $updateDate = now()->addDays(30);

        $updateData = [
            'next_contact_date' => $updateDate,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'next_contact_date' => $updateDate->format('Y-m-d'),
            ]);
        }
    }

    /** @test */
    public function it_handles_decimal_values(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create([
            'credit_limit' => 1000.00,
            'balance' => 500.00,
        ]);

        $updateData = [
            'credit_limit' => 2000.00,
            'balance' => 1000.00,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'credit_limit' => 2000.00,
                'balance' => 1000.00,
            ]);
        }
    }

    /** @test */
    public function it_handles_json_values(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $metadata = [
            'source' => 'Bulk Import',
            'updated_by' => 'System',
            'update_timestamp' => now()->toISOString(),
        ];

        $updateData = ['metadata' => $metadata];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
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
        $clients = Client::factory()->count(3)->create([
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
        // Verifica che nessun cliente sia stato aggiornato
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'status' => 'Inactive',
            ]);
        }
    }

    /** @test */
    public function it_logs_update_operation(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che l'operazione sia stata registrata nel log
        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'client_update',
            'description' => 'Bulk update of clients',
            'subject_type' => Client::class,
        ]);
    }

    /** @test */
    public function it_creates_audit_trail(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create([
            'status' => 'Inactive',
        ]);

        $updateData = [
            'status' => 'Active',
            'priority' => 'High',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che sia stato creato un audit trail
        $this->assertDatabaseHas('audit_trails', [
            'action' => 'bulk_update',
            'model_type' => Client::class,
            'changes' => json_encode($updateData),
        ]);
    }

    /** @test */
    public function it_handles_concurrent_updates(): void
    {
        // Arrange
        $clients = Client::factory()->count(5)->create();
        $updateData = ['status' => 'Active'];

        // Simula aggiornamenti concorrenti
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->action->execute($updateData);
        }

        // Assert
        $this->assertContainsOnly(true, $results);
        $this->assertEquals(5, Client::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_empty_client_table(): void
    {
        // Arrange
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(0, Client::count());
    }

    /** @test */
    public function it_handles_soft_deleted_clients(): void
    {
        // Arrange
        $activeClients = Client::factory()->count(2)->create();
        $deletedClients = Client::factory()->count(2)->create();
        
        // Soft delete alcuni clienti
        $deletedClients->each(function ($client) {
            $client->delete();
        });

        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo i clienti attivi siano stati aggiornati
        foreach ($activeClients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'status' => 'Active',
            ]);
        }
        // Verifica che i clienti soft deleted non siano stati aggiornati
        foreach ($deletedClients as $client) {
            $this->assertDatabaseMissing('clients', [
                'id' => $client->id,
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_validation_errors(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $invalidData = [
            'email' => 'invalid-email', // Email non valida
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun cliente sia stato aggiornato
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'email' => $client->email,
            ]);
        }
    }

    /** @test */
    public function it_handles_mass_assignment_protection(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
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
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id, // ID non dovrebbe essere cambiato
                'status' => 'Active', // Status dovrebbe essere aggiornato
            ]);
        }
    }

    /** @test */
    public function it_handles_relationship_updates(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $updateData = [
            'category_id' => 1,
            'manager_id' => 1,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'category_id' => 1,
                'manager_id' => 1,
            ]);
        }
    }

    /** @test */
    public function it_handles_enum_values(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create([
            'type' => 'Individual',
            'status' => 'Inactive',
        ]);

        $updateData = [
            'type' => 'Corporate',
            'status' => 'Active',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'type' => 'Corporate',
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_text_fields(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $longText = str_repeat('This is a very long text field content. ', 50);
        
        $updateData = [
            'description' => $longText,
            'notes' => 'Updated notes',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'description' => $longText,
                'notes' => 'Updated notes',
            ]);
        }
    }

    /** @test */
    public function it_handles_array_fields(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $arrayData = [
            'tags' => ['important', 'vip', 'corporate'],
            'preferences' => [
                'communication' => 'email',
                'frequency' => 'weekly',
            ],
        ];

        $updateData = ['metadata' => $arrayData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'metadata' => json_encode($arrayData),
            ]);
        }
    }

    /** @test */
    public function it_handles_nullable_fields(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create([
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
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'phone' => null,
                'address' => null,
            ]);
        }
    }

    /** @test */
    public function it_handles_updated_at_timestamp(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $originalTimestamps = $clients->pluck('updated_at')->toArray();

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($clients as $client) {
            $client->refresh();
            $this->assertGreaterThan(
                $client->created_at,
                $client->updated_at
            );
        }
    }

    /** @test */
    public function it_handles_custom_attributes(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $updateData = [
            'custom_field_1' => 'Custom Value 1',
            'custom_field_2' => 'Custom Value 2',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'custom_field_1' => 'Custom Value 1',
                'custom_field_2' => 'Custom Value 2',
            ]);
        }
    }

    /** @test */
    public function it_handles_encrypted_fields(): void
    {
        // Arrange
        $clients = Client::factory()->count(2)->create();
        $sensitiveData = [
            'tax_id' => '123-45-6789',
            'ssn' => '987-65-4321',
        ];

        $updateData = ['sensitive_info' => $sensitiveData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'sensitive_info' => json_encode($sensitiveData),
            ]);
        }
    }

    /** @test */
    public function it_handles_conditional_updates(): void
    {
        // Arrange
        $activeClients = Client::factory()->count(2)->create(['status' => 'Active']);
        $inactiveClients = Client::factory()->count(2)->create(['status' => 'Inactive']);

        $updateData = [
            'priority' => 'High',
            'notes' => 'Updated via bulk action',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che tutti i clienti siano stati aggiornati
        $allClients = $activeClients->merge($inactiveClients);
        foreach ($allClients as $client) {
            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'priority' => 'High',
                'notes' => 'Updated via bulk action',
            ]);
        }
    }

    /** @test */
    public function it_handles_batch_size_limits(): void
    {
        // Arrange
        $clients = Client::factory()->count(1000)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1000, Client::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_memory_optimization(): void
    {
        // Arrange
        $clients = Client::factory()->count(500)->create();
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
        $clients = Client::factory()->count(100)->create();
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
}
