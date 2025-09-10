<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Unit\Models;

<<<<<<< HEAD
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Carbon\Carbon;

uses(TestCase::class, RefreshDatabase::class);
=======
use Carbon\Carbon;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
>>>>>>> cda86dd (.)

beforeEach(function () {
    $this->employee = Employee::factory()->create();
    $this->workHour = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_IN,
        'timestamp' => now(),
    ]);
});

test('work hour can be created', function () {
    expect($this->workHour)->toBeInstanceOf(WorkHour::class);
});

test('work hour has fillable attributes', function () {
    $fillable = $this->workHour->getFillable();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($fillable)->toContain('employee_id');
    expect($fillable)->toContain('type');
    expect($fillable)->toContain('timestamp');
    expect($fillable)->toContain('location_lat');
    expect($fillable)->toContain('location_lng');
    expect($fillable)->toContain('status');
});

test('work hour has casts defined', function () {
    $casts = $this->workHour->getCasts();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
    expect($casts)->toHaveKey('timestamp');
    expect($casts)->toHaveKey('approved_at');
    expect($casts)->toHaveKey('device_info');
});

test('work hour has proper table name', function () {
    expect($this->workHour->getTable())->toBe('time_entries');
<<<<<<< HEAD
    expect($this->workHour->getTable())->toBe('work_hours');
    expect($this->workHour->getTable())->toBe('time_entries');
=======
>>>>>>> cda86dd (.)
});

test('work hour belongs to employee', function () {
    expect($this->workHour->employee())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

test('work hour can be filtered by type', function () {
    $clockIn = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_IN,
        'timestamp' => now(),
    ]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $clockOut = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_OUT,
        'timestamp' => now()->addHours(8),
    ]);
<<<<<<< HEAD
    
    $clockIns = WorkHour::ofType(WorkHour::TYPE_CLOCK_IN)->get();
    $clockOuts = WorkHour::ofType(WorkHour::TYPE_CLOCK_OUT)->get();
    
=======
>>>>>>> cda86dd (.)

    $clockIns = WorkHour::ofType(WorkHour::TYPE_CLOCK_IN)->get();
    $clockOuts = WorkHour::ofType(WorkHour::TYPE_CLOCK_OUT)->get();

    expect($clockIns)->toHaveCount(1);
    expect($clockIns->first()->id)->toBe($clockIn->id);
<<<<<<< HEAD
    

    
    $clockIns = WorkHour::ofType(WorkHour::TYPE_CLOCK_IN)->get();
    $clockOuts = WorkHour::ofType(WorkHour::TYPE_CLOCK_OUT)->get();
    
    expect($clockIns)->toHaveCount(1);
    expect($clockIns->first()->id)->toBe($clockIn->id);

    
=======

>>>>>>> cda86dd (.)
    expect($clockOuts)->toHaveCount(1);
    expect($clockOuts->first()->id)->toBe($clockOut->id);
});

test('work hour can be filtered by date', function () {
    $today = now();
    $yesterday = now()->subDay();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $todayWorkHour = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'timestamp' => $today,
    ]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $yesterdayWorkHour = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'timestamp' => $yesterday,
    ]);
<<<<<<< HEAD
    

    $todayWorkHours = WorkHour::forDate($today)->get();
    

    $todayWorkHours = WorkHour::forDate($today)->get();

    
    $todayWorkHours = WorkHour::forDate($today)->get();
    
=======

    $todayWorkHours = WorkHour::forDate($today)->get();

>>>>>>> cda86dd (.)
    expect($todayWorkHours)->toHaveCount(1);
    expect($todayWorkHours->first()->id)->toBe($todayWorkHour->id);
});

