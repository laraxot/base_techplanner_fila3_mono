<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;
use Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages\CreateAppointment;
use Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages\EditAppointment;
use Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages\ListAppointments;
use Modules\TechPlanner\Models\Appointment;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Worker;
use Modules\User\Models\User;
use Tests\TestCase;
class AppointmentResourceTest extends TestCase
{
    protected User $admin;

    protected Client $client;

class AppointmentResourceTest extends TestCase
{

    protected User $admin;
    protected Client $client;

    protected Worker $worker;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->client = Client::factory()->create();
        $this->worker = Worker::factory()->create();
    }

    /** @test */
    public function it_can_list_appointments(): void
    {
        Appointment::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(AppointmentResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListAppointments::class);
    }

    /** @test */
    public function it_can_create_appointment(): void
    {
        $appointmentData = [
            'title' => 'Test Appointment',
            'start_time' => '2024-06-15 10:00:00',
            'client_id' => $this->client->id,
            'status' => 'scheduled',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateAppointment::class)
            ->fillForm($appointmentData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('appointments', [
            'title' => 'Test Appointment',
            'client_id' => $this->client->id,
        ]);
    }

    /** @test */
    public function it_can_edit_appointment(): void
    {
        $appointment = Appointment::factory()->create([
            'title' => 'Original Appointment',
        ]);

        $updatedData = [
            'title' => 'Updated Appointment',
            'status' => 'confirmed',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditAppointment::class, ['record' => $appointment->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'title' => 'Updated Appointment',
            'status' => 'confirmed',
        ]);
    }

    /** @test */
    public function it_can_delete_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListAppointments::class)
            ->callTableAction('delete', $appointment)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('appointments', ['id' => $appointment->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateAppointment::class)
            ->fillForm([
                'title' => '',
                'start_time' => '',
                'client_id' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['title', 'start_time', 'client_id']);
    }

    /** @test */
    public function it_can_search_appointments(): void
    {
        Appointment::factory()->create(['title' => 'Medical Consultation']);
        Appointment::factory()->create(['title' => 'Technical Review']);

        Livewire::actingAs($this->admin)
            ->test(ListAppointments::class)
            ->searchTable('Medical')
            ->assertCanSeeTableRecords(['Medical Consultation'])
            ->assertCanSeeTableRecord('Medical Consultation')
            ->assertCanNotSeeTableRecord('Technical Review');
    }

    /** @test */
    public function it_can_filter_appointments_by_status(): void
    {
        Appointment::factory()->create(['status' => 'scheduled']);
        Appointment::factory()->create(['status' => 'confirmed']);

        Livewire::actingAs($this->admin)
            ->test(ListAppointments::class)
            ->filterTable('status', 'scheduled')
            ->assertCanSeeTableRecords(['Scheduled Appointment']);
    }

    /** @test */
    public function it_can_bulk_delete_appointments(): void
    {
        $appointments = Appointment::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListAppointments::class)
            ->selectTableRecords($appointments->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($appointments as $appointment) {
            $this->assertSoftDeleted('appointments', ['id' => $appointment->id]);
        }
    }

    /** @test */
    public function it_can_view_appointment_details(): void
    {
        $appointment = Appointment::factory()->create([
            'title' => 'Test Appointment',
            'start_time' => '2024-06-15 10:00:00',
        ]);

        $this->actingAs($this->admin)
            ->get(AppointmentResource::getUrl('view', ['record' => $appointment->id]))
            ->assertSuccessful()
            ->assertSee('Test Appointment');
    }

    /** @test */
    public function it_handles_soft_deleted_appointments_correctly(): void
    {
        $appointment = Appointment::factory()->create();
        $appointment->delete();

        Livewire::actingAs($this->admin)
            ->test(ListAppointments::class)
            ->assertCanNotSeeTableRecord($appointment);

        $this->actingAs($this->admin)
            ->patch(AppointmentResource::getUrl('restore', ['record' => $appointment->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'deleted_at' => null,
        ]);
    }
}
