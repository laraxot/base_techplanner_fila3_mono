<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Unit\Models;

<<<<<<< HEAD
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\Department;
use Modules\Employee\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;use Illuminate\Database\Eloquent\Collection;
=======
use Illuminate\Database\Eloquent\Collection;
>>>>>>> cda86dd (.)
use Illuminate\Support\Facades\DB;
use Modules\Employee\Models\Department;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\Position;
use Modules\Employee\Tests\TestCase;

<<<<<<< HEAD
uses(TestCase::class, RefreshDatabase::class);
use Illuminate\Support\Facades\DB;

=======
>>>>>>> cda86dd (.)
uses(TestCase::class);

beforeEach(function () {
    DB::beginTransaction();
});

afterEach(function () {
    DB::rollBack();
});
<<<<<<< HEAD
uses(TestCase::class, RefreshDatabase::class);
=======
>>>>>>> cda86dd (.)

beforeEach(function () {
    $this->employee = Employee::factory()->create([
        'personal_data' => [
            'first_name' => 'Mario',
            'last_name' => 'Rossi',
        ],
        'contact_data' => [
            'email' => 'mario.rossi@example.com',
            'phone' => '+39 123 456 7890',
        ],
        'work_data' => [
            'employee_id' => 'EMP001',
            'hire_date' => '2024-01-01',
        ],
        'status' => 'attivo',
    ]);
});

test('employee can be created', function () {
    expect($this->employee)->toBeInstanceOf(Employee::class);
});

test('employee has fillable attributes', function () {
    $fillable = $this->employee->getFillable();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($fillable)->toContain('user_id');
    expect($fillable)->toContain('employee_code');
    expect($fillable)->toContain('personal_data');
    expect($fillable)->toContain('contact_data');
    expect($fillable)->toContain('work_data');
    expect($fillable)->toContain('status');
});

test('employee has casts defined', function () {
    $casts = $this->employee->getCasts();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($casts)->toHaveKey('personal_data');
    expect($casts)->toHaveKey('contact_data');
    expect($casts)->toHaveKey('work_data');
    expect($casts)->toHaveKey('documents');
    expect($casts)->toHaveKey('salary_data');
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
});

test('employee has proper table name', function () {
    expect($this->employee->getTable())->toBe('employees');
});

test('employee belongs to user', function () {
    expect($this->employee->user())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

test('employee belongs to department', function () {
    $department = Department::factory()->create();
    $this->employee->update(['department_id' => $department->id]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($this->employee->department)->toBeInstanceOf(Department::class);
    expect($this->employee->department->id)->toBe($department->id);
});

test('employee belongs to position', function () {
    $position = Position::factory()->create();
    $this->employee->update(['position_id' => $position->id]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($this->employee->position)->toBeInstanceOf(Position::class);
    expect($this->employee->position->id)->toBe($position->id);
});

test('employee can have manager', function () {
    $manager = Employee::factory()->create();
    $this->employee->update(['manager_id' => $manager->id]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($this->employee->manager)->toBeInstanceOf(Employee::class);
    expect($this->employee->manager->id)->toBe($manager->id);
});

test('employee can have subordinates', function () {
    $subordinate = Employee::factory()->create(['manager_id' => $this->employee->id]);
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    expect($this->employee->subordinates)->toBeInstanceOf(Collection::class);
    expect($this->employee->subordinates)->toHaveCount(1);
    expect($this->employee->subordinates->first()->id)->toBe($subordinate->id);
});

test('employee can get full name', function () {
    expect($this->employee->full_name)->toBe('Mario Rossi');
});

test('employee can get email', function () {
    expect($this->employee->email)->toBe('mario.rossi@example.com');
});

test('employee can get phone', function () {
    expect($this->employee->phone)->toBe('+39 123 456 7890');
});

test('employee can check if active', function () {
    expect($this->employee->isActive())->toBeTrue();
<<<<<<< HEAD
    

    
=======

>>>>>>> cda86dd (.)
    $this->employee->update(['status' => 'inattivo']);
    expect($this->employee->isActive())->toBeFalse();
});

test('employee can check if has manager', function () {
    expect($this->employee->hasManager())->toBeFalse();
<<<<<<< HEAD
    

    $manager = Employee::factory()->create();
    $this->employee->update(['manager_id' => $manager->id]);
    
=======
>>>>>>> cda86dd (.)

    $manager = Employee::factory()->create();
    $this->employee->update(['manager_id' => $manager->id]);

<<<<<<< HEAD
    
    $manager = Employee::factory()->create();
    $this->employee->update(['manager_id' => $manager->id]);
    
=======
>>>>>>> cda86dd (.)
    expect($this->employee->hasManager())->toBeTrue();
});

test('employee can check if has subordinates', function () {
    expect($this->employee->hasSubordinates())->toBeFalse();
<<<<<<< HEAD
    

    Employee::factory()->create(['manager_id' => $this->employee->id]);
    

    Employee::factory()->create(['manager_id' => $this->employee->id]);

    
    Employee::factory()->create(['manager_id' => $this->employee->id]);
    
=======

    Employee::factory()->create(['manager_id' => $this->employee->id]);

>>>>>>> cda86dd (.)
    expect($this->employee->hasSubordinates())->toBeTrue();
});

test('employee can be filtered by status', function () {
    $activeEmployee = Employee::factory()->create(['status' => 'attivo']);
    $inactiveEmployee = Employee::factory()->create(['status' => 'inattivo']);
<<<<<<< HEAD
    
    $activeEmployees = Employee::active()->get();
    $inactiveEmployees = Employee::inactive()->get();
    
=======
>>>>>>> cda86dd (.)

    $activeEmployees = Employee::active()->get();
    $inactiveEmployees = Employee::inactive()->get();

    expect($activeEmployees)->toHaveCount(2); // Including the one from beforeEach
    expect($inactiveEmployees)->toHaveCount(1);
<<<<<<< HEAD
    

    
    $activeEmployees = Employee::active()->get();
    $inactiveEmployees = Employee::inactive()->get();
    
    expect($activeEmployees)->toHaveCount(2); // Including the one from beforeEach
    expect($inactiveEmployees)->toHaveCount(1);

    
=======

>>>>>>> cda86dd (.)
    expect($activeEmployees->pluck('id'))->toContain($this->employee->id);
    expect($activeEmployees->pluck('id'))->toContain($activeEmployee->id);
    expect($inactiveEmployees->pluck('id'))->toContain($inactiveEmployee->id);
});

test('employee has work hours relationship', function () {
    expect($this->employee->workHours())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('employee has leaves relationship', function () {
    expect($this->employee->leaves())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('employee has documents relationship', function () {
    expect($this->employee->documents())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});
