<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\DeviceResource;
use Modules\TechPlanner\Filament\Resources\DeviceResource\Pages\CreateDevice;
use Modules\TechPlanner\Filament\Resources\DeviceResource\Pages\EditDevice;
use Modules\TechPlanner\Filament\Resources\DeviceResource\Pages\ListDevices;
use Modules\TechPlanner\Models\Device;
use Modules\User\Models\User;
use Tests\TestCase;

class DeviceResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crea un utente admin per i test
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
    }

    /** @test */
    public function it_can_list_devices(): void
    {
        // Crea alcuni dispositivi di test
        Device::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(DeviceResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListDevices::class);
    }

    /** @test */
    public function it_can_create_device(): void
    {
        $deviceData = [
            'name' => 'Test Device',
            'type' => 'computer',
            'model' => 'Dell XPS 13',
            'serial_number' => 'SN123456789',
            'manufacturer' => 'Dell',
            'status' => 'active',
            'location' => 'Office A',
            'description' => 'Laptop per sviluppo',
            'purchase_date' => '2023-01-15',
            'warranty_expiry' => '2026-01-15',
            'notes' => 'Dispositivo di test',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm($deviceData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('devices', [
            'name' => 'Test Device',
            'type' => 'computer',
            'serial_number' => 'SN123456789',
        ]);
    }

    /** @test */
    public function it_can_edit_device(): void
    {
        $device = Device::factory()->create([
            'name' => 'Original Device',
            'type' => 'computer',
        ]);

        $updatedData = [
            'name' => 'Updated Device',
            'type' => 'printer',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditDevice::class, ['record' => $device->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'name' => 'Updated Device',
            'type' => 'printer',
        ]);
    }

    /** @test */
    public function it_can_delete_device(): void
    {
        $device = Device::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->callTableAction('delete', $device)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('devices', ['id' => $device->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => '', // Campo richiesto vuoto
                'type' => '', // Campo richiesto vuoto
            ])
            ->call('create')
            ->assertHasFormErrors(['name', 'type']);
    }

    /** @test */
    public function it_validates_device_type_values(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => 'Test Device',
                'type' => 'invalid_type', // Tipo non valido
            ])
            ->call('create')
            ->assertHasFormErrors(['type']);
    }

    /** @test */
    public function it_validates_serial_number_uniqueness(): void
    {
        Device::factory()->create(['serial_number' => 'SN123456789']);

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => 'Test Device',
                'type' => 'computer',
                'serial_number' => 'SN123456789', // Serial number già esistente
            ])
            ->call('create')
            ->assertHasFormErrors(['serial_number']);
    }

    /** @test */
    public function it_can_search_devices(): void
    {
        Device::factory()->create(['name' => 'Dell Laptop']);
        Device::factory()->create(['name' => 'HP Printer']);

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->searchTable('Dell')
            ->assertCanSeeTableRecords(['Dell Laptop'])
            ->assertCanSeeTableRecord('Dell Laptop')
            ->assertCanNotSeeTableRecord('HP Printer');
    }

    /** @test */
    public function it_can_filter_devices_by_type(): void
    {
        Device::factory()->create(['type' => 'computer']);
        Device::factory()->create(['type' => 'printer']);

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->filterTable('type', 'computer')
            ->assertCanSeeTableRecords(['Computer Device']);
    }

    /** @test */
    public function it_can_filter_devices_by_status(): void
    {
        Device::factory()->create(['status' => 'active']);
        Device::factory()->create(['status' => 'maintenance']);

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->filterTable('status', 'active')
            ->assertCanSeeTableRecords(['Active Device']);
    }

    /** @test */
    public function it_can_bulk_delete_devices(): void
    {
        $devices = Device::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->selectTableRecords($devices->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($devices as $device) {
            $this->assertSoftDeleted('devices', ['id' => $device->id]);
        }
    }

    /** @test */
    public function it_can_export_devices(): void
    {
        Device::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_device_details(): void
    {
        $device = Device::factory()->create([
            'name' => 'Test Device',
            'type' => 'computer',
            'serial_number' => 'SN123456789',
        ]);

        $this->actingAs($this->admin)
            ->get(DeviceResource::getUrl('view', ['record' => $device->id]))
            ->assertSuccessful()
            ->assertSee('Test Device')
            ->assertSee('computer')
            ->assertSee('SN123456789');
    }

    /** @test */
    public function it_handles_soft_deleted_devices_correctly(): void
    {
        $device = Device::factory()->create();
        $device->delete();

        // Verifica che il dispositivo soft-deleted non sia visibile nella lista
        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->assertCanNotSeeTableRecord($device);

        // Verifica che sia possibile ripristinare il dispositivo
        $this->actingAs($this->admin)
            ->patch(DeviceResource::getUrl('restore', ['record' => $device->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_duplicate_device(): void
    {
        $device = Device::factory()->create([
            'name' => 'Original Device',
            'type' => 'computer',
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListDevices::class)
            ->callTableAction('duplicate', $device)
            ->assertHasNoTableActionErrors();

        // Verifica che sia stato creato un duplicato
        $this->assertDatabaseHas('devices', [
            'name' => 'Original Device (Copy)',
            'type' => 'computer',
        ]);
    }

    /** @test */
    public function it_validates_serial_number_on_edit_except_self(): void
    {
        $device1 = Device::factory()->create(['serial_number' => 'SN111111111']);
        $device2 = Device::factory()->create(['serial_number' => 'SN222222222']);

        // Modifica device1 con serial number di device2 (dovrebbe fallire)
        Livewire::actingAs($this->admin)
            ->test(EditDevice::class, ['record' => $device1->id])
            ->fillForm(['serial_number' => 'SN222222222'])
            ->call('save')
            ->assertHasFormErrors(['serial_number']);

        // Modifica device1 con il suo stesso serial number (dovrebbe funzionare)
        Livewire::actingAs($this->admin)
            ->test(EditDevice::class, ['record' => $device1->id])
            ->fillForm(['serial_number' => 'SN111111111'])
            ->call('save')
            ->assertHasNoFormErrors();
    }

    /** @test */
    public function it_can_handle_specifications_json_field(): void
    {
        $specifications = [
            'cpu' => 'Intel i7-1165G7',
            'ram' => '16GB DDR4',
            'storage' => '512GB SSD',
            'display' => '13.4" FHD',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => 'Test Device',
                'type' => 'computer',
                'specifications' => json_encode($specifications),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', [
            'name' => 'Test Device',
            'specifications' => json_encode($specifications),
        ]);
    }

    /** @test */
    public function it_can_handle_maintenance_schedule_json_field(): void
    {
        $maintenanceSchedule = [
            'last_maintenance' => '2024-01-15',
            'next_maintenance' => '2024-07-15',
            'maintenance_type' => 'preventive',
            'technician' => 'John Doe',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => 'Test Device',
                'type' => 'computer',
                'maintenance_schedule' => json_encode($maintenanceSchedule),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', [
            'name' => 'Test Device',
            'maintenance_schedule' => json_encode($maintenanceSchedule),
        ]);
    }

    /** @test */
    public function it_can_handle_dates_correctly(): void
    {
        $dateData = [
            'purchase_date' => '2023-01-15',
            'warranty_expiry' => '2026-01-15',
            'last_maintenance' => '2024-01-15',
            'next_maintenance' => '2024-07-15',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm(array_merge([
                'name' => 'Test Device',
                'type' => 'computer',
            ], $dateData))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', $dateData);
    }

    /** @test */
    public function it_can_handle_numeric_fields(): void
    {
        $numericData = [
            'purchase_price' => 1299.99,
            'current_value' => 899.99,
            'depreciation_rate' => 0.15,
            'operating_hours' => 2400,
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm(array_merge([
                'name' => 'Test Device',
                'type' => 'computer',
            ], $numericData))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', $numericData);
    }

    /** @test */
    public function it_can_handle_boolean_fields(): void
    {
        $booleanData = [
            'is_active' => true,
            'requires_maintenance' => false,
            'is_under_warranty' => true,
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm(array_merge([
                'name' => 'Test Device',
                'type' => 'computer',
            ], $booleanData))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', $booleanData);
    }

    /** @test */
    public function it_can_handle_metadata_field(): void
    {
        $metadata = [
            'department' => 'IT',
            'assigned_to' => 'John Doe',
            'priority' => 'high',
            'tags' => ['hardware', 'laptop', 'development'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateDevice::class)
            ->fillForm([
                'name' => 'Test Device',
                'type' => 'computer',
                'metadata' => json_encode($metadata),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('devices', [
            'name' => 'Test Device',
            'metadata' => json_encode($metadata),
        ]);
    }
}
