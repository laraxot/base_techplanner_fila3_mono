<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Modules\TechPlanner\Models\DeviceVerification;

/**
 * Test unitario per il modello DeviceVerification.
 *
 * @covers \Modules\TechPlanner\Models\DeviceVerification
 */
class DeviceVerificationTest extends TestCase
{
    private DeviceVerification $deviceVerification;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deviceVerification = DeviceVerification::factory()->create();
    }

    /** @test */
    public function it_can_create_device_verification(): void
    {
        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
            'device_id' => $this->deviceVerification->device_id,
            'verification_type' => $this->deviceVerification->verification_type,
            'status' => $this->deviceVerification->status,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->deviceVerification->delete();
        $this->assertSoftDeleted('device_verifications', ['id' => $this->deviceVerification->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->deviceVerification->delete();
        $this->deviceVerification->restore();
        $this->assertDatabaseHas('device_verifications', ['id' => $this->deviceVerification->id]);
    }

    /** @test */
    public function it_has_verification_status_scope(): void
    {
        DeviceVerification::factory()->create(['status' => 'passed']);
        DeviceVerification::factory()->create(['status' => 'failed']);

        $passedVerifications = DeviceVerification::passed()->get();
        $this->assertEquals(1, $passedVerifications->count());
    }

    /** @test */
    public function it_has_verification_type_scope(): void
    {
        DeviceVerification::factory()->create(['verification_type' => 'safety']);
        DeviceVerification::factory()->create(['verification_type' => 'performance']);

        $safetyVerifications = DeviceVerification::safety()->get();
        $this->assertEquals(1, $safetyVerifications->count());
    }

    /** @test */
    public function it_has_date_range_scope(): void
    {
        $today = now();
        $yesterday = now()->subDay();

        DeviceVerification::factory()->create(['created_at' => $today]);
        DeviceVerification::factory()->create(['created_at' => $yesterday]);

        $recentVerifications = DeviceVerification::dateRange($today->startOfDay(), $today->endOfDay())->get();
        $this->assertEquals(1, $recentVerifications->count());
    }

    /** @test */
    public function it_handles_verification_notes(): void
    {
        $notes = 'Verifica di sicurezza completata con successo';
        $this->deviceVerification->notes = $notes;
        $this->deviceVerification->save();

        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->deviceVerification->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('device_id', $array);
        $this->assertArrayHasKey('verification_type', $array);
        $this->assertArrayHasKey('status', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->deviceVerification->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('device_id', $json);
        $this->assertStringContainsString('verification_type', $json);
    }

    /** @test */
    public function it_handles_passed_status(): void
    {
        $this->deviceVerification->status = 'passed';
        $this->deviceVerification->save();

        $this->assertTrue($this->deviceVerification->isPassed());
    }

    /** @test */
    public function it_handles_failed_status(): void
    {
        $this->deviceVerification->status = 'failed';
        $this->deviceVerification->save();

        $this->assertTrue($this->deviceVerification->isFailed());
    }

    /** @test */
    public function it_handles_pending_status(): void
    {
        $this->deviceVerification->status = 'pending';
        $this->deviceVerification->save();

        $this->assertTrue($this->deviceVerification->isPending());
    }

    /** @test */
    public function it_handles_safety_verification_type(): void
    {
        $this->deviceVerification->verification_type = 'safety';
        $this->deviceVerification->save();

        $this->assertTrue($this->deviceVerification->isSafetyVerification());
    }

    /** @test */
    public function it_handles_performance_verification_type(): void
    {
        $this->deviceVerification->verification_type = 'performance';
        $this->deviceVerification->save();

        $this->assertTrue($this->deviceVerification->isPerformanceVerification());
    }

    /** @test */
    public function it_handles_verification_date(): void
    {
        $verificationDate = now()->addDays(30);
        $this->deviceVerification->verification_date = $verificationDate;
        $this->deviceVerification->save();

        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
            'verification_date' => $verificationDate->format('Y-m-d'),
        ]);
    }

    /** @test */
    public function it_handles_next_verification_date(): void
    {
        $nextVerificationDate = now()->addYear();
        $this->deviceVerification->next_verification_date = $nextVerificationDate;
        $this->deviceVerification->save();

        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
            'next_verification_date' => $nextVerificationDate->format('Y-m-d'),
        ]);
    }

    /** @test */
    public function it_handles_verification_result(): void
    {
        $result = 'Tutti i test di sicurezza sono stati superati';
        $this->deviceVerification->result = $result;
        $this->deviceVerification->save();

        $this->assertDatabaseHas('device_verifications', [
            'id' => $this->deviceVerification->id,
            'result' => $result,
        ]);
    }
}
