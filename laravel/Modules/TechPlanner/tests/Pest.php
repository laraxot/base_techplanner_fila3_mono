<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests;

/*
 * |--------------------------------------------------------------------------
 * | Test Case
 * |--------------------------------------------------------------------------
 * |
 * | Il TestCase di default per tutti i test del modulo TechPlanner.
 * | Estende il TestCase specifico del modulo che fornisce il setup necessario.
 * |
 */

uses(TestCase::class)->uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class)->in('Feature', 'Unit');

/*
 * |--------------------------------------------------------------------------
 * | Expectations
 * |--------------------------------------------------------------------------
 * |
 * | Aspettative globali per il modulo TechPlanner.
 * | Quando definisci expectation globali, saranno disponibili
 * | in tutti i test del modulo.
 * |
 */

expect()->extend('toBeProject', fn () => $this->toBeInstanceOf(\Modules\TechPlanner\Models\Project::class));

expect()->extend('toBeTask', fn () => $this->toBeInstanceOf(\Modules\TechPlanner\Models\Task::class));

expect()->extend('toBeResource', fn () => $this->toBeInstanceOf(\Modules\TechPlanner\Models\Resource::class));

/*
 * |--------------------------------------------------------------------------
 * | Functions
 * |--------------------------------------------------------------------------
 * |
 * | Funzioni helper globali per i test del modulo TechPlanner.
 * | Queste funzioni saranno disponibili in tutti i test.
 * |
 */

function createProject(array $attributes = []): \Modules\TechPlanner\Models\Project
{
    return \Modules\TechPlanner\Models\Project::factory()->create($attributes);
}

function makeProject(array $attributes = []): \Modules\TechPlanner\Models\Project
{
    return \Modules\TechPlanner\Models\Project::factory()->make($attributes);
}

function createTask(array $attributes = []): \Modules\TechPlanner\Models\Task
{
    return \Modules\TechPlanner\Models\Task::factory()->create($attributes);
}

function makeTask(array $attributes = []): \Modules\TechPlanner\Models\Task
{
    return \Modules\TechPlanner\Models\Task::factory()->make($attributes);
}

function createResource(array $attributes = []): \Modules\TechPlanner\Models\Resource
{
    return \Modules\TechPlanner\Models\Resource::factory()->create($attributes);
}

function makeResource(array $attributes = []): \Modules\TechPlanner\Models\Resource
{
    return \Modules\TechPlanner\Models\Resource::factory()->make($attributes);
}
