<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\Device;use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\DeviceVerification;
use Modules\TechPlanner\Models\Worker;

/**
 * Test unitario per il modello Device.
 *
 * @covers \Modules\TechPlanner\Models\Device
 */
class DeviceTest extends TestCase
{
    use RefreshDatabase;
    private Device $device;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->device = Device::factory()->create();
    }

    /** @test */
    public function it_has_correct_table_name(): void
    {
        $this->assertEquals('devices', $this->device->getTable());
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $expectedFillable = [
            'name',
            'model',
            'serial_number',
            'manufacturer',
            'type',
            'status',
            'location',
            'purchase_date',
            'warranty_expiry',
            'last_maintenance',
            'next_maintenance',
            'notes',
            'client_id',
            'assigned_worker_id',
            'is_active',
            'specifications',
            'purchase_price',
            'current_value',
        ];

        $this->assertEquals($expectedFillable, $this->device->getFillable());
    }

    /** @test */
    public function it_has_correct_hidden_fields(): void
    {
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $this->device->getHidden());
    }

    /** @test */
    public function it_has_correct_dates(): void
    {
        $expectedDates = [
            'created_at',
            'updated_at',
            'deleted_at',
            'purchase_date',
            'warranty_expiry',
            'last_maintenance',
            'next_maintenance',
        ];

        $this->assertEquals($expectedDates, $this->device->getDates());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $expectedCasts = [
            'id' => 'int',
            'client_id' => 'int',
            'assigned_worker_id' => 'int',
            'purchase_price' => 'decimal:2',
            'current_value' => 'decimal:2',
            'is_active' => 'boolean',
            'specifications' => 'array',
            'purchase_date' => 'date',
            'warranty_expiry' => 'date',
            'last_maintenance' => 'date',
            'next_maintenance' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        $this->assertEquals($expectedCasts, $this->device->getCasts());
    }

    /** @test */
    public function it_belongs_to_client(): void
    {
        $client = Client::factory()->create();
        $this->device->update(['client_id' => $client->id]);

        $this->assertInstanceOf(Client::class, $this->device->client);
        $this->assertEquals($client->id, $this->device->client->id);
    }

    /** @test */
    public function it_belongs_to_assigned_worker(): void
    {
        $worker = Worker::factory()->create();
        $this->device->update(['assigned_worker_id' => $worker->id]);

        $this->assertInstanceOf(Worker::class, $this->device->assignedWorker);
        $this->assertEquals($worker->id, $this->device->assignedWorker->id);
    }

    /** @test */
    public function it_has_many_device_verifications(): void
    {
        $verifications = DeviceVerification::factory()->count(3)->create([
            'device_id' => $this->device->id,
        ]);

        $this->assertCount(3, $this->device->deviceVerifications);
        $this->assertInstanceOf(DeviceVerification::class, $this->device->deviceVerifications->first());
    }

    /** @test */
    public function it_can_be_soft_deleted(): void
    {
        $deviceId = $this->device->id;
        
        $this->device->delete();
        

        $this->device->delete();

        
        $this->device->delete();
        
        $this->assertSoftDeleted('devices', ['id' => $deviceId]);
        $this->assertDatabaseMissing('devices', ['id' => $deviceId]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $deviceId = $this->device->id;
        
        $this->device->delete();
        $this->assertSoftDeleted('devices', ['id' => $deviceId]);

        $restoredDevice = Device::withTrashed()->find($deviceId);
        $restoredDevice->restore();
        

        
        $this->device->delete();
        $this->assertSoftDeleted('devices', ['id' => $deviceId]);
        
        $restoredDevice = Device::withTrashed()->find($deviceId);
        $restoredDevice->restore();

        
        $this->assertDatabaseHas('devices', ['id' => $deviceId]);
        $this->assertNull($restoredDevice->deleted_at);
    }

    /** @test */
    public function it_has_full_name_attribute(): void
    {
        $this->device->update([
            'name' => 'Scanner',
            'model' => 'Pro 2000',
            'manufacturer' => 'TechCorp',
        ]);

        $this->assertEquals('TechCorp Scanner Pro 2000', $this->device->full_name);
    }

    /** @test */
    public function it_has_is_active_scope(): void
    {
        $activeDevice = Device::factory()->create(['is_active' => true]);
        $inactiveDevice = Device::factory()->create(['is_active' => false]);

        $activeDevices = Device::active()->get();

        $this->assertTrue($activeDevices->contains($activeDevice));
        $this->assertFalse($activeDevices->contains($inactiveDevice));
    }

    /** @test */
    public function it_has_by_type_scope(): void
    {
        $scannerDevice = Device::factory()->create(['type' => 'Scanner']);
        $printerDevice = Device::factory()->create(['type' => 'Printer']);

        $scannerDevices = Device::byType('Scanner')->get();

        $this->assertTrue($scannerDevices->contains($scannerDevice));
        $this->assertFalse($scannerDevices->contains($printerDevice));
    }

    /** @test */
    public function it_has_by_status_scope(): void
    {
        $workingDevice = Device::factory()->create(['status' => 'Working']);
        $brokenDevice = Device::factory()->create(['status' => 'Broken']);

        $workingDevices = Device::byStatus('Working')->get();

        $this->assertTrue($workingDevices->contains($workingDevice));
        $this->assertFalse($workingDevices->contains($brokenDevice));
    }

    /** @test */
    public function it_has_by_manufacturer_scope(): void
    {
        $techcorpDevice = Device::factory()->create(['manufacturer' => 'TechCorp']);
        $otherDevice = Device::factory()->create(['manufacturer' => 'OtherCorp']);

        $techcorpDevices = Device::byManufacturer('TechCorp')->get();

        $this->assertTrue($techcorpDevices->contains($techcorpDevice));
        $this->assertFalse($techcorpDevices->contains($otherDevice));
    }

    /** @test */
    public function it_has_by_client_scope(): void
    {
        $client = Client::factory()->create();
        $clientDevice = Device::factory()->create(['client_id' => $client->id]);
        $otherDevice = Device::factory()->create(['client_id' => null]);

        $clientDevices = Device::byClient($client->id)->get();

        $this->assertTrue($clientDevices->contains($clientDevice));
        $this->assertFalse($clientDevices->contains($otherDevice));
    }

    /** @test */
    public function it_has_by_worker_scope(): void
    {
        $worker = Worker::factory()->create();
        $assignedDevice = Device::factory()->create(['assigned_worker_id' => $worker->id]);
        $unassignedDevice = Device::factory()->create(['assigned_worker_id' => null]);

        $assignedDevices = Device::byWorker($worker->id)->get();

        $this->assertTrue($assignedDevices->contains($assignedDevice));
        $this->assertFalse($assignedDevices->contains($unassignedDevice));
    }

    /** @test */
    public function it_has_search_scope(): void
    {
        $scannerDevice = Device::factory()->create(['name' => 'Scanner Pro']);
        $printerDevice = Device::factory()->create(['name' => 'Printer Elite']);

        $searchResults = Device::search('Scanner')->get();

        $this->assertTrue($searchResults->contains($scannerDevice));
        $this->assertFalse($searchResults->contains($printerDevice));
    }

    /** @test */
    public function it_has_warranty_expired_scope(): void
    {
        $expiredDevice = Device::factory()->create(['warranty_expiry' => now()->subDays(30)]);
        $validDevice = Device::factory()->create(['warranty_expiry' => now()->addDays(30)]);

        $expiredDevices = Device::warrantyExpired()->get();

        $this->assertTrue($expiredDevices->contains($expiredDevice));
        $this->assertFalse($expiredDevices->contains($validDevice));
    }

    /** @test */
    public function it_has_maintenance_due_scope(): void
    {
        $dueDevice = Device::factory()->create(['next_maintenance' => now()->subDays(7)]);
        $notDueDevice = Device::factory()->create(['next_maintenance' => now()->addDays(30)]);

        $dueDevices = Device::maintenanceDue()->get();

        $this->assertTrue($dueDevices->contains($dueDevice));
        $this->assertFalse($dueDevices->contains($notDueDevice));
    }

    /** @test */
    public function it_has_high_value_scope(): void
    {
        $highValueDevice = Device::factory()->create(['current_value' => 5000.00]);
        $lowValueDevice = Device::factory()->create(['current_value' => 500.00]);

        $highValueDevices = Device::highValue(1000.00)->get();

        $this->assertTrue($highValueDevices->contains($highValueDevice));
        $this->assertFalse($highValueDevices->contains($lowValueDevice));
    }

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Device::create([]);
    }

    /** @test */
    public function it_validates_serial_number_uniqueness(): void
    {
        $existingDevice = Device::factory()->create(['serial_number' => 'SN123456']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Device::create([
            'name' => 'Test Device',
            'serial_number' => 'SN123456', // Duplicato
        ]);
    }

    /** @test */
    public function it_has_correct_mutators(): void
    {
        $this->device->update([
            'name' => '  scanner  ',
            'model' => '  PRO 2000  ',
            'manufacturer' => '  TECHCORP  ',
        ]);

        $this->assertEquals('scanner', $this->device->name);
        $this->assertEquals('PRO 2000', $this->device->model);
        $this->assertEquals('TECHCORP', $this->device->manufacturer);
    }

    /** @test */
    public function it_has_correct_accessors(): void
    {
        $this->device->update([
            'purchase_date' => '2023-01-15',
            'warranty_expiry' => '2025-01-15',
            'last_maintenance' => '2024-01-15',
            'next_maintenance' => '2024-07-15',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->purchase_date);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->warranty_expiry);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->last_maintenance);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->next_maintenance);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->created_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->device->updated_at);
    }

    /** @test */
    public function it_can_be_serialized_to_array(): void
    {
        $array = $this->device->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('model', $array);
        $this->assertArrayHasKey('serial_number', $array);
    }

    /** @test */
    public function it_can_be_serialized_to_json(): void
    {
        $json = $this->device->toJson();

        $this->assertIsString($json);
        $this->assertJson($json);
    }

    /** @test */
    public function it_has_warranty_status_check(): void
    {
        $this->device->update(['warranty_expiry' => now()->addDays(30)]);

        $this->assertTrue($this->device->isUnderWarranty());

        $this->device->update(['warranty_expiry' => now()->subDays(30)]);

        $this->assertFalse($this->device->isUnderWarranty());
    }

    /** @test */
    public function it_has_maintenance_status_check(): void
    {
        $this->device->update(['next_maintenance' => now()->addDays(30)]);

        $this->assertFalse($this->device->isMaintenanceDue());

        $this->device->update(['next_maintenance' => now()->subDays(7)]);

        $this->assertTrue($this->device->isMaintenanceDue());
    }

    /** @test */
    public function it_has_value_depreciation_calculation(): void
    {
        $this->device->update([
            'purchase_price' => 1000.00,
            'purchase_date' => now()->subYears(2),
        ]);

        $depreciatedValue = $this->device->calculateDepreciatedValue();

        $this->assertLessThan(1000.00, $depreciatedValue);
        $this->assertGreaterThan(0, $depreciatedValue);
    }

    /** @test */
    public function it_can_be_assigned_to_worker(): void
    {
        $worker = Worker::factory()->create();

        $this->device->assignToWorker($worker->id);

        $this->assertEquals($worker->id, $this->device->assigned_worker_id);
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'assigned_worker_id' => $worker->id,
        ]);
    }

    /** @test */
    public function it_can_be_unassigned_from_worker(): void
    {
        $worker = Worker::factory()->create();
        $this->device->update(['assigned_worker_id' => $worker->id]);

        $this->device->unassignFromWorker();

        $this->assertNull($this->device->assigned_worker_id);
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'assigned_worker_id' => null,
        ]);
    }

    /** @test */
    public function it_can_be_scheduled_for_maintenance(): void
    {
        $maintenanceDate = now()->addDays(30);

        $this->device->scheduleMaintenance($maintenanceDate);

        $this->assertEquals($maintenanceDate->format('Y-m-d'), $this->device->next_maintenance->format('Y-m-d'));
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'next_maintenance' => $maintenanceDate->format('Y-m-d'),
        ]);
    }

    /** @test */
    public function it_can_record_maintenance_completion(): void
    {
        $maintenanceDate = now();

        $this->device->recordMaintenanceCompletion($maintenanceDate);

        $this->assertEquals($maintenanceDate->format('Y-m-d'), $this->device->last_maintenance->format('Y-m-d'));
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'last_maintenance' => $maintenanceDate->format('Y-m-d'),
        ]);
    }

    /** @test */
    public function it_has_specifications_management(): void
    {
        $specifications = [
            'cpu' => 'Intel i7',
            'ram' => '16GB',
            'storage' => '512GB SSD',
        ];

        $this->device->updateSpecifications($specifications);

        $this->assertEquals($specifications, $this->device->specifications);
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'specifications' => json_encode($specifications),
        ]);
    }

    /** @test */
    public function it_can_get_specification_value(): void
    {
        $specifications = [
            'cpu' => 'Intel i7',
            'ram' => '16GB',
        ];

        $this->device->update(['specifications' => $specifications]);

        $this->assertEquals('Intel i7', $this->device->getSpecification('cpu'));
        $this->assertEquals('16GB', $this->device->getSpecification('ram'));
        $this->assertNull($this->device->getSpecification('gpu'));
    }

    /** @test */
    public function it_has_status_transition_validation(): void
    {
        $this->device->update(['status' => 'Working']);

        // Transizione valida
        $this->device->updateStatus('Maintenance');
        $this->assertEquals('Maintenance', $this->device->status);

        // Transizione non valida (da Maintenance a Working senza completare manutenzione)
        $this->expectException(\InvalidArgumentException::class);
        $this->device->updateStatus('Working');
    }

    /** @test */
    public function it_has_location_tracking(): void
    {
        $newLocation = 'Ufficio 2, Piano 1';

        $this->device->updateLocation($newLocation);

        $this->assertEquals($newLocation, $this->device->location);
        $this->assertDatabaseHas('devices', [
            'id' => $this->device->id,
            'location' => $newLocation,
        ]);
    }

    /** @test */
    public function it_has_usage_statistics(): void
    {
        // Simula statistiche di utilizzo
        $this->device->update([
            'total_usage_hours' => 1200,
            'last_used_at' => now(),
        ]);

        $usageStats = $this->device->getUsageStatistics();

        $this->assertEquals(1200, $usageStats['total_hours']);
        $this->assertInstanceOf(\Carbon\Carbon::class, $usageStats['last_used']);
        $this->assertIsArray($usageStats);
    }
}
