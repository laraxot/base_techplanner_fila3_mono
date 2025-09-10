<?php

declare(strict_types=1);

<<<<<<< HEAD
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
=======
use Carbon\Carbon;
use Modules\Employee\Models\Attendance;
use Modules\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

describe('Attendance Model', function () {
    
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    test('can create attendance record', function () {
>>>>>>> cda86dd (.)
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
            'is_manual' => false,
        ]);

<<<<<<< HEAD
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
=======
        expect($attendance)->toBeInstanceOf(Attendance::class);
        expect($attendance->user_id)->toBe($this->user->id);
        expect($attendance->type)->toBe('entry');
        expect($attendance->method)->toBe('badge');
        expect($attendance->status)->toBe('valid');
        expect($attendance->is_manual)->toBeFalse();
    });

    test('has user relationship', function () {
>>>>>>> cda86dd (.)
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

<<<<<<< HEAD
        $this->assertInstanceOf(User::class, $attendance->user);
        $this->assertEquals($this->user->id, $attendance->user->id);
    }

    /** @test */
    public function it_can_check_if_entry()
    {
=======
        expect($attendance->user)->toBeInstanceOf(User::class);
        expect($attendance->user->id)->toBe($this->user->id);
    });

    test('can check if entry', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertTrue($entry->isEntry());
        $this->assertFalse($exit->isEntry());
    }

    /** @test */
    public function it_can_check_if_exit()
    {
=======
        expect($entry->isEntry())->toBeTrue();
        expect($exit->isEntry())->toBeFalse();
    });

    test('can check if exit', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertFalse($entry->isExit());
        $this->assertTrue($exit->isExit());
    }

    /** @test */
    public function it_can_check_if_manual()
    {
=======
        expect($entry->isExit())->toBeFalse();
        expect($exit->isExit())->toBeTrue();
    });

    test('can check if manual', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertTrue($manual->isManual());
        $this->assertFalse($automatic->isManual());
    }

    /** @test */
    public function it_can_check_if_has_location()
    {
=======
        expect($manual->isManual())->toBeTrue();
        expect($automatic->isManual())->toBeFalse();
    });

    test('can check if has location', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertTrue($withLocation->hasLocation());
        $this->assertFalse($withoutLocation->hasLocation());
    }

    /** @test */
    public function it_can_format_timestamp()
    {
        $timestamp = Carbon::parse('2024-01-15 09:30:00');
        
=======
        expect($withLocation->hasLocation())->toBeTrue();
        expect($withoutLocation->hasLocation())->toBeFalse();
    });

    test('can format timestamp', function () {
        $timestamp = Carbon::parse('2024-01-15 09:30:00');

>>>>>>> cda86dd (.)
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => $timestamp,
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

<<<<<<< HEAD
        $this->assertEquals('15/01/2024 09:30:00', $attendance->formatted_timestamp);
        $this->assertEquals('09:30:00', $attendance->formatted_time);
        $this->assertEquals('15/01/2024', $attendance->formatted_date);
    }

    /** @test */
    public function it_can_scope_by_user()
    {
=======
        expect($attendance->formatted_timestamp)->toBe('15/01/2024 09:30:00');
        expect($attendance->formatted_time)->toBe('09:30:00');
        expect($attendance->formatted_date)->toBe('15/01/2024');
    });

    test('can scope by user', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertEquals(1, $userAttendances->count());
        $this->assertEquals(1, $otherUserAttendances->count());
        $this->assertEquals($this->user->id, $userAttendances->first()->user_id);
        $this->assertEquals($otherUser->id, $otherUserAttendances->first()->user_id);
    }

    /** @test */
    public function it_can_scope_by_type()
    {
=======
        expect($userAttendances)->toHaveCount(1);
        expect($otherUserAttendances)->toHaveCount(1);
        expect($userAttendances->first()->user_id)->toBe($this->user->id);
        expect($otherUserAttendances->first()->user_id)->toBe($otherUser->id);
    });

    test('can scope by type', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertEquals(1, $entries->count());
        $this->assertEquals(1, $exits->count());
        $this->assertEquals('entry', $entries->first()->type);
        $this->assertEquals('exit', $exits->first()->type);
    }

    /** @test */
    public function it_can_scope_by_date()
    {
=======
        expect($entries)->toHaveCount(1);
        expect($exits)->toHaveCount(1);
        expect($entries->first()->type)->toBe('entry');
        expect($exits->first()->type)->toBe('exit');
    });

    test('can scope by date', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertEquals(1, $todayAttendances->count());
        $this->assertEquals(1, $yesterdayAttendances->count());
    }

    /** @test */
    public function it_can_scope_valid_records()
    {
=======
        expect($todayAttendances)->toHaveCount(1);
        expect($yesterdayAttendances)->toHaveCount(1);
    });

    test('can scope valid records', function () {
>>>>>>> cda86dd (.)
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

<<<<<<< HEAD
        $this->assertEquals(1, $validAttendances->count());
        $this->assertEquals('valid', $validAttendances->first()->status);
    }
} 
=======
        expect($validAttendances)->toHaveCount(1);
        expect($validAttendances->first()->status)->toBe('valid');
    });
});
>>>>>>> cda86dd (.)
