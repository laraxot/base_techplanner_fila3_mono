<?php

declare(strict_types=1);



namespace Modules\Employee\Tests;
use Modules\Employee\Tests\TestCase;

pest()->extend(TestCase::class)
    ->in('Feature', 'Unit');

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