<?php

declare(strict_types=1);




namespace Modules\TechPlanner\Tests\Unit\Models;
use Modules\TechPlanner\Models\Machine;
use Modules\TechPlanner\Tests\Unit\Models\TestCase;

/**
 * Test unitario per il modello Machine.
 *
 * @covers \Modules\TechPlanner\Models\Machine
 */
class MachineTest extends TestCase
{

    private Machine $machine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->machine = Machine::factory()->create();
    }

    /** @test */
    public function it_can_create_machine(): void
    {
        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'name' => $this->machine->name,
            'model' => $this->machine->model,
            'serial_number' => $this->machine->serial_number,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->machine->delete();
        $this->assertSoftDeleted('machines', ['id' => $this->machine->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->machine->delete();
        $this->machine->restore();
        $this->assertDatabaseHas('machines', ['id' => $this->machine->id]);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        Machine::factory()->create(['is_active' => true]);
        Machine::factory()->create(['is_active' => false]);

        $activeMachines = Machine::active()->get();
        $this->assertEquals(1, $activeMachines->count());
    }

    /** @test */
    public function it_has_type_scope(): void
    {
        Machine::factory()->create(['type' => 'production']);
        Machine::factory()->create(['type' => 'maintenance']);

        $productionMachines = Machine::ofType('production')->get();
        $this->assertEquals(1, $productionMachines->count());
    }

    /** @test */
    public function it_has_status_scope(): void
    {
        Machine::factory()->create(['status' => 'operational']);
        Machine::factory()->create(['status' => 'maintenance']);

        $operationalMachines = Machine::withStatus('operational')->get();
        $this->assertEquals(1, $operationalMachines->count());
    }

    /** @test */
    public function it_has_location_scope(): void
    {
        Machine::factory()->create(['location_id' => 1]);
        Machine::factory()->create(['location_id' => 2]);

        $location1Machines = Machine::inLocation(1)->get();
        $this->assertEquals(1, $location1Machines->count());
    }

    /** @test */
    public function it_handles_machine_description(): void
    {
        $description = 'Macchina di produzione per componenti automotive';
        $this->machine->description = $description;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'description' => $description,
        ]);
    }

    /** @test */
    public function it_handles_machine_manufacturer(): void
    {
        $manufacturer = 'Bosch';
        $this->machine->manufacturer = $manufacturer;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'manufacturer' => $manufacturer,
        ]);
    }

    /** @test */
    public function it_handles_machine_specifications(): void
    {
        $specifications = [
            'power' => '50 kW',
            'speed' => '1000 RPM',
            'weight' => '2000 kg',
            'dimensions' => '3m x 2m x 2.5m'
        ];
        $this->machine->specifications = $specifications;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'specifications' => json_encode($specifications),
        ]);
    }

    /** @test */
    public function it_handles_machine_installation_date(): void
    {
        $installationDate = '2023-01-15';
        $this->machine->installation_date = $installationDate;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'installation_date' => $installationDate,
        ]);
    }

    /** @test */
    public function it_handles_machine_warranty_expiry(): void
    {
        $warrantyExpiry = '2026-01-15';
        $this->machine->warranty_expiry = $warrantyExpiry;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'warranty_expiry' => $warrantyExpiry,
        ]);
    }

    /** @test */
    public function it_handles_machine_maintenance_schedule(): void
    {
        $maintenanceSchedule = [
            'daily' => ['Check oil level', 'Clean filters'],
            'weekly' => ['Lubricate moving parts', 'Check belts'],
            'monthly' => ['Full inspection', 'Calibration check'],
            'yearly' => ['Major overhaul', 'Replace worn parts']
        ];
        $this->machine->maintenance_schedule = $maintenanceSchedule;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'maintenance_schedule' => json_encode($maintenanceSchedule),
        ]);
    }

    /** @test */
    public function it_handles_machine_operating_hours(): void
    {
        $operatingHours = 8760; // 1 anno
        $this->machine->operating_hours = $operatingHours;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'operating_hours' => $operatingHours,
        ]);
    }

    /** @test */
    public function it_handles_machine_efficiency(): void
    {
        $efficiency = 95.5;
        $this->machine->efficiency = $efficiency;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'efficiency' => $efficiency,
        ]);
    }

    /** @test */
    public function it_handles_machine_cost(): void
    {
        $cost = 150000.00;
        $this->machine->cost = $cost;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'cost' => $cost,
        ]);
    }

    /** @test */
    public function it_handles_machine_depreciation_rate(): void
    {
        $depreciationRate = 20.0; // 20% annuo
        $this->machine->depreciation_rate = $depreciationRate;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'depreciation_rate' => $depreciationRate,
        ]);
    }

    /** @test */
    public function it_handles_machine_notes(): void
    {
        $notes = 'Macchina acquistata per espandere la capacità produttiva';
        $this->machine->notes = $notes;
        $this->machine->save();

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->machine->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('model', $array);
        $this->assertArrayHasKey('serial_number', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->machine->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('name', $json);
        $this->assertStringContainsString('model', $json);
    }

    /** @test */
    public function it_handles_machine_status(): void
    {
        $this->machine->status = 'operational';
        $this->machine->save();

        $this->assertTrue($this->machine->isOperational());
    }

    /** @test */
    public function it_handles_machine_type(): void
    {
        $this->machine->type = 'production';
        $this->machine->save();

        $this->assertTrue($this->machine->isProductionMachine());
    }

    /** @test */
    public function it_has_warranty_status_accessor(): void
    {
        $this->machine->warranty_expiry = now()->addDays(30);
        $this->machine->save();

        $this->assertTrue($this->machine->hasValidWarranty());
    }

    /** @test */
    public function it_has_age_accessor(): void
    {
        $this->machine->installation_date = now()->subYears(2);
        $this->machine->save();

        $this->assertEquals(2, $this->machine->age_years);
    }

    /** @test */
    public function it_has_maintenance_due_accessor(): void
    {
        $this->machine->last_maintenance = now()->subMonths(7);
        $this->machine->maintenance_interval_months = 6;
        $this->machine->save();

        $this->assertTrue($this->machine->isMaintenanceDue());
    }

    /** @test */
    public function it_has_efficiency_rating_accessor(): void
    {
        $this->machine->efficiency = 85.0;
        $this->machine->save();

        $this->assertEquals('Good', $this->machine->efficiency_rating);
    }
}
