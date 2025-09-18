<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Employee\Models\Attendance;
use Modules\User\Models\User;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_can_create_attendance_record()
    {
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
            'is_manual' => false,
        ]);

        $this->assertInstanceOf(Attendance::class, $attendance);
        $this->assertEquals($this->user->id, $attendance->user_id);
        $this->assertEquals('entry', $attendance->type);
        $this->assertEquals('badge', $attendance->method);
        $this->assertEquals('valid', $attendance->status);
        $this->assertFalse($attendance->is_manual);
    }

    /** @test */
    public function it_has_user_relationship()
    {
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $this->assertInstanceOf(User::class, $attendance->user);
        $this->assertEquals($this->user->id, $attendance->user->id);
    }

    /** @test */
    public function it_can_check_if_entry()
    {
        $entry = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $exit = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'exit',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $this->assertTrue($entry->isEntry());
        $this->assertFalse($exit->isEntry());
    }

    /** @test */
    public function it_can_check_if_exit()
    {
        $entry = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $exit = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'exit',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $this->assertFalse($entry->isExit());
        $this->assertTrue($exit->isExit());
    }

    /** @test */
    public function it_can_check_if_manual()
    {
        $manual = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
            'is_manual' => true,
        ]);

        $automatic = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
            'is_manual' => false,
        ]);

        $this->assertTrue($manual->isManual());
        $this->assertFalse($automatic->isManual());
    }

    /** @test */
    public function it_can_check_if_has_location()
    {
        $withLocation = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'app',
            'status' => 'valid',
            'latitude' => '41.9028',
            'longitude' => '12.4964',
        ]);

        $withoutLocation = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $this->assertTrue($withLocation->hasLocation());
        $this->assertFalse($withoutLocation->hasLocation());
    }

    /** @test */
    public function it_can_format_timestamp()
    {
        $timestamp = Carbon::parse('2024-01-15 09:30:00');

        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => $timestamp,
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $this->assertEquals('15/01/2024 09:30:00', $attendance->formatted_timestamp);
        $this->assertEquals('09:30:00', $attendance->formatted_time);
        $this->assertEquals('15/01/2024', $attendance->formatted_date);
    }

    /** @test */
    public function it_can_scope_by_user()
    {
        $otherUser = User::factory()->create();

        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        Attendance::create([
            'user_id' => $otherUser->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $userAttendances = Attendance::forUser($this->user->id)->get();
        $otherUserAttendances = Attendance::forUser($otherUser->id)->get();

        $this->assertEquals(1, $userAttendances->count());
        $this->assertEquals(1, $otherUserAttendances->count());
        $this->assertEquals($this->user->id, $userAttendances->first()->user_id);
        $this->assertEquals($otherUser->id, $otherUserAttendances->first()->user_id);
    }

    /** @test */
    public function it_can_scope_by_type()
    {
        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'exit',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $entries = Attendance::ofType('entry')->get();
        $exits = Attendance::ofType('exit')->get();

        $this->assertEquals(1, $entries->count());
        $this->assertEquals(1, $exits->count());
        $this->assertEquals('entry', $entries->first()->type);
        $this->assertEquals('exit', $exits->first()->type);
    }

    /** @test */
    public function it_can_scope_by_date()
    {
        $today = now();
        $yesterday = now()->subDay();

        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => $today,
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => $yesterday,
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        $todayAttendances = Attendance::forDate($today)->get();
        $yesterdayAttendances = Attendance::forDate($yesterday)->get();

        $this->assertEquals(1, $todayAttendances->count());
        $this->assertEquals(1, $yesterdayAttendances->count());
    }

    /** @test */
    public function it_can_scope_valid_records()
    {
        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'cancelled',
        ]);

        $validAttendances = Attendance::valid()->get();

        $this->assertEquals(1, $validAttendances->count());
        $this->assertEquals('valid', $validAttendances->first()->status);
    }
}
