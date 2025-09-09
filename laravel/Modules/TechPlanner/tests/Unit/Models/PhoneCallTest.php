<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\PhoneCall;
use Tests\TestCase;
=======
use Modules\TechPlanner\Models\PhoneCall;

/**
 * Test unitario per il modello PhoneCall.
 *
 * @covers \Modules\TechPlanner\Models\PhoneCall
 */
class PhoneCallTest extends TestCase
{
    use RefreshDatabase;

=======
    private PhoneCall $phoneCall;

    protected function setUp(): void
    {
        parent::setUp();
        $this->phoneCall = PhoneCall::factory()->create();
    }

    /** @test */
    public function it_can_create_phone_call(): void
    {
        $this->assertDatabaseHas('phone_calls', [
            'id' => $this->phoneCall->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('phone_calls', [
            'id' => $this->phoneCall->id,
            'phone_number' => $this->phoneCall->phone_number,
            'call_type' => $this->phoneCall->call_type,
            'status' => $this->phoneCall->status,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->phoneCall->delete();
        $this->assertSoftDeleted('phone_calls', ['id' => $this->phoneCall->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->phoneCall->delete();
        $this->phoneCall->restore();
        $this->assertDatabaseHas('phone_calls', ['id' => $this->phoneCall->id]);
    }

    /** @test */
    public function it_has_duration_accessor(): void
    {
        $this->phoneCall->start_time = now();
        $this->phoneCall->end_time = now()->addMinutes(15);
        $this->phoneCall->save();

        $this->assertEquals(15, $this->phoneCall->duration_minutes);
    }

    /** @test */
    public function it_has_call_status_scope(): void
    {
        PhoneCall::factory()->create(['status' => 'completed']);
        PhoneCall::factory()->create(['status' => 'missed']);

        $completedCalls = PhoneCall::completed()->get();
        $this->assertEquals(1, $completedCalls->count());
    }

    /** @test */
    public function it_has_call_type_scope(): void
    {
        PhoneCall::factory()->create(['call_type' => 'incoming']);
        PhoneCall::factory()->create(['call_type' => 'outgoing']);

        $incomingCalls = PhoneCall::incoming()->get();
        $this->assertEquals(1, $incomingCalls->count());
    }

    /** @test */
    public function it_has_date_range_scope(): void
    {
        $today = now();
        $yesterday = now()->subDay();

        PhoneCall::factory()->create(['created_at' => $today]);
        PhoneCall::factory()->create(['created_at' => $yesterday]);

        $recentCalls = PhoneCall::dateRange($today->startOfDay(), $today->endOfDay())->get();
        $this->assertEquals(1, $recentCalls->count());
    }

    /** @test */
    public function it_validates_phone_number_format(): void
    {
        $this->phoneCall->phone_number = '+39 123 456 7890';
        $this->phoneCall->save();

        $this->assertDatabaseHas('phone_calls', [
            'id' => $this->phoneCall->id,
            'phone_number' => '+39 123 456 7890',
        ]);
    }

    /** @test */
    public function it_handles_call_notes(): void
    {
        $notes = 'Chiamata importante per appuntamento';
        $this->phoneCall->notes = $notes;
        $this->phoneCall->save();

        $this->assertDatabaseHas('phone_calls', [
            'id' => $this->phoneCall->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->phoneCall->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('phone_number', $array);
        $this->assertArrayHasKey('call_type', $array);
        $this->assertArrayHasKey('status', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->phoneCall->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('phone_number', $json);
        $this->assertStringContainsString('call_type', $json);
    }

    /** @test */
    public function it_has_call_duration_validation(): void
    {
        $this->phoneCall->start_time = now();
        $this->phoneCall->end_time = now()->addMinutes(5);
        $this->phoneCall->save();

        $this->assertGreaterThan(0, $this->phoneCall->duration_minutes);
    }

    /** @test */
    public function it_handles_missed_call_status(): void
    {
        $this->phoneCall->status = 'missed';
        $this->phoneCall->save();

        $this->assertTrue($this->phoneCall->isMissed());
    }

    /** @test */
    public function it_handles_completed_call_status(): void
    {
        $this->phoneCall->status = 'completed';
        $this->phoneCall->save();

        $this->assertTrue($this->phoneCall->isCompleted());
    }

    /** @test */
    public function it_handles_incoming_call_type(): void
    {
        $this->phoneCall->call_type = 'incoming';
        $this->phoneCall->save();

        $this->assertTrue($this->phoneCall->isIncoming());
    }

    /** @test */
    public function it_handles_outgoing_call_type(): void
    {
        $this->phoneCall->call_type = 'outgoing';
        $this->phoneCall->save();

        $this->assertTrue($this->phoneCall->isOutgoing());
    }
}
