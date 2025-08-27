<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
=======
>>>>>>> fc93b0f (.)
use Modules\User\Tests\TestCase;

/*
|--------------------------------------------------------------------------
<<<<<<< HEAD
| Test Configuration
|--------------------------------------------------------------------------
|
| This file configures Pest testing for the User module.
| It sets up the test environment, custom expectations, and helper functions.
|
*/

uses(
    TestCase::class,
    RefreshDatabase::class,
    WithFaker::class,
)->in('Feature', 'Unit');

uses()->group('user')->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Custom Expectations
|--------------------------------------------------------------------------
|
| Custom expectations for the User module models and relationships.
=======
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(TestCase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
>>>>>>> fc93b0f (.)
|
*/

expect()->extend('toBeUser', function () {
    return $this->toBeInstanceOf(\Modules\User\Models\User::class);
});

expect()->extend('toBeTeam', function () {
    return $this->toBeInstanceOf(\Modules\User\Models\Team::class);
});

expect()->extend('toBeProfile', function () {
    return $this->toBeInstanceOf(\Modules\User\Models\Profile::class);
});

<<<<<<< HEAD
expect()->extend('toBeRole', function () {
    return $this->toBeInstanceOf(\Modules\User\Models\Role::class);
});

expect()->extend('toHaveRole', function (string $roleName) {
    return $this->value->hasRole($roleName);
});

expect()->extend('toHavePermission', function (string $permissionName) {
    return $this->value->hasPermissionTo($permissionName);
});

/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
|
| Helper functions for creating test data in the User module.
=======
/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
>>>>>>> fc93b0f (.)
|
*/

function createUser(array $attributes = []): \Modules\User\Models\User
{
    return \Modules\User\Models\User::factory()->create($attributes);
}

function makeUser(array $attributes = []): \Modules\User\Models\User
{
    return \Modules\User\Models\User::factory()->make($attributes);
}

function createTeam(array $attributes = []): \Modules\User\Models\Team
{
    return \Modules\User\Models\Team::factory()->create($attributes);
}

function createProfile(array $attributes = []): \Modules\User\Models\Profile
{
    return \Modules\User\Models\Profile::factory()->create($attributes);
<<<<<<< HEAD
}

function createRole(array $attributes = []): \Modules\User\Models\Role
{
    return \Modules\User\Models\Role::factory()->create($attributes);
}

function createPermission(array $attributes = []): \Modules\User\Models\Permission
{
    return \Modules\User\Models\Permission::factory()->create($attributes);
}

function createTenant(array $attributes = []): \Modules\User\Models\Tenant
{
    return \Modules\User\Models\Tenant::factory()->create($attributes);
}

function createTeamUser(array $attributes = []): \Modules\User\Models\TeamUser
{
    return \Modules\User\Models\TeamUser::factory()->create($attributes);
}

function createTeamPermission(array $attributes = []): \Modules\User\Models\TeamPermission
{
    return \Modules\User\Models\TeamPermission::factory()->create($attributes);
}

function createModelHasRole(array $attributes = []): \Modules\User\Models\ModelHasRole
{
    return \Modules\User\Models\ModelHasRole::factory()->create($attributes);
}

function createModelHasPermission(array $attributes = []): \Modules\User\Models\ModelHasPermission
{
    return \Modules\User\Models\ModelHasPermission::factory()->create($attributes);
=======
>>>>>>> fc93b0f (.)
}