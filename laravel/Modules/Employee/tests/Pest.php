<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Employee\Tests\TestCase;
=======
use Modules\Employee\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> cda86dd (.)

// ✅ CONFIGURAZIONE CORRETTA PEST + DATABASE TRANSACTIONS
uses(TestCase::class, DatabaseTransactions::class)->in('Feature', 'Unit', 'Integration');

expect()->extend('toBeEmployee', function () {
    return $this->toBeInstanceOf(\Modules\Employee\Models\Employee::class);
});

expect()->extend('toBeWorkHour', function () {
    return $this->toBeInstanceOf(\Modules\Employee\Models\WorkHour::class);
});

function createEmployee(array $attributes = []): \Modules\Employee\Models\Employee
{
    return \Modules\Employee\Models\Employee::factory()->create($attributes);
}

function makeEmployee(array $attributes = []): \Modules\Employee\Models\Employee
{
    return \Modules\Employee\Models\Employee::factory()->make($attributes);
}

function createWorkHour(array $attributes = []): \Modules\Employee\Models\WorkHour
{
    return \Modules\Employee\Models\WorkHour::factory()->create($attributes);
}

function makeWorkHour(array $attributes = []): \Modules\Employee\Models\WorkHour
{
    return \Modules\Employee\Models\WorkHour::factory()->make($attributes);
}
