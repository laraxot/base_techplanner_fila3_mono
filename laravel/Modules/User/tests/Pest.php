<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\User\Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

uses(
    TestCase::class,
    DatabaseTransactions::class, // ✅ CORRETTO - Rollback automatico
    WithFaker::class,
)->in('Feature', 'Unit');

    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Here you may define your custom expectations to be used in your tests.
|
*/

expect()->extend('toBeUser', function () {
    return $this->toBeInstanceOf(\Modules\User\Models\User::class);
});

expect()->extend('toHaveProperty', function (string $property) {
    return expect(property_exists($this->value, $property))->toBeTrue();
});

expect()->extend('toHaveRole', function (string $roleName) {
    return expect($this->value->hasRole($roleName))->toBeTrue();
});

expect()->extend('toHavePermission', function (string $permissionName) {
    return expect($this->value->hasPermissionTo($permissionName))->toBeTrue();
});

expect()->extend('toHaveTeamRole', function (\Modules\User\Models\Team $team, string $role) {
    return expect($this->value->hasTeamRole($team, $role))->toBeTrue();
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Here you may define your custom helper functions to be used in your tests.
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

function createRole(array $attributes = []): \Modules\User\Models\Role
{
    return \Modules\User\Models\Role::factory()->create($attributes);
}

function createPermission(array $attributes = []): \Modules\User\Models\Permission
{
    return \Modules\User\Models\Permission::factory()->create($attributes);
}

function createTeam(array $attributes = []): \Modules\User\Models\Team
{
    return \Modules\User\Models\Team::factory()->create($attributes);
}

function createProfile(array $attributes = []): \Modules\User\Models\Profile
{
    return \Modules\User\Models\Profile::factory()->create($attributes);
}

function createTenant(array $attributes = []): \Modules\User\Models\Tenant
{
    return \Modules\User\Models\Tenant::factory()->create($attributes);
}

function createAuthenticationLog(array $attributes = []): \Modules\User\Models\AuthenticationLog
{
    return \Modules\User\Models\AuthenticationLog::factory()->create($attributes);
}
