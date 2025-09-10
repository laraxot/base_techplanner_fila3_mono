<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\Appointment;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Worker;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\Location;
use Tests\TestCase;

/**
 * Test unitario per il modello Appointment.
 *
 * @covers \Modules\TechPlanner\Models\Appointment
 */
class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    private Appointment $appointment;

    protected function setUp(): void
    {
        parent::setUp();
        

        $this->appointment = Appointment::factory()->create();
    }

    /** @test */
    public function it_has_correct_table_name(): void
    {
        $this->assertEquals('appointments', $this->appointment->getTable());
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $expectedFillable = [
            'title',
            'description',
            'start_time',
            'end_time',
            'status',
            'type',
            'priority',
            'client_id',
            'worker_id',
            'device_id',
            'location_id',
            'notes',
            'is_confirmed',
            'confirmation_date',
            'cancellation_reason',
            'cancelled_at',
            'cancelled_by',
            'rescheduled_from',
            'rescheduled_to',
            'reminder_sent',
            'reminder_sent_at',
            'follow_up_required',
            'follow_up_date',
            'cost',
            'payment_status',
            'payment_method',
            'insurance_info',
            'referral_source',
            'symptoms',
            'diagnosis',
            'treatment_plan',
            'prescriptions',
            'lab_results',
            'imaging_results',
            'vital_signs',
            'allergies',
            'medications',
            'family_history',
            'social_history',
            'review_of_systems',
            'physical_examination',
            'assessment',
            'plan',
            'progress_notes',
            'discharge_summary',
        ];

        $this->assertEquals($expectedFillable, $this->appointment->getFillable());
    }

    /** @test */
    public function it_has_correct_hidden_fields(): void
    {
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $this->appointment->getHidden());
    }

    /** @test */
    public function it_has_correct_dates(): void
    {
        $expectedDates = [
            'created_at',
            'updated_at',
            'deleted_at',
            'start_time',
            'end_time',
            'confirmation_date',
            'cancelled_at',
            'rescheduled_from',
            'rescheduled_to',
            'reminder_sent_at',
            'follow_up_date',
        ];

        $this->assertEquals($expectedDates, $this->appointment->getDates());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $expectedCasts = [
            'id' => 'int',
            'client_id' => 'int',
            'worker_id' => 'int',
            'device_id' => 'int',
            'location_id' => 'int',
            'cancelled_by' => 'int',
            'rescheduled_from' => 'int',
            'rescheduled_to' => 'int',
            'follow_up_date' => 'int',
            'cost' => 'decimal:2',
            'is_confirmed' => 'boolean',
            'reminder_sent' => 'boolean',
            'follow_up_required' => 'boolean',
            'symptoms' => 'array',
            'diagnosis' => 'array',
            'treatment_plan' => 'array',
            'prescriptions' => 'array',
            'lab_results' => 'array',
            'imaging_results' => 'array',
            'vital_signs' => 'array',
            'allergies' => 'array',
            'medications' => 'array',
            'family_history' => 'array',
            'social_history' => 'array',
            'review_of_systems' => 'array',
            'physical_examination' => 'array',
            'assessment' => 'array',
            'plan' => 'array',
            'progress_notes' => 'array',
            'discharge_summary' => 'array',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'confirmation_date' => 'datetime',
            'cancelled_at' => 'datetime',
            'rescheduled_from' => 'datetime',
            'rescheduled_to' => 'datetime',
            'reminder_sent_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        $this->assertEquals($expectedCasts, $this->appointment->getCasts());
    }

    /** @test */
    public function it_belongs_to_client(): void
    {
        $client = Client::factory()->create();
        $this->appointment->update(['client_id' => $client->id]);

        $this->assertInstanceOf(Client::class, $this->appointment->client);
        $this->assertEquals($client->id, $this->appointment->client->id);
    }

    /** @test */
    public function it_belongs_to_worker(): void
    {
        $worker = Worker::factory()->create();
        $this->appointment->update(['worker_id' => $worker->id]);

        $this->assertInstanceOf(Worker::class, $this->appointment->worker);
        $this->assertEquals($worker->id, $this->appointment->worker->id);
    }

    /** @test */
    public function it_belongs_to_device(): void
    {
        $device = Device::factory()->create();
        $this->appointment->update(['device_id' => $device->id]);

        $this->assertInstanceOf(Device::class, $this->appointment->device);
        $this->assertEquals($device->id, $this->appointment->device->id);
    }

    /** @test */
    public function it_belongs_to_location(): void
    {
        $location = Location::factory()->create();
        $this->appointment->update(['location_id' => $location->id]);

        $this->assertInstanceOf(Location::class, $this->appointment->location);
        $this->assertEquals($location->id, $this->appointment->location->id);
    }

    /** @test */
    public function it_can_be_soft_deleted(): void
    {
        $appointmentId = $this->appointment->id;
        

        $this->appointment->delete();
        

        $this->appointment->delete();

        
        $this->appointment->delete();
        
        $this->assertSoftDeleted('appointments', ['id' => $appointmentId]);
        $this->assertDatabaseMissing('appointments', ['id' => $appointmentId]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $appointmentId = $this->appointment->id;
        
        $this->appointment->delete();
        $this->assertSoftDeleted('appointments', ['id' => $appointmentId]);
        

        $this->appointment->delete();
        $this->assertSoftDeleted('appointments', ['id' => $appointmentId]);

        $restoredAppointment = Appointment::withTrashed()->find($appointmentId);
        $restoredAppointment->restore();
        

        
        $this->appointment->delete();
        $this->assertSoftDeleted('appointments', ['id' => $appointmentId]);
        
        $restoredAppointment = Appointment::withTrashed()->find($appointmentId);
        $restoredAppointment->restore();

        
        $this->assertDatabaseHas('appointments', ['id' => $appointmentId]);
        $this->assertNull($restoredAppointment->deleted_at);
    }

    /** @test */
    public function it_has_duration_calculation(): void
    {
        $this->appointment->update([
            'start_time' => now(),
            'end_time' => now()->addMinutes(90),
        ]);

        $duration = $this->appointment->getDuration();

        $this->assertEquals(90, $duration->inMinutes());
        $this->assertEquals(1.5, $duration->inHours());
    }

    /** @test */
    public function it_has_is_ongoing_check(): void
    {
        $now = now();
        

        // Appuntamento in corso
        $this->appointment->update([
            'start_time' => $now->subMinutes(30),
            'end_time' => $now->addMinutes(30),
        ]);

        $this->assertTrue($this->appointment->isOngoing());

        // Appuntamento passato
        $this->appointment->update([
            'start_time' => $now->subHours(2),
            'end_time' => $now->subHour(),
        ]);

        $this->assertFalse($this->appointment->isOngoing());

        // Appuntamento futuro
        $this->appointment->update([
            'start_time' => $now->addHour(),
            'end_time' => $now->addHours(2),
        ]);

        $this->assertFalse($this->appointment->isOngoing());
    }

    /** @test */
    public function it_has_is_past_check(): void
    {
        $now = now();
        

        // Appuntamento passato
        $this->appointment->update([
            'start_time' => $now->subHours(3),
            'end_time' => $now->subHours(1),
        ]);

        $this->assertTrue($this->appointment->isPast());

        // Appuntamento futuro
        $this->appointment->update([
            'start_time' => $now->addHours(1),
            'end_time' => $now->addHours(3),
        ]);

        $this->assertFalse($this->appointment->isPast());
    }

    /** @test */
    public function it_has_is_future_check(): void
    {
        $now = now();
        

        // Appuntamento futuro
        $this->appointment->update([
            'start_time' => $now->addHours(1),
            'end_time' => $now->addHours(3),
        ]);

        $this->assertTrue($this->appointment->isFuture());

        // Appuntamento passato
        $this->appointment->update([
            'start_time' => $now->subHours(3),
            'end_time' => $now->subHours(1),
        ]);

        $this->assertFalse($this->appointment->isFuture());
    }

    /** @test */
    public function it_has_is_today_check(): void
    {
        $today = now();
        

        // Appuntamento oggi
        $this->appointment->update([
            'start_time' => $today->copy()->startOfDay()->addHours(9),
            'end_time' => $today->copy()->startOfDay()->addHours(10),
        ]);

        $this->assertTrue($this->appointment->isToday());

        // Appuntamento domani
        $this->appointment->update([
            'start_time' => $today->copy()->addDay()->startOfDay()->addHours(9),
            'end_time' => $today->copy()->addDay()->startOfDay()->addHours(10),
        ]);

        $this->assertFalse($this->appointment->isToday());
    }

    /** @test */
    public function it_has_is_this_week_check(): void
    {
        $thisWeek = now();
        

        // Appuntamento questa settimana
        $this->appointment->update([
            'start_time' => $thisWeek->copy()->startOfWeek()->addDays(2)->addHours(9),
            'end_time' => $thisWeek->copy()->startOfWeek()->addDays(2)->addHours(10),
        ]);

        $this->assertTrue($this->appointment->isThisWeek());

        // Appuntamento prossima settimana
        $this->appointment->update([
            'start_time' => $thisWeek->copy()->addWeek()->startOfWeek()->addDays(2)->addHours(9),
            'end_time' => $thisWeek->copy()->addWeek()->startOfWeek()->addDays(2)->addHours(10),
        ]);

        $this->assertFalse($this->appointment->isThisWeek());
    }

    /** @test */
    public function it_has_upcoming_scope(): void
    {
        $upcomingAppointment = Appointment::factory()->create([
            'start_time' => now()->addDays(7),
        ]);
        $pastAppointment = Appointment::factory()->create([
            'start_time' => now()->subDays(7),
        ]);

        $upcomingAppointments = Appointment::upcoming()->get();

        $this->assertTrue($upcomingAppointments->contains($upcomingAppointment));
        $this->assertFalse($upcomingAppointments->contains($pastAppointment));
    }

    /** @test */
    public function it_has_past_scope(): void
    {
        $pastAppointment = Appointment::factory()->create([
            'start_time' => now()->subDays(7),
        ]);
        $upcomingAppointment = Appointment::factory()->create([
            'start_time' => now()->addDays(7),
        ]);

        $pastAppointments = Appointment::past()->get();

        $this->assertTrue($pastAppointments->contains($pastAppointment));
        $this->assertFalse($pastAppointments->contains($upcomingAppointment));
    }

    /** @test */
    public function it_has_today_scope(): void
    {
        $todayAppointment = Appointment::factory()->create([
            'start_time' => now()->startOfDay()->addHours(9),
            'end_time' => now()->startOfDay()->addHours(10),
        ]);
        $tomorrowAppointment = Appointment::factory()->create([
            'start_time' => now()->addDay()->startOfDay()->addHours(9),
            'end_time' => now()->addDay()->startOfDay()->addHours(10),
        ]);

        $todayAppointments = Appointment::today()->get();

        $this->assertTrue($todayAppointments->contains($todayAppointment));
        $this->assertFalse($todayAppointments->contains($tomorrowAppointment));
    }

    /** @test */
    public function it_has_by_status_scope(): void
    {
        $scheduledAppointment = Appointment::factory()->create(['status' => 'Scheduled']);
        $cancelledAppointment = Appointment::factory()->create(['status' => 'Cancelled']);

        $scheduledAppointments = Appointment::byStatus('Scheduled')->get();

        $this->assertTrue($scheduledAppointments->contains($scheduledAppointment));
        $this->assertFalse($scheduledAppointments->contains($cancelledAppointment));
    }

    /** @test */
    public function it_has_by_type_scope(): void
    {
        $consultationAppointment = Appointment::factory()->create(['type' => 'Consultation']);
        $treatmentAppointment = Appointment::factory()->create(['type' => 'Treatment']);

        $consultationAppointments = Appointment::byType('Consultation')->get();

        $this->assertTrue($consultationAppointments->contains($consultationAppointment));
        $this->assertFalse($consultationAppointments->contains($treatmentAppointment));
    }

    /** @test */
    public function it_has_by_priority_scope(): void
    {
        $highPriorityAppointment = Appointment::factory()->create(['priority' => 'High']);
        $lowPriorityAppointment = Appointment::factory()->create(['priority' => 'Low']);

        $highPriorityAppointments = Appointment::byPriority('High')->get();

        $this->assertTrue($highPriorityAppointments->contains($highPriorityAppointment));
        $this->assertFalse($highPriorityAppointments->contains($lowPriorityAppointment));
    }

    /** @test */
    public function it_has_by_client_scope(): void
    {
        $client = Client::factory()->create();
        $clientAppointment = Appointment::factory()->create(['client_id' => $client->id]);
        $otherAppointment = Appointment::factory()->create(['client_id' => null]);

        $clientAppointments = Appointment::byClient($client->id)->get();

        $this->assertTrue($clientAppointments->contains($clientAppointment));
        $this->assertFalse($clientAppointments->contains($otherAppointment));
    }

    /** @test */
    public function it_has_by_worker_scope(): void
    {
        $worker = Worker::factory()->create();
        $assignedAppointment = Appointment::factory()->create(['worker_id' => $worker->id]);
        $unassignedAppointment = Appointment::factory()->create(['worker_id' => null]);

        $assignedAppointments = Appointment::byWorker($worker->id)->get();

        $this->assertTrue($assignedAppointments->contains($assignedAppointment));
        $this->assertFalse($assignedAppointments->contains($unassignedAppointment));
    }

    /** @test */
    public function it_has_by_device_scope(): void
    {
        $device = Device::factory()->create();
        $deviceAppointment = Appointment::factory()->create(['device_id' => $device->id]);
        $otherAppointment = Appointment::factory()->create(['device_id' => null]);

        $deviceAppointments = Appointment::byDevice($device->id)->get();

        $this->assertTrue($deviceAppointments->contains($deviceAppointment));
        $this->assertFalse($deviceAppointments->contains($otherAppointment));
    }

    /** @test */
    public function it_has_by_location_scope(): void
    {
        $location = Location::factory()->create();
        $locationAppointment = Appointment::factory()->create(['location_id' => $location->id]);
        $otherAppointment = Appointment::factory()->create(['location_id' => null]);

        $locationAppointments = Appointment::byLocation($location->id)->get();

        $this->assertTrue($locationAppointments->contains($locationAppointment));
        $this->assertFalse($locationAppointments->contains($otherAppointment));
    }

    /** @test */
    public function it_has_confirmed_scope(): void
    {
        $confirmedAppointment = Appointment::factory()->create(['is_confirmed' => true]);
        $unconfirmedAppointment = Appointment::factory()->create(['is_confirmed' => false]);

        $confirmedAppointments = Appointment::confirmed()->get();

        $this->assertTrue($confirmedAppointments->contains($confirmedAppointment));
        $this->assertFalse($confirmedAppointments->contains($unconfirmedAppointment));
    }

    /** @test */
    public function it_has_cancelled_scope(): void
    {
        $cancelledAppointment = Appointment::factory()->create(['status' => 'Cancelled']);
        $activeAppointment = Appointment::factory()->create(['status' => 'Scheduled']);

        $cancelledAppointments = Appointment::cancelled()->get();

        $this->assertTrue($cancelledAppointments->contains($cancelledAppointment));
        $this->assertFalse($cancelledAppointments->contains($activeAppointment));
    }

    /** @test */
    public function it_has_rescheduled_scope(): void
    {
        $rescheduledAppointment = Appointment::factory()->create(['rescheduled_from' => 1]);
        $originalAppointment = Appointment::factory()->create(['rescheduled_from' => null]);

        $rescheduledAppointments = Appointment::rescheduled()->get();

        $this->assertTrue($rescheduledAppointments->contains($rescheduledAppointment));
        $this->assertFalse($rescheduledAppointments->contains($originalAppointment));
    }

    /** @test */
    public function it_has_follow_up_required_scope(): void
    {
        $followUpAppointment = Appointment::factory()->create(['follow_up_required' => true]);
        $noFollowUpAppointment = Appointment::factory()->create(['follow_up_required' => false]);

        $followUpAppointments = Appointment::followUpRequired()->get();

        $this->assertTrue($followUpAppointments->contains($followUpAppointment));
        $this->assertFalse($followUpAppointments->contains($noFollowUpAppointment));
    }

    /** @test */
    public function it_has_search_scope(): void
    {
        $consultationAppointment = Appointment::factory()->create(['title' => 'Initial Consultation']);
        $treatmentAppointment = Appointment::factory()->create(['title' => 'Follow-up Treatment']);

        $searchResults = Appointment::search('Consultation')->get();

        $this->assertTrue($searchResults->contains($consultationAppointment));
        $this->assertFalse($searchResults->contains($treatmentAppointment));
    }

    /** @test */
    public function it_has_urgent_scope(): void
    {
        $urgentAppointment = Appointment::factory()->create([
            'priority' => 'High',
            'start_time' => now()->addHours(1),
        ]);
        $nonUrgentAppointment = Appointment::factory()->create([
            'priority' => 'Low',
            'start_time' => now()->addDays(7),
        ]);

        $urgentAppointments = Appointment::urgent()->get();

        $this->assertTrue($urgentAppointments->contains($urgentAppointment));
        $this->assertFalse($urgentAppointments->contains($nonUrgentAppointment));
    }

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Appointment::create([]);
    }

    /** @test */
    public function it_validates_time_logic(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Appointment::create([
            'title' => 'Test Appointment',
            'start_time' => now()->addHour(),
            'end_time' => now(), // End time before start time
        ]);
    }

    /** @test */
    public function it_has_correct_mutators(): void
    {
        $this->appointment->update([
            'title' => '  consultation  ',
            'description' => '  patient checkup  ',
        ]);

        $this->assertEquals('consultation', $this->appointment->title);
        $this->assertEquals('patient checkup', $this->appointment->description);
    }

    /** @test */
    public function it_has_correct_accessors(): void
    {
        $this->appointment->update([
            'start_time' => '2024-01-15 09:00:00',
            'end_time' => '2024-01-15 10:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $this->appointment->start_time);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->appointment->end_time);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->appointment->created_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->appointment->updated_at);
    }

    /** @test */
    public function it_can_be_serialized_to_array(): void
    {
        $array = $this->appointment->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('description', $array);
        $this->assertArrayHasKey('start_time', $array);
        $this->assertArrayHasKey('end_time', $array);
    }

    /** @test */
    public function it_can_be_serialized_to_json(): void
    {
        $json = $this->appointment->toJson();

        $this->assertIsString($json);
        $this->assertJson($json);
    }

    /** @test */
    public function it_can_be_confirmed(): void
    {
        $this->appointment->confirm();

        $this->assertTrue($this->appointment->is_confirmed);
        $this->assertNotNull($this->appointment->confirmation_date);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'is_confirmed' => true,
        ]);
    }

    /** @test */
    public function it_can_be_cancelled(): void
    {
        $cancellationReason = 'Patient requested cancellation';

        $this->appointment->cancel($cancellationReason);

        $this->assertEquals('Cancelled', $this->appointment->status);
        $this->assertEquals($cancellationReason, $this->appointment->cancellation_reason);
        $this->assertNotNull($this->appointment->cancelled_at);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'status' => 'Cancelled',
            'cancellation_reason' => $cancellationReason,
        ]);
    }

    /** @test */
    public function it_can_be_rescheduled(): void
    {
        $newStartTime = now()->addDays(7)->addHours(9);
        $newEndTime = now()->addDays(7)->addHours(10);

        $this->appointment->reschedule($newStartTime, $newEndTime);

        $this->assertEquals($newStartTime->format('Y-m-d H:i:s'), $this->appointment->start_time->format('Y-m-d H:i:s'));
        $this->assertEquals($newEndTime->format('Y-m-d H:i:s'), $this->appointment->end_time->format('Y-m-d H:i:s'));
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'start_time' => $newStartTime->format('Y-m-d H:i:s'),
            'end_time' => $newEndTime->format('Y-m-d H:i:s'),
        ]);
    }

    /** @test */
    public function it_has_reminder_management(): void
    {
        $this->appointment->markReminderSent();

        $this->assertTrue($this->appointment->reminder_sent);
        $this->assertNotNull($this->appointment->reminder_sent_at);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'reminder_sent' => true,
        ]);
    }

    /** @test */
    public function it_has_follow_up_management(): void
    {
        $followUpDate = now()->addWeeks(2);

        $this->appointment->scheduleFollowUp($followUpDate);

        $this->assertTrue($this->appointment->follow_up_required);
        $this->assertEquals($followUpDate->format('Y-m-d'), $this->appointment->follow_up_date->format('Y-m-d'));
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'follow_up_required' => true,
            'follow_up_date' => $followUpDate->format('Y-m-d'),
        ]);
    }

    /** @test */
    public function it_has_medical_data_management(): void
    {
        $symptoms = ['fever', 'cough', 'fatigue'];
        $diagnosis = ['upper respiratory infection'];
        $treatmentPlan = ['rest', 'fluids', 'medication'];

        $this->appointment->updateMedicalData([
            'symptoms' => $symptoms,
            'diagnosis' => $diagnosis,
            'treatment_plan' => $treatmentPlan,
        ]);

        $this->assertEquals($symptoms, $this->appointment->symptoms);
        $this->assertEquals($diagnosis, $this->appointment->diagnosis);
        $this->assertEquals($treatmentPlan, $this->appointment->treatment_plan);
    }

    /** @test */
    public function it_has_prescription_management(): void
    {
        $prescriptions = [
            [
                'medication' => 'Amoxicillin',
                'dosage' => '500mg',
                'frequency' => '3 times daily',
                'duration' => '7 days',
            ],
        ];

        $this->appointment->addPrescriptions($prescriptions);

        $this->assertEquals($prescriptions, $this->appointment->prescriptions);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'prescriptions' => json_encode($prescriptions),
        ]);
    }

    /** @test */
    public function it_has_lab_results_management(): void
    {
        $labResults = [
            'blood_count' => 'Normal',
            'cholesterol' => '200 mg/dL',
            'glucose' => '95 mg/dL',
        ];

        $this->appointment->addLabResults($labResults);

        $this->assertEquals($labResults, $this->appointment->lab_results);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'lab_results' => json_encode($labResults),
        ]);
    }

    /** @test */
    public function it_has_imaging_results_management(): void
    {
        $imagingResults = [
            'chest_xray' => 'Normal',
            'mri_brain' => 'No abnormalities detected',
        ];

        $this->appointment->addImagingResults($imagingResults);

        $this->assertEquals($imagingResults, $this->appointment->imaging_results);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'imaging_results' => json_encode($imagingResults),
        ]);
    }

    /** @test */
    public function it_has_vital_signs_management(): void
    {
        $vitalSigns = [
            'blood_pressure' => '120/80',
            'heart_rate' => '72 bpm',
            'temperature' => '98.6°F',
            'respiratory_rate' => '16/min',
        ];

        $this->appointment->recordVitalSigns($vitalSigns);

        $this->assertEquals($vitalSigns, $this->appointment->vital_signs);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'vital_signs' => json_encode($vitalSigns),
        ]);
    }

    /** @test */
    public function it_has_allergy_management(): void
    {
        $allergies = ['penicillin', 'sulfa drugs', 'latex'];

        $this->appointment->addAllergies($allergies);

        $this->assertEquals($allergies, $this->appointment->allergies);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'allergies' => json_encode($allergies),
        ]);
    }

    /** @test */
    public function it_has_medication_history_management(): void
    {
        $medications = [
            'aspirin' => '81mg daily',
            'vitamin_d' => '1000 IU daily',
        ];

        $this->appointment->addMedications($medications);

        $this->assertEquals($medications, $this->appointment->medications);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'medications' => json_encode($medications),
        ]);
    }

    /** @test */
    public function it_has_payment_management(): void
    {
        $this->appointment->update([
            'cost' => 150.00,
            'payment_status' => 'Pending',
        ]);

        $this->appointment->markAsPaid('Credit Card');

        $this->assertEquals('Paid', $this->appointment->payment_status);
        $this->assertEquals('Credit Card', $this->appointment->payment_method);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'payment_status' => 'Paid',
            'payment_method' => 'Credit Card',
        ]);
    }

    /** @test */
    public function it_has_insurance_management(): void
    {
        $insuranceInfo = [
            'provider' => 'Blue Cross Blue Shield',
            'policy_number' => 'BCBS123456',
            'group_number' => 'GRP789',
            'coverage_type' => 'PPO',
        ];

        $this->appointment->setInsuranceInfo($insuranceInfo);

        $this->assertEquals($insuranceInfo, $this->appointment->insurance_info);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'insurance_info' => json_encode($insuranceInfo),
        ]);
    }

    /** @test */
    public function it_has_referral_management(): void
    {
        $referralSource = 'Primary Care Physician';

        $this->appointment->setReferralSource($referralSource);

        $this->assertEquals($referralSource, $this->appointment->referral_source);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'referral_source' => $referralSource,
        ]);
    }

    /** @test */
    public function it_has_status_transition_validation(): void
    {
        $this->appointment->update(['status' => 'Scheduled']);

        // Transizione valida
        $this->appointment->updateStatus('In Progress');
        $this->assertEquals('In Progress', $this->appointment->status);

        // Transizione non valida (da In Progress a Scheduled)
        $this->expectException(\InvalidArgumentException::class);
        $this->appointment->updateStatus('Scheduled');
    }

    /** @test */
    public function it_has_priority_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->appointment->update(['priority' => 'InvalidPriority']);
    }

    /** @test */
    public function it_has_type_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->appointment->update(['type' => 'InvalidType']);
    }

    /** @test */
    public function it_has_payment_status_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->appointment->update(['payment_status' => 'InvalidStatus']);
    }

    /** @test */
    public function it_has_conflict_detection(): void
    {
        $existingAppointment = Appointment::factory()->create([
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
            'worker_id' => 1,
        ]);

        $conflictingAppointment = Appointment::factory()->create([
            'start_time' => now()->addHours(1.5),
            'end_time' => now()->addHours(3),
            'worker_id' => 1,
        ]);

        $this->assertTrue($existingAppointment->hasConflict($conflictingAppointment));
        $this->assertTrue($conflictingAppointment->hasConflict($existingAppointment));

        $nonConflictingAppointment = Appointment::factory()->create([
            'start_time' => now()->addHours(3),
            'end_time' => now()->addHours(4),
            'worker_id' => 1,
        ]);

        $this->assertFalse($existingAppointment->hasConflict($nonConflictingAppointment));
    }

    /** @test */
    public function it_has_availability_check(): void
    {
        $this->appointment->update([
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
        ]);

        $this->assertTrue($this->appointment->isAvailable());
        $this->assertFalse($this->appointment->isOverlapping());

        // Crea un appuntamento sovrapposto
        Appointment::factory()->create([
            'start_time' => now()->addHours(1.5),
            'end_time' => now()->addHours(3),
            'worker_id' => $this->appointment->worker_id,
        ]);

        $this->assertTrue($this->appointment->isOverlapping());
    }

    /** @test */
    public function it_has_duration_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->appointment->update([
            'start_time' => now(),
            'end_time' => now()->addMinutes(10), // Durata troppo breve
        ]);
    }

    /** @test */
    public function it_has_advance_booking_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->appointment->update([
            'start_time' => now()->subHour(), // Appuntamento nel passato
        ]);
    }

    /** @test */
    public function it_has_medical_notes_management(): void
    {
        $progressNotes = [
            'subjective' => 'Patient reports improvement in symptoms',
            'objective' => 'Vital signs stable, no new symptoms',
            'assessment' => 'Condition improving as expected',
            'plan' => 'Continue current treatment, follow up in 1 week',
        ];

        $this->appointment->addProgressNotes($progressNotes);

        $this->assertEquals($progressNotes, $this->appointment->progress_notes);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'progress_notes' => json_encode($progressNotes),
        ]);
    }

    /** @test */
    public function it_has_discharge_summary_management(): void
    {
        $dischargeSummary = [
            'admission_date' => '2024-01-10',
            'discharge_date' => '2024-01-15',
            'primary_diagnosis' => 'Acute appendicitis',
            'procedures_performed' => ['Laparoscopic appendectomy'],
            'discharge_medications' => ['Pain medication', 'Antibiotics'],
            'follow_up_instructions' => 'Follow up with surgeon in 2 weeks',
        ];

        $this->appointment->setDischargeSummary($dischargeSummary);

        $this->assertEquals($dischargeSummary, $this->appointment->discharge_summary);
        $this->assertDatabaseHas('appointments', [
            'id' => $this->appointment->id,
            'discharge_summary' => json_encode($dischargeSummary),
        ]);
    }
}
