<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;


use Modules\TechPlanner\Models\Event;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Worker;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\Event;
use Modules\TechPlanner\Models\Location;
use Tests\TestCase;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Device;








/**
 * Test unitario per il modello Event.
 *
 * @covers \Modules\TechPlanner\Models\Event
 */
class EventTest extends TestCase
{
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();
        

        $this->event = Event::factory()->create();
    }

    /** @test */
    public function it_has_correct_table_name(): void
    {
        $this->assertEquals('events', $this->event->getTable());
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $expectedFillable = [
            'title',
            'description',
            'start_date',
            'end_date',
            'type',
            'status',
            'priority',
            'location_id',
            'client_id',
            'assigned_worker_id',
            'device_id',
            'notes',
            'is_all_day',
            'recurring_pattern',
            'recurring_until',
            'color',
            'reminder_minutes',
            'is_public',
            'max_participants',
            'current_participants',
            'budget',
            'actual_cost',
            'tags',
            'metadata',
        ];

        $this->assertEquals($expectedFillable, $this->event->getFillable());
    }

    /** @test */
    public function it_has_correct_hidden_fields(): void
    {
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $this->event->getHidden());
    }

    /** @test */
    public function it_has_correct_dates(): void
    {
        $expectedDates = [
            'created_at',
            'updated_at',
            'deleted_at',
            'start_date',
            'end_date',
            'recurring_until',
            'reminder_at',
        ];

        $this->assertEquals($expectedDates, $this->event->getDates());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $expectedCasts = [
            'id' => 'int',
            'location_id' => 'int',
            'client_id' => 'int',
            'assigned_worker_id' => 'int',
            'device_id' => 'int',
            'max_participants' => 'int',
            'current_participants' => 'int',
            'budget' => 'decimal:2',
            'actual_cost' => 'decimal:2',
            'is_all_day' => 'boolean',
            'is_public' => 'boolean',
            'tags' => 'array',
            'metadata' => 'array',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'recurring_until' => 'datetime',
            'reminder_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        $this->assertEquals($expectedCasts, $this->event->getCasts());
    }

    /** @test */
    public function it_belongs_to_client(): void
    {
        $client = Client::factory()->create();
        $this->event->update(['client_id' => $client->id]);

        $this->assertInstanceOf(Client::class, $this->event->client);
        $this->assertEquals($client->id, $this->event->client->id);
    }

    /** @test */
    public function it_belongs_to_assigned_worker(): void
    {
        $worker = Worker::factory()->create();
        $this->event->update(['assigned_worker_id' => $worker->id]);

        $this->assertInstanceOf(Worker::class, $this->event->assignedWorker);
        $this->assertEquals($worker->id, $this->event->assignedWorker->id);
    }

    /** @test */
    public function it_belongs_to_device(): void
    {
        $device = Device::factory()->create();
        $this->event->update(['device_id' => $device->id]);

        $this->assertInstanceOf(Device::class, $this->event->device);
        $this->assertEquals($device->id, $this->event->device->id);
    }

    /** @test */
    public function it_belongs_to_location(): void
    {
        $location = Location::factory()->create();
        $this->event->update(['location_id' => $location->id]);

        $this->assertInstanceOf(Location::class, $this->event->location);
        $this->assertEquals($location->id, $this->event->location->id);
    }

    /** @test */
    public function it_can_be_soft_deleted(): void
    {
        $eventId = $this->event->id;
        
        $this->event->delete();
        

        $this->event->delete();

        $this->assertSoftDeleted('events', ['id' => $eventId]);
        $this->assertDatabaseMissing('events', ['id' => $eventId]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $eventId = $this->event->id;
        
        $this->event->delete();
        $this->assertSoftDeleted('events', ['id' => $eventId]);
        

        $this->event->delete();
        $this->assertSoftDeleted('events', ['id' => $eventId]);

        $restoredEvent = Event::withTrashed()->find($eventId);
        $restoredEvent->restore();
        
        $this->event->delete();
        $this->assertSoftDeleted('events', ['id' => $eventId]);
        
        $restoredEvent = Event::withTrashed()->find($eventId);
        $restoredEvent->restore();
        $this->assertDatabaseHas('events', ['id' => $eventId]);
        $this->assertNull($restoredEvent->deleted_at);
    }

    /** @test */
    public function it_has_duration_calculation(): void
    {
        $this->event->update([
            'start_date' => now(),
            'end_date' => now()->addHours(2),
        ]);

        $duration = $this->event->getDuration();

        $this->assertEquals(2, $duration->inHours());
        $this->assertEquals(120, $duration->inMinutes());
    }

    /** @test */
    public function it_has_is_ongoing_check(): void
    {
        $now = now();
        

        // Evento in corso
        $this->event->update([
            'start_date' => $now->subHour(),
            'end_date' => $now->addHour(),
        ]);

        $this->assertTrue($this->event->isOngoing());

        // Evento passato
        $this->event->update([
            'start_date' => $now->subHours(3),
            'end_date' => $now->subHours(1),
        ]);

        $this->assertFalse($this->event->isOngoing());

        // Evento futuro
        $this->event->update([
            'start_date' => $now->addHours(1),
            'end_date' => $now->addHours(3),
        ]);

        $this->assertFalse($this->event->isOngoing());
    }

    /** @test */
    public function it_has_is_past_check(): void
    {
        $now = now();
        

        // Evento passato
        $this->event->update([
            'start_date' => $now->subHours(3),
            'end_date' => $now->subHours(1),
        ]);

        $this->assertTrue($this->event->isPast());

        // Evento futuro
        $this->event->update([
            'start_date' => $now->addHours(1),
            'end_date' => $now->addHours(3),
        ]);

        $this->assertFalse($this->event->isPast());
    }

    /** @test */
    public function it_has_is_future_check(): void
    {
        $now = now();
        

        // Evento futuro
        $this->event->update([
            'start_date' => $now->addHours(1),
            'end_date' => $now->addHours(3),
        ]);

        $this->assertTrue($this->event->isFuture());

        // Evento passato
        $this->event->update([
            'start_date' => $now->subHours(3),
            'end_date' => $now->subHours(1),
        ]);

        $this->assertFalse($this->event->isFuture());
    }

    /** @test */
    public function it_has_is_today_check(): void
    {
        $today = now();
        

        // Evento oggi
        $this->event->update([
            'start_date' => $today->copy()->startOfDay(),
            'end_date' => $today->copy()->endOfDay(),
        ]);

        $this->assertTrue($this->event->isToday());

        // Evento domani
        $this->event->update([
            'start_date' => $today->copy()->addDay()->startOfDay(),
            'end_date' => $today->copy()->addDay()->endOfDay(),
        ]);

        $this->assertFalse($this->event->isToday());
    }

    /** @test */
    public function it_has_is_this_week_check(): void
    {
        $thisWeek = now();
        

        // Evento questa settimana
        $this->event->update([
            'start_date' => $thisWeek->copy()->startOfWeek(),
            'end_date' => $thisWeek->copy()->endOfWeek(),
        ]);

        $this->assertTrue($this->event->isThisWeek());

        // Evento prossima settimana
        $this->event->update([
            'start_date' => $thisWeek->copy()->addWeek()->startOfWeek(),
            'end_date' => $thisWeek->copy()->addWeek()->endOfWeek(),
        ]);

        $this->assertFalse($this->event->isThisWeek());
    }

    /** @test */
    public function it_has_is_this_month_check(): void
    {
        $thisMonth = now();
        

        // Evento questo mese
        $this->event->update([
            'start_date' => $thisMonth->copy()->startOfMonth(),
            'end_date' => $thisMonth->copy()->endOfMonth(),
        ]);

        $this->assertTrue($this->event->isThisMonth());

        // Evento prossimo mese
        $this->event->update([
            'start_date' => $thisMonth->copy()->addMonth()->startOfMonth(),
            'end_date' => $thisMonth->copy()->addMonth()->endOfMonth(),
        ]);

        $this->assertFalse($this->event->isThisMonth());
    }

    /** @test */
    public function it_has_upcoming_scope(): void
    {
        $upcomingEvent = Event::factory()->create([
            'start_date' => now()->addDays(7),
        ]);
        $pastEvent = Event::factory()->create([
            'start_date' => now()->subDays(7),
        ]);

        $upcomingEvents = Event::upcoming()->get();

        $this->assertTrue($upcomingEvents->contains($upcomingEvent));
        $this->assertFalse($upcomingEvents->contains($pastEvent));
    }

    /** @test */
    public function it_has_past_scope(): void
    {
        $pastEvent = Event::factory()->create([
            'start_date' => now()->subDays(7),
        ]);
        $upcomingEvent = Event::factory()->create([
            'start_date' => now()->addDays(7),
        ]);

        $pastEvents = Event::past()->get();

        $this->assertTrue($pastEvents->contains($pastEvent));
        $this->assertFalse($pastEvents->contains($upcomingEvent));
    }

    /** @test */
    public function it_has_today_scope(): void
    {
        $todayEvent = Event::factory()->create([
            'start_date' => now()->startOfDay(),
            'end_date' => now()->endOfDay(),
        ]);
        $tomorrowEvent = Event::factory()->create([
            'start_date' => now()->addDay()->startOfDay(),
            'end_date' => now()->addDay()->endOfDay(),
        ]);

        $todayEvents = Event::today()->get();

        $this->assertTrue($todayEvents->contains($todayEvent));
        $this->assertFalse($todayEvents->contains($tomorrowEvent));
    }

    /** @test */
    public function it_has_by_type_scope(): void
    {
        $meetingEvent = Event::factory()->create(['type' => 'Meeting']);
        $trainingEvent = Event::factory()->create(['type' => 'Training']);

        $meetingEvents = Event::byType('Meeting')->get();

        $this->assertTrue($meetingEvents->contains($meetingEvent));
        $this->assertFalse($meetingEvents->contains($trainingEvent));
    }

    /** @test */
    public function it_has_by_status_scope(): void
    {
        $scheduledEvent = Event::factory()->create(['status' => 'Scheduled']);
        $cancelledEvent = Event::factory()->create(['status' => 'Cancelled']);

        $scheduledEvents = Event::byStatus('Scheduled')->get();

        $this->assertTrue($scheduledEvents->contains($scheduledEvent));
        $this->assertFalse($scheduledEvents->contains($cancelledEvent));
    }

    /** @test */
    public function it_has_by_priority_scope(): void
    {
        $highPriorityEvent = Event::factory()->create(['priority' => 'High']);
        $lowPriorityEvent = Event::factory()->create(['priority' => 'Low']);

        $highPriorityEvents = Event::byPriority('High')->get();

        $this->assertTrue($highPriorityEvents->contains($highPriorityEvent));
        $this->assertFalse($highPriorityEvents->contains($lowPriorityEvent));
    }

    /** @test */
    public function it_has_by_client_scope(): void
    {
        $client = Client::factory()->create();
        $clientEvent = Event::factory()->create(['client_id' => $client->id]);
        $otherEvent = Event::factory()->create(['client_id' => null]);

        $clientEvents = Event::byClient($client->id)->get();

        $this->assertTrue($clientEvents->contains($clientEvent));
        $this->assertFalse($clientEvents->contains($otherEvent));
    }

    /** @test */
    public function it_has_by_worker_scope(): void
    {
        $worker = Worker::factory()->create();
        $assignedEvent = Event::factory()->create(['assigned_worker_id' => $worker->id]);
        $unassignedEvent = Event::factory()->create(['assigned_worker_id' => null]);

        $assignedEvents = Event::byWorker($worker->id)->get();

        $this->assertTrue($assignedEvents->contains($assignedEvent));
        $this->assertFalse($assignedEvents->contains($unassignedEvent));
    }

    /** @test */
    public function it_has_by_device_scope(): void
    {
        $device = Device::factory()->create();
        $deviceEvent = Event::factory()->create(['device_id' => $device->id]);
        $otherEvent = Event::factory()->create(['device_id' => null]);

        $deviceEvents = Event::byDevice($device->id)->get();

        $this->assertTrue($deviceEvents->contains($deviceEvent));
        $this->assertFalse($deviceEvents->contains($otherEvent));
    }

    /** @test */
    public function it_has_by_location_scope(): void
    {
        $location = Location::factory()->create();
        $locationEvent = Event::factory()->create(['location_id' => $location->id]);
        $otherEvent = Event::factory()->create(['location_id' => null]);

        $locationEvents = Event::byLocation($location->id)->get();

        $this->assertTrue($locationEvents->contains($locationEvent));
        $this->assertFalse($locationEvents->contains($otherEvent));
    }

    /** @test */
    public function it_has_search_scope(): void
    {
        $meetingEvent = Event::factory()->create(['title' => 'Team Meeting']);
        $trainingEvent = Event::factory()->create(['title' => 'Training Session']);

        $searchResults = Event::search('Meeting')->get();

        $this->assertTrue($searchResults->contains($meetingEvent));
        $this->assertFalse($searchResults->contains($trainingEvent));
    }

    /** @test */
    public function it_has_recurring_scope(): void
    {
        $recurringEvent = Event::factory()->create(['recurring_pattern' => 'weekly']);
        $nonRecurringEvent = Event::factory()->create(['recurring_pattern' => null]);

        $recurringEvents = Event::recurring()->get();

        $this->assertTrue($recurringEvents->contains($recurringEvent));
        $this->assertFalse($recurringEvents->contains($nonRecurringEvent));
    }

    /** @test */
    public function it_has_public_scope(): void
    {
        $publicEvent = Event::factory()->create(['is_public' => true]);
        $privateEvent = Event::factory()->create(['is_public' => false]);

        $publicEvents = Event::public()->get();

        $this->assertTrue($publicEvents->contains($publicEvent));
        $this->assertFalse($publicEvents->contains($privateEvent));
    }

    /** @test */
    public function it_has_urgent_scope(): void
    {
        $urgentEvent = Event::factory()->create([
            'priority' => 'High',
            'start_date' => now()->addHours(1),
        ]);
        $nonUrgentEvent = Event::factory()->create([
            'priority' => 'Low',
            'start_date' => now()->addDays(7),
        ]);

        $urgentEvents = Event::urgent()->get();

        $this->assertTrue($urgentEvents->contains($urgentEvent));
        $this->assertFalse($urgentEvents->contains($nonUrgentEvent));
    }

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Event::create([]);
    }

    /** @test */
    public function it_validates_date_logic(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Event::create([
            'title' => 'Test Event',
            'start_date' => now()->addHour(),
            'end_date' => now(), // End date before start date
        ]);
    }

    /** @test */
    public function it_has_correct_mutators(): void
    {
        $this->event->update([
            'title' => '  team meeting  ',
            'description' => '  important discussion  ',
        ]);

        $this->assertEquals('team meeting', $this->event->title);
        $this->assertEquals('important discussion', $this->event->description);
    }

    /** @test */
    public function it_has_correct_accessors(): void
    {
        $this->event->update([
            'start_date' => '2024-01-15 09:00:00',
            'end_date' => '2024-01-15 11:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $this->event->start_date);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->event->end_date);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->event->created_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->event->updated_at);
    }

    /** @test */
    public function it_can_be_serialized_to_array(): void
    {
        $array = $this->event->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('description', $array);
        $this->assertArrayHasKey('start_date', $array);
        $this->assertArrayHasKey('end_date', $array);
    }

    /** @test */
    public function it_can_be_serialized_to_json(): void
    {
        $json = $this->event->toJson();

        $this->assertIsString($json);
        $this->assertJson($json);
    }

    /** @test */
    public function it_has_participant_management(): void
    {
        $this->event->update([
            'max_participants' => 10,
            'current_participants' => 5,
        ]);

        $this->assertTrue($this->event->canAcceptMoreParticipants());
        $this->assertEquals(5, $this->event->remainingSpots());

        $this->event->addParticipant();
        $this->assertEquals(6, $this->event->current_participants);

        $this->event->removeParticipant();
        $this->assertEquals(5, $this->event->current_participants);
    }

    /** @test */
    public function it_has_budget_tracking(): void
    {
        $this->event->update([
            'budget' => 1000.00,
            'actual_cost' => 750.00,
        ]);

        $this->assertEquals(250.00, $this->event->getBudgetRemaining());
        $this->assertEquals(75.0, $this->event->getBudgetUtilizationPercentage());
        $this->assertTrue($this->event->isUnderBudget());

        $this->event->update(['actual_cost' => 1200.00]);
        $this->assertFalse($this->event->isUnderBudget());
        $this->assertEquals(-200.00, $this->event->getBudgetRemaining());
    }

    /** @test */
    public function it_has_tag_management(): void
    {
        $tags = ['meeting', 'important', 'team'];

        $this->event->addTags($tags);

        $this->assertEquals($tags, $this->event->tags);
        $this->assertTrue($this->event->hasTag('meeting'));
        $this->assertFalse($this->event->hasTag('training'));

        $this->event->removeTag('important');
        $this->assertEquals(['meeting', 'team'], $this->event->tags);
    }

    /** @test */
    public function it_has_metadata_management(): void
    {
        $metadata = [
            'room_number' => 'A101',
            'equipment_needed' => ['projector', 'whiteboard'],
            'contact_person' => 'John Doe',
        ];

        $this->event->setMetadata($metadata);

        $this->assertEquals($metadata, $this->event->metadata);
        $this->assertEquals('A101', $this->event->getMetadata('room_number'));
        $this->assertEquals(['projector', 'whiteboard'], $this->event->getMetadata('equipment_needed'));
        $this->assertNull($this->event->getMetadata('non_existent'));

        $this->event->updateMetadata('room_number', 'B202');
        $this->assertEquals('B202', $this->event->getMetadata('room_number'));
    }

    /** @test */
    public function it_has_recurring_event_generation(): void
    {
        $this->event->update([
            'recurring_pattern' => 'weekly',
            'recurring_until' => now()->addWeeks(4),
        ]);

        $recurringEvents = $this->event->generateRecurringInstances();

        $this->assertCount(4, $recurringEvents);
        $this->assertInstanceOf(Event::class, $recurringEvents->first());
    }

    /** @test */
    public function it_has_reminder_functionality(): void
    {
        $this->event->update([
            'reminder_minutes' => 30,
            'start_date' => now()->addHour(),
        ]);

        $this->event->scheduleReminder();

        $this->assertNotNull($this->event->reminder_at);
        $this->assertEquals(
            $this->event->start_date->subMinutes(30)->format('Y-m-d H:i:s'),
            $this->event->reminder_at->format('Y-m-d H:i:s')
        );
    }

    /** @test */
    public function it_has_status_transition_validation(): void
    {
        $this->event->update(['status' => 'Draft']);

        // Transizione valida
        $this->event->updateStatus('Scheduled');
        $this->assertEquals('Scheduled', $this->event->status);

        // Transizione non valida (da Scheduled a Draft)
        $this->expectException(\InvalidArgumentException::class);
        $this->event->updateStatus('Draft');
    }

    /** @test */
    public function it_has_priority_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->event->update(['priority' => 'InvalidPriority']);
    }

    /** @test */
    public function it_has_type_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->event->update(['type' => 'InvalidType']);
    }

    /** @test */
    public function it_has_color_management(): void
    {
        $this->event->setColor('#FF5733');

        $this->assertEquals('#FF5733', $this->event->color);
        $this->assertTrue($this->event->hasCustomColor());

        $this->event->resetToDefaultColor();
        $this->assertNull($this->event->color);
        $this->assertFalse($this->event->hasCustomColor());
    }

    /** @test */
    public function it_has_conflict_detection(): void
    {
        $existingEvent = Event::factory()->create([
            'start_date' => now()->addHour(),
            'end_date' => now()->addHours(3),
        ]);

        $conflictingEvent = Event::factory()->create([
            'start_date' => now()->addHours(2),
            'end_date' => now()->addHours(4),
        ]);

        $this->assertTrue($existingEvent->hasConflict($conflictingEvent));
        $this->assertTrue($conflictingEvent->hasConflict($existingEvent));

        $nonConflictingEvent = Event::factory()->create([
            'start_date' => now()->addHours(4),
            'end_date' => now()->addHours(6),
        ]);

        $this->assertFalse($existingEvent->hasConflict($nonConflictingEvent));
    }

    /** @test */
    public function it_has_availability_check(): void
    {
        $this->event->update([
            'max_participants' => 5,
            'current_participants' => 3,
        ]);

        $this->assertTrue($this->event->isAvailable());
        $this->assertEquals(2, $this->event->getAvailableSpots());

        $this->event->update(['current_participants' => 5]);
        $this->assertFalse($this->event->isAvailable());
        $this->assertEquals(0, $this->event->getAvailableSpots());
    }

    /** @test */
    public function it_has_duration_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->event->update([
            'start_date' => now(),
            'end_date' => now()->addMinutes(10), // Durata troppo breve
        ]);
    }

    /** @test */
    public function it_has_advance_booking_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->event->update([
            'start_date' => now()->subHour(), // Evento nel passato
        ]);
    }
}
