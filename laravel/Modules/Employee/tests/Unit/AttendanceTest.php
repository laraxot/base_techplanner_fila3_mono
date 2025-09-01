<?php

declare(strict_types=1);

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
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
            'is_manual' => false,
        ]);

        expect($attendance)->toBeInstanceOf(Attendance::class);
        expect($attendance->user_id)->toBe($this->user->id);
        expect($attendance->type)->toBe('entry');
        expect($attendance->method)->toBe('badge');
        expect($attendance->status)->toBe('valid');
        expect($attendance->is_manual)->toBeFalse();
    });

    test('has user relationship', function () {
        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => now(),
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        expect($attendance->user)->toBeInstanceOf(User::class);
        expect($attendance->user->id)->toBe($this->user->id);
    });

    test('can check if entry', function () {
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

        expect($entry->isEntry())->toBeTrue();
        expect($exit->isEntry())->toBeFalse();
    });

    test('can check if exit', function () {
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

        expect($entry->isExit())->toBeFalse();
        expect($exit->isExit())->toBeTrue();
    });

    test('can check if manual', function () {
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

        expect($manual->isManual())->toBeTrue();
        expect($automatic->isManual())->toBeFalse();
    });

    test('can check if has location', function () {
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

        expect($withLocation->hasLocation())->toBeTrue();
        expect($withoutLocation->hasLocation())->toBeFalse();
    });

    test('can format timestamp', function () {
        $timestamp = Carbon::parse('2024-01-15 09:30:00');

        $attendance = Attendance::create([
            'user_id' => $this->user->id,
            'timestamp' => $timestamp,
            'type' => 'entry',
            'method' => 'badge',
            'status' => 'valid',
        ]);

        expect($attendance->formatted_timestamp)->toBe('15/01/2024 09:30:00');
        expect($attendance->formatted_time)->toBe('09:30:00');
        expect($attendance->formatted_date)->toBe('15/01/2024');
    });

    test('can scope by user', function () {
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

        expect($userAttendances)->toHaveCount(1);
        expect($otherUserAttendances)->toHaveCount(1);
        expect($userAttendances->first()->user_id)->toBe($this->user->id);
        expect($otherUserAttendances->first()->user_id)->toBe($otherUser->id);
    });

    test('can scope by type', function () {
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

        expect($entries)->toHaveCount(1);
        expect($exits)->toHaveCount(1);
        expect($entries->first()->type)->toBe('entry');
        expect($exits->first()->type)->toBe('exit');
    });

    test('can scope by date', function () {
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

        expect($todayAttendances)->toHaveCount(1);
        expect($yesterdayAttendances)->toHaveCount(1);
    });

    test('can scope valid records', function () {
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

        expect($validAttendances)->toHaveCount(1);
        expect($validAttendances->first()->status)->toBe('valid');
    });
});