test('work hour can be filtered by employee', function () {
    $employee2 = Employee::factory()->create();
<<<<<<< HEAD
    
    $workHour1 = WorkHour::factory()->create(['employee_id' => $this->employee->id]);
    $workHour2 = WorkHour::factory()->create(['employee_id' => $employee2->id]);
    
=======
>>>>>>> cda86dd (.)

    $workHour1 = WorkHour::factory()->create(['employee_id' => $this->employee->id]);
    $workHour2 = WorkHour::factory()->create(['employee_id' => $employee2->id]);

    $employee1WorkHours = WorkHour::forEmployee($this->employee->id)->get();
<<<<<<< HEAD
    

    
    $workHour1 = WorkHour::factory()->create(['employee_id' => $this->employee->id]);
    $workHour2 = WorkHour::factory()->create(['employee_id' => $employee2->id]);
    
    $employee1WorkHours = WorkHour::forEmployee($this->employee->id)->get();

    
=======

>>>>>>> cda86dd (.)
    expect($employee1WorkHours)->toHaveCount(1);
    expect($employee1WorkHours->first()->id)->toBe($workHour1->id);
});

test('work hour has proper relationships', function () {
    expect($this->workHour->employee())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

test('work hour can get formatted time attributes', function () {
    $workHour = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'timestamp' => Carbon::create(2024, 1, 15, 9, 30, 0),
    ]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($workHour->formatted_time)->toBe('09:30:00');
    expect($workHour->formatted_date)->toBe('15/01/2024');
    expect($workHour->formatted_date_time)->toBe('15/01/2024 09:30:00');
});

test('work hour can calculate worked hours', function () {
    $clockIn = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_IN,
        'timestamp' => now()->subHours(8),
    ]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $clockOut = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_OUT,
        'timestamp' => now(),
    ]);
<<<<<<< HEAD
    

    $workedHours = WorkHour::calculateWorkedHours($this->employee->id);
    

    $workedHours = WorkHour::calculateWorkedHours($this->employee->id);

    
    $workedHours = WorkHour::calculateWorkedHours($this->employee->id);
    
=======

    $workedHours = WorkHour::calculateWorkedHours($this->employee->id);

>>>>>>> cda86dd (.)
    expect($workedHours)->toBe(8.0);
});

test('work hour can get current status', function () {
    $clockIn = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_IN,
        'timestamp' => now()->subHours(1),
    ]);
<<<<<<< HEAD
    

    $status = WorkHour::getCurrentStatus($this->employee->id);
    

    $status = WorkHour::getCurrentStatus($this->employee->id);

    
    $status = WorkHour::getCurrentStatus($this->employee->id);
    
=======

    $status = WorkHour::getCurrentStatus($this->employee->id);

>>>>>>> cda86dd (.)
    expect($status)->toBe('clocked_in');
});

test('work hour validates next entry type', function () {
    $clockIn = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'type' => WorkHour::TYPE_CLOCK_IN,
        'timestamp' => now()->subHours(1),
    ]);
<<<<<<< HEAD
    

    $isValid = WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT);
    

    $isValid = WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT);

    
    $isValid = WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT);
    
=======

    $isValid = WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT);

>>>>>>> cda86dd (.)
    expect($isValid)->toBeTrue();
});

test('work hour can get today entries', function () {
    $today = now();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $workHour1 = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'timestamp' => $today->copy()->setTime(9, 0),
    ]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $workHour2 = WorkHour::factory()->create([
        'employee_id' => $this->employee->id,
        'timestamp' => $today->copy()->setTime(17, 0),
    ]);
<<<<<<< HEAD
    

    $todayEntries = WorkHour::getTodayEntries($this->employee->id, $today);
    

    $todayEntries = WorkHour::getTodayEntries($this->employee->id, $today);

    
    $todayEntries = WorkHour::getTodayEntries($this->employee->id, $today);
    
=======

    $todayEntries = WorkHour::getTodayEntries($this->employee->id, $today);

>>>>>>> cda86dd (.)
    expect($todayEntries)->toHaveCount(2);
    expect($todayEntries->first()->id)->toBe($workHour1->id);
    expect($todayEntries->last()->id)->toBe($workHour2->id);
});
