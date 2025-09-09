<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\TechPlanner\Actions\UpdateAllDevicesAction;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Jobs\UpdateDeviceJob;
use Tests\TestCase;

/**
 * Test unitario per l'action UpdateAllDevicesAction.
 *
 * @covers \Modules\TechPlanner\Actions\UpdateAllDevicesAction
 */
class UpdateAllDevicesActionTest extends TestCase
{
    use RefreshDatabase;

    private UpdateAllDevicesAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->action = new UpdateAllDevicesAction();
        

        $this->action = new UpdateAllDevicesAction;

        
        $this->action = new UpdateAllDevicesAction();
        
        // Disabilita le code per i test
        Queue::fake();
    }

    /** @test */
    public function it_can_execute_action(): void
    {
        // Arrange
        $devices = Device::factory()->count(5)->create();
        $updateData = [
            'status' => 'Active',
            'location' => 'Main Office',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('devices', [
            'id' => $devices->first()->id,
            'status' => 'Active',
            'location' => 'Main Office',
        ]);
    }

    /** @test */
    public function it_updates_all_devices_with_given_data(): void
    {
        // Arrange
        $devices = Device::factory()->count(3)->create([
            'status' => 'Inactive',
            'location' => 'Storage',
        ]);

        $updateData = [
            'status' => 'Active',
            'location' => 'Main Office',
            'notes' => 'Deployed to main office',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'status' => 'Active',
                'location' => 'Main Office',
                'notes' => 'Deployed to main office',
            ]);
        }
    }

    /** @test */
    public function it_handles_empty_update_data(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();

        // Act
        $result = $this->action->execute([]);

        // Assert
        $this->assertTrue($result);
        // Verifica che i dispositivi non siano stati modificati
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'status' => $device->status,
                'location' => $device->location,
            ]);
        }
    }

    /** @test */
    public function it_handles_single_device_update(): void
    {
        // Arrange
        $device = Device::factory()->create([
            'status' => 'Inactive',
            'location' => 'Storage',
        ]);

        $updateData = [
            'status' => 'Active',
            'location' => 'Main Office',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'status' => 'Active',
            'location' => 'Main Office',
        ]);
    }

    /** @test */
    public function it_handles_large_number_of_devices(): void
    {
        // Arrange
        $devices = Device::factory()->count(100)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(100, Device::where('status', 'Active')->count());
    }

    /** @test */
    public function it_preserves_existing_data_not_in_update(): void
    {
        // Arrange
        $device = Device::factory()->create([
            'name' => 'Test Device',
            'serial_number' => 'SN123456',
            'status' => 'Inactive',
            'location' => 'Storage',
            'notes' => 'Original notes',
        ]);

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'name' => 'Test Device',
            'serial_number' => 'SN123456',
            'status' => 'Active',
            'location' => 'Storage',
            'notes' => 'Original notes',
        ]);
    }

    /** @test */
    public function it_handles_null_values_in_update_data(): void
    {
        // Arrange
        $device = Device::factory()->create([
            'status' => 'Active',
            'location' => 'Main Office',
            'notes' => 'Some notes',
        ]);

        $updateData = [
            'status' => null,
            'location' => null,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'status' => null,
            'location' => null,
            'notes' => 'Some notes',
        ]);
    }

    /** @test */
    public function it_handles_boolean_values(): void
    {
        // Arrange
        $devices = Device::factory()->count(3)->create([
            'is_active' => false,
            'is_online' => false,
        ]);

        $updateData = [
            'is_active' => true,
            'is_online' => true,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'is_active' => true,
                'is_online' => true,
            ]);
        }
    }

    /** @test */
    public function it_handles_date_values(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $updateDate = now()->addDays(30);

        $updateData = [
            'next_maintenance_date' => $updateDate,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'next_maintenance_date' => $updateDate->format('Y-m-d'),
            ]);
        }
    }

    /** @test */
    public function it_handles_decimal_values(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'cost' => 1000.00,
            'maintenance_cost' => 100.00,
        ]);

        $updateData = [
            'cost' => 1500.00,
            'maintenance_cost' => 150.00,
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'cost' => 1500.00,
                'maintenance_cost' => 150.00,
            ]);
        }
    }

    /** @test */
    public function it_handles_json_values(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $metadata = [
            'source' => 'Bulk Import',
            'updated_by' => 'System',
            'update_timestamp' => now()->toISOString(),
        ];

        $updateData = ['metadata' => $metadata];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
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
        $devices = Device::factory()->count(3)->create([
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
        // Verifica che nessun dispositivo sia stato aggiornato
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'status' => 'Inactive',
            ]);
        }
    }

    /** @test */
    public function it_logs_update_operation(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che l'operazione sia stata registrata nel log
        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'device_update',
            'description' => 'Bulk update of devices',
            'subject_type' => Device::class,
        ]);
    }

    /** @test */
    public function it_creates_audit_trail(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'status' => 'Inactive',
        ]);

        $updateData = [
            'status' => 'Active',
            'location' => 'Main Office',
        ];

        // Act
        $this->action->execute($updateData);

        // Assert
        // Verifica che sia stato creato un audit trail
        $this->assertDatabaseHas('audit_trails', [
            'action' => 'bulk_update',
            'model_type' => Device::class,
            'changes' => json_encode($updateData),
        ]);
    }

    /** @test */
    public function it_handles_concurrent_updates(): void
    {
        // Arrange
        $devices = Device::factory()->count(5)->create();
        $updateData = ['status' => 'Active'];

        // Simula aggiornamenti concorrenti
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->action->execute($updateData);
        }

        // Assert
        $this->assertContainsOnly(true, $results);
        $this->assertEquals(5, Device::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_empty_device_table(): void
    {
        // Arrange
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(0, Device::count());
    }

    /** @test */
    public function it_handles_soft_deleted_devices(): void
    {
        // Arrange
        $activeDevices = Device::factory()->count(2)->create();
        $deletedDevices = Device::factory()->count(2)->create();
        
        // Soft delete alcuni dispositivi
        $deletedDevices->each(function ($device) {
            $device->delete();
        });

        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che solo i dispositivi attivi siano stati aggiornati
        foreach ($activeDevices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'status' => 'Active',
            ]);
        }
        // Verifica che i dispositivi soft deleted non siano stati aggiornati
        foreach ($deletedDevices as $device) {
            $this->assertDatabaseMissing('devices', [
                'id' => $device->id,
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_validation_errors(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $invalidData = [
            'serial_number' => '', // Serial number non valido
        ];

        // Act
        $result = $this->action->execute($invalidData);

        // Assert
        $this->assertFalse($result);
        // Verifica che nessun dispositivo sia stato aggiornato
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'serial_number' => $device->serial_number,
            ]);
        }
    }

    /** @test */
    public function it_handles_mass_assignment_protection(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
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
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id, // ID non dovrebbe essere cambiato
                'status' => 'Active', // Status dovrebbe essere aggiornato
            ]);
        }
    }

    /** @test */
    public function it_handles_relationship_updates(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $updateData = [
            'category_id' => 1,
            'owner_id' => 1,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'category_id' => 1,
                'owner_id' => 1,
            ]);
        }
    }

    /** @test */
    public function it_handles_enum_values(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'type' => 'Computer',
            'status' => 'Inactive',
        ]);

        $updateData = [
            'type' => 'Mobile',
            'status' => 'Active',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'type' => 'Mobile',
                'status' => 'Active',
            ]);
        }
    }

    /** @test */
    public function it_handles_text_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $longText = str_repeat('This is a very long text field content. ', 50);
        
        $updateData = [
            'description' => $longText,
            'notes' => 'Updated notes',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'description' => $longText,
                'notes' => 'Updated notes',
            ]);
        }
    }

    /** @test */
    public function it_handles_array_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $arrayData = [
            'tags' => ['important', 'critical', 'network'],
            'specifications' => [
                'cpu' => 'Intel i7',
                'ram' => '16GB',
            ],
        ];

        $updateData = ['metadata' => $arrayData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'metadata' => json_encode($arrayData),
            ]);
        }
    }

    /** @test */
    public function it_handles_nullable_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'ip_address' => '192.168.1.100',
            'mac_address' => '00:11:22:33:44:55',
        ]);

        $updateData = [
            'ip_address' => null,
            'mac_address' => null,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'ip_address' => null,
                'mac_address' => null,
            ]);
        }
    }

    /** @test */
    public function it_handles_updated_at_timestamp(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $originalTimestamps = $devices->pluck('updated_at')->toArray();

        $updateData = ['status' => 'Active'];

        // Act
        $this->action->execute($updateData);

        // Assert
        foreach ($devices as $device) {
            $device->refresh();
            $this->assertGreaterThan(
                $device->created_at,
                $device->updated_at
            );
        }
    }

    /** @test */
    public function it_handles_custom_attributes(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $updateData = [
            'custom_field_1' => 'Custom Value 1',
            'custom_field_2' => 'Custom Value 2',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'custom_field_1' => 'Custom Value 1',
                'custom_field_2' => 'Custom Value 2',
            ]);
        }
    }

    /** @test */
    public function it_handles_encrypted_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create();
        $sensitiveData = [
            'admin_password' => 'admin123',
            'api_key' => 'key123456',
        ];

        $updateData = ['sensitive_info' => $sensitiveData];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'sensitive_info' => json_encode($sensitiveData),
            ]);
        }
    }

    /** @test */
    public function it_handles_conditional_updates(): void
    {
        // Arrange
        $activeDevices = Device::factory()->count(2)->create(['status' => 'Active']);
        $inactiveDevices = Device::factory()->count(2)->create(['status' => 'Inactive']);

        $updateData = [
            'priority' => 'High',
            'notes' => 'Updated via bulk action',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        // Verifica che tutti i dispositivi siano stati aggiornati
        $allDevices = $activeDevices->merge($inactiveDevices);
        foreach ($allDevices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'priority' => 'High',
                'notes' => 'Updated via bulk action',
            ]);
        }
    }

    /** @test */
    public function it_handles_batch_size_limits(): void
    {
        // Arrange
        $devices = Device::factory()->count(1000)->create();
        $updateData = ['status' => 'Active'];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1000, Device::where('status', 'Active')->count());
    }

    /** @test */
    public function it_handles_memory_optimization(): void
    {
        // Arrange
        $devices = Device::factory()->count(500)->create();
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
        $devices = Device::factory()->count(100)->create();
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
    public function it_handles_device_specific_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(3)->create([
            'model' => 'Old Model',
            'manufacturer' => 'Old Manufacturer',
            'purchase_date' => '2020-01-01',
        ]);

        $updateData = [
            'model' => 'New Model',
            'manufacturer' => 'New Manufacturer',
            'purchase_date' => '2024-01-01',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'model' => 'New Model',
                'manufacturer' => 'New Manufacturer',
                'purchase_date' => '2024-01-01',
            ]);
        }
    }

    /** @test */
    public function it_handles_device_maintenance_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'last_maintenance' => '2023-01-01',
            'maintenance_interval' => 90,
        ]);

        $updateData = [
            'last_maintenance' => '2024-01-01',
            'maintenance_interval' => 180,
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'last_maintenance' => '2024-01-01',
                'maintenance_interval' => 180,
            ]);
        }
    }

    /** @test */
    public function it_handles_device_warranty_fields(): void
    {
        // Arrange
        $devices = Device::factory()->count(2)->create([
            'warranty_expiry' => '2023-12-31',
            'warranty_type' => 'Standard',
        ]);

        $updateData = [
            'warranty_expiry' => '2025-12-31',
            'warranty_type' => 'Extended',
        ];

        // Act
        $result = $this->action->execute($updateData);

        // Assert
        $this->assertTrue($result);
        foreach ($devices as $device) {
            $this->assertDatabaseHas('devices', [
                'id' => $device->id,
                'warranty_expiry' => '2025-12-31',
                'warranty_type' => 'Extended',
            ]);
        }
    }
}
