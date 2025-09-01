<?php

declare(strict_types=1);




namespace Modules\TechPlanner\Tests\Unit\Models;
use Modules\TechPlanner\Models\Worker;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\Appointment;
use Modules\TechPlanner\Models\PhoneCall;
use Modules\TechPlanner\Tests\Unit\Models\TestCase;

/**
 * Test unitario per il modello Worker.
 *
 * @covers \Modules\TechPlanner\Models\Worker
 */
class WorkerTest extends TestCase
{

    private Worker $worker;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->worker = Worker::factory()->create();
    }

    /** @test */
    public function it_has_correct_table_name(): void
    {
        $this->assertEquals('workers', $this->worker->getTable());
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $expectedFillable = [
            'name',
            'surname',
            'email',
            'phone',
            'mobile',
            'address',
            'city',
            'postal_code',
            'country',
            'tax_code',
            'position',
            'department',
            'hire_date',
            'salary',
            'is_active',
            'notes',
            'emergency_contact_name',
            'emergency_contact_phone',
            'emergency_contact_relationship',
        ];

        $this->assertEquals($expectedFillable, $this->worker->getFillable());
    }

    /** @test */
    public function it_has_correct_hidden_fields(): void
    {
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $this->worker->getHidden());
    }

    /** @test */
    public function it_has_correct_dates(): void
    {
        $expectedDates = [
            'created_at',
            'updated_at',
            'deleted_at',
            'hire_date',
        ];

        $this->assertEquals($expectedDates, $this->worker->getDates());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $expectedCasts = [
            'id' => 'int',
            'salary' => 'decimal:2',
            'is_active' => 'boolean',
            'hire_date' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        $this->assertEquals($expectedCasts, $this->worker->getCasts());
    }

    /** @test */
    public function it_has_many_assigned_clients(): void
    {
        $clients = Client::factory()->count(3)->create([
            'assigned_worker_id' => $this->worker->id,
        ]);

        $this->assertCount(3, $this->worker->assignedClients);
        $this->assertInstanceOf(Client::class, $this->worker->assignedClients->first());
    }

    /** @test */
    public function it_has_many_devices(): void
    {
        $devices = Device::factory()->count(2)->create([
            'assigned_worker_id' => $this->worker->id,
        ]);

        $this->assertCount(2, $this->worker->devices);
        $this->assertInstanceOf(Device::class, $this->worker->devices->first());
    }

    /** @test */
    public function it_has_many_appointments(): void
    {
        $appointments = Appointment::factory()->count(2)->create([
            'worker_id' => $this->worker->id,
        ]);

        $this->assertCount(2, $this->worker->appointments);
        $this->assertInstanceOf(Appointment::class, $this->worker->appointments->first());
    }

    /** @test */
    public function it_has_many_phone_calls(): void
    {
        $phoneCalls = PhoneCall::factory()->count(2)->create([
            'worker_id' => $this->worker->id,
        ]);

        $this->assertCount(2, $this->worker->phoneCalls);
        $this->assertInstanceOf(PhoneCall::class, $this->worker->phoneCalls->first());
    }

    /** @test */
    public function it_can_be_soft_deleted(): void
    {
        $workerId = $this->worker->id;
        
        $this->worker->delete();
        
        $this->assertSoftDeleted('workers', ['id' => $workerId]);
        $this->assertDatabaseMissing('workers', ['id' => $workerId]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $workerId = $this->worker->id;
        
        $this->worker->delete();
        $this->assertSoftDeleted('workers', ['id' => $workerId]);
        
        $restoredWorker = Worker::withTrashed()->find($workerId);
        $restoredWorker->restore();
        
        $this->assertDatabaseHas('workers', ['id' => $workerId]);
        $this->assertNull($restoredWorker->deleted_at);
    }

    /** @test */
    public function it_has_full_name_attribute(): void
    {
        $this->worker->update([
            'name' => 'Mario',
            'surname' => 'Rossi',
        ]);

        $this->assertEquals('Mario Rossi', $this->worker->full_name);
    }

    /** @test */
    public function it_has_full_address_attribute(): void
    {
        $this->worker->update([
            'address' => 'Via Roma 123',
            'city' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
        ]);

        $expectedAddress = 'Via Roma 123, 20100 Milano, Italia';
        $this->assertEquals($expectedAddress, $this->worker->full_address);
    }

    /** @test */
    public function it_has_emergency_contact_full_info_attribute(): void
    {
        $this->worker->update([
            'emergency_contact_name' => 'Giulia Bianchi',
            'emergency_contact_phone' => '+39 123 456 7890',
            'emergency_contact_relationship' => 'Moglie',
        ]);

        $expectedInfo = 'Giulia Bianchi (Moglie) - +39 123 456 7890';
        $this->assertEquals($expectedInfo, $this->worker->emergency_contact_full_info);
    }

    /** @test */
    public function it_has_is_active_scope(): void
    {
        $activeWorker = Worker::factory()->create(['is_active' => true]);
        $inactiveWorker = Worker::factory()->create(['is_active' => false]);

        $activeWorkers = Worker::active()->get();

        $this->assertTrue($activeWorkers->contains($activeWorker));
        $this->assertFalse($activeWorkers->contains($inactiveWorker));
    }

    /** @test */
    public function it_has_by_department_scope(): void
    {
        $techWorker = Worker::factory()->create(['department' => 'Tecnico']);
        $adminWorker = Worker::factory()->create(['department' => 'Amministrativo']);

        $techWorkers = Worker::byDepartment('Tecnico')->get();

        $this->assertTrue($techWorkers->contains($techWorker));
        $this->assertFalse($techWorkers->contains($adminWorker));
    }

    /** @test */
    public function it_has_by_position_scope(): void
    {
        $technicianWorker = Worker::factory()->create(['position' => 'Tecnico']);
        $managerWorker = Worker::factory()->create(['position' => 'Manager']);

        $technicianWorkers = Worker::byPosition('Tecnico')->get();

        $this->assertTrue($technicianWorkers->contains($technicianWorker));
        $this->assertFalse($technicianWorkers->contains($managerWorker));
    }

    /** @test */
    public function it_has_by_hire_date_scope(): void
    {
        $recentWorker = Worker::factory()->create(['hire_date' => now()->subMonths(6)]);
        $oldWorker = Worker::factory()->create(['hire_date' => now()->subYears(5)]);

        $recentWorkers = Worker::byHireDate(now()->subYear())->get();

        $this->assertTrue($recentWorkers->contains($recentWorker));
        $this->assertFalse($recentWorkers->contains($oldWorker));
    }

    /** @test */
    public function it_has_search_scope(): void
    {
        $marioWorker = Worker::factory()->create(['name' => 'Mario Rossi']);
        $giuliaWorker = Worker::factory()->create(['name' => 'Giulia Bianchi']);

        $searchResults = Worker::search('Mario')->get();

        $this->assertTrue($searchResults->contains($marioWorker));
        $this->assertFalse($searchResults->contains($giuliaWorker));
    }

    /** @test */
    public function it_has_available_scope(): void
    {
        $availableWorker = Worker::factory()->create(['is_active' => true]);
        $unavailableWorker = Worker::factory()->create(['is_active' => false]);

        $availableWorkers = Worker::available()->get();

        $this->assertTrue($availableWorkers->contains($availableWorker));
        $this->assertFalse($availableWorkers->contains($unavailableWorker));
    }

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Worker::create([]);
    }

    /** @test */
    public function it_validates_email_format(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Worker::create([
            'name' => 'Test Worker',
            'email' => 'invalid-email',
        ]);
    }

    /** @test */
    public function it_has_correct_mutators(): void
    {
        $this->worker->update([
            'name' => '  mario  ',
            'email' => '  MARIO@EXAMPLE.COM  ',
            'phone' => '  +39 123 456 789  ',
        ]);

        $this->assertEquals('mario', $this->worker->name);
        $this->assertEquals('mario@example.com', $this->worker->email);
        $this->assertEquals('+39 123 456 789', $this->worker->phone);
    }

    /** @test */
    public function it_has_correct_accessors(): void
    {
        $this->worker->update([
            'hire_date' => '2023-01-15',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $this->worker->hire_date);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->worker->created_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->worker->updated_at);
    }

    /** @test */
    public function it_can_be_serialized_to_array(): void
    {
        $array = $this->worker->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('position', $array);
    }

    /** @test */
    public function it_can_be_serialized_to_json(): void
    {
        $json = $this->worker->toJson();

        $this->assertIsString($json);
        $this->assertJson($json);
    }

    /** @test */
    public function it_has_workload_calculation(): void
    {
        // Crea alcuni clienti assegnati
        $clients = Client::factory()->count(5)->create([
            'assigned_worker_id' => $this->worker->id,
        ]);

        // Crea alcuni appuntamenti
        $appointments = Appointment::factory()->count(3)->create([
            'worker_id' => $this->worker->id,
        ]);

        $workload = $this->worker->calculateWorkload();

        $this->assertEquals(5, $workload['clients_count']);
        $this->assertEquals(3, $workload['appointments_count']);
        $this->assertIsArray($workload);
    }

    /** @test */
    public function it_has_performance_metrics(): void
    {
        // Simula metriche di performance
        $this->worker->update([
            'completed_tasks' => 25,
            'total_tasks' => 30,
        ]);

        $performance = $this->worker->getPerformanceMetrics();

        $this->assertEquals(83.33, $performance['completion_rate']);
        $this->assertEquals(25, $performance['completed_tasks']);
        $this->assertEquals(30, $performance['total_tasks']);
    }

    /** @test */
    public function it_can_be_promoted(): void
    {
        $this->worker->update(['position' => 'Tecnico']);

        $this->worker->promote('Senior Tecnico');

        $this->assertEquals('Senior Tecnico', $this->worker->position);
        $this->assertDatabaseHas('workers', [
            'id' => $this->worker->id,
            'position' => 'Senior Tecnico',
        ]);
    }

    /** @test */
    public function it_can_be_transferred(): void
    {
        $this->worker->update(['department' => 'Tecnico']);

        $this->worker->transfer('Amministrativo');

        $this->assertEquals('Amministrativo', $this->worker->department);
        $this->assertDatabaseHas('workers', [
            'id' => $this->worker->id,
            'department' => 'Amministrativo',
        ]);
    }

    /** @test */
    public function it_has_salary_management(): void
    {
        $this->worker->update(['salary' => 2500.00]);

        $this->worker->updateSalary(2800.00);

        $this->assertEquals(2800.00, $this->worker->salary);
        $this->assertDatabaseHas('workers', [
            'id' => $this->worker->id,
            'salary' => 2800.00,
        ]);
    }

    /** @test */
    public function it_has_availability_check(): void
    {
        $this->worker->update(['is_active' => true]);

        $this->assertTrue($this->worker->isAvailable());

        $this->worker->update(['is_active' => false]);

        $this->assertFalse($this->worker->isAvailable());
    }

    /** @test */
    public function it_has_emergency_contact_validation(): void
    {
        $this->worker->update([
            'emergency_contact_name' => 'Giulia Bianchi',
            'emergency_contact_phone' => '+39 123 456 7890',
            'emergency_contact_relationship' => 'Moglie',
        ]);

        $this->assertTrue($this->worker->hasEmergencyContact());

        $this->worker->update(['emergency_contact_name' => null]);

        $this->assertFalse($this->worker->hasEmergencyContact());
    }
}
