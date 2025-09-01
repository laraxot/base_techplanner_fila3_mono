<?php

declare(strict_types=1);



namespace Modules\UI\Tests;
use Modules\UI\Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| Il TestCase di default per tutti i test del modulo UI.
| Estende il TestCase specifico del modulo che fornisce il setup necessario.
|
*/

pest()->extend(TestCase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Aspettative globali per il modulo UI.
| Quando definisci expectation globali, saranno disponibili 
| in tutti i test del modulo.
|
*/

expect()->extend('toBeComponent', function () {
    return $this->toBeInstanceOf(\Modules\UI\Models\Component::class);
});

expect()->extend('toBeTheme', function () {
    return $this->toBeInstanceOf(\Modules\UI\Models\Theme::class);
});

expect()->extend('toBeAsset', function () {
    return $this->toBeInstanceOf(\Modules\UI\Models\Asset::class);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Funzioni helper globali per i test del modulo UI.
| Queste funzioni saranno disponibili in tutti i test.
|
*/

function createTheme(array $attributes = []): \Modules\UI\Models\Theme
{
    return \Modules\UI\Models\Theme::factory()->create($attributes);
}

function makeTheme(array $attributes = []): \Modules\UI\Models\Theme
{
    return \Modules\UI\Models\Theme::factory()->make($attributes);
}

function createComponent(array $attributes = []): \Modules\UI\Models\Component
{
    return \Modules\UI\Models\Component::factory()->create($attributes);
}

function makeComponent(array $attributes = []): \Modules\UI\Models\Component
{
    return \Modules\UI\Models\Component::factory()->make($attributes);
}

function createAsset(array $attributes = []): \Modules\UI\Models\Asset
{
    return \Modules\UI\Models\Asset::factory()->create($attributes);
}

function makeAsset(array $attributes = []): \Modules\UI\Models\Asset
{
    return \Modules\UI\Models\Asset::factory()->make($attributes);
}
