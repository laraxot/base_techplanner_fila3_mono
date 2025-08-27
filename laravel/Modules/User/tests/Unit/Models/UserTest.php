<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\User\Models\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Hash;

test('user can be created', function () {
    $user = createUser([
        'name' => 'Mario Rossi',
        'email' => 'mario.rossi@example.com',
        'type' => UserType::CustomerUser,
    ]);

    expect($user)
        ->toBeUser()
        ->and($user->name)->toBe('Mario Rossi')
        ->and($user->email)->toBe('mario.rossi@example.com')
        ->and($user->type)->toBe(UserType::CustomerUser);
});

test('user has required attributes', function () {
    $user = makeUser();

    expect($user)
        ->toHaveProperty('name')
        ->toHaveProperty('email')
        ->toHaveProperty('type')
        ->toHaveProperty('email_verified_at')
        ->toHaveProperty('password');
});

test('user can be bo user type', function () {
    $boUser = createUser(['type' => UserType::BoUser]);
    
    expect($boUser->type)->toBe(UserType::BoUser);
});

test('user can be customer user type', function () {
    $customerUser = createUser(['type' => UserType::CustomerUser]);
    
    expect($customerUser->type)->toBe(UserType::CustomerUser);
});

test('user password is hashed', function () {
    $user = createUser(['password' => 'password123']);
    
    expect($user->password)
        ->not->toBe('password123')
        ->and(Hash::check('password123', $user->password))->toBeTrue();
});

test('user email is unique', function () {
    createUser(['email' => 'test@example.com']);
    
    expect(fn() => createUser(['email' => 'test@example.com']))
        ->toThrow(Illuminate\Database\QueryException::class);
});

test('user can have profile', function () {
    $user = createUser();
    $profile = $user->profile()->create([
        'bio' => 'Test bio',
        'location' => 'Test location',
    ]);

    expect($user->profile)->toBe($profile);
    expect($user->profile->bio)->toBe('Test bio');
});

test('user can belong to teams', function () {
    $user = createUser();
    $team = createTeam(['name' => 'Test Team']);
    
    $user->teams()->attach($team->id, ['role' => 'member']);
    
    expect($user->teams)->toHaveCount(1);
    expect($user->teams->first()->name)->toBe('Test Team');
});

test('user can have roles', function () {
    $user = createUser();
    $role = createRole('admin');
    
    $user->assignRole($role);
    
    expect($user)->toHaveRole('admin');
    expect($user->hasRole('admin'))->toBeTrue();
});

test('user is active by default', function () {
    $user = createUser();
    
    expect($user->is_active)->toBeTrue();
});

test('user can be deactivated', function () {
    $user = createUser(['is_active' => false]);
    
    expect($user->is_active)->toBeFalse();
});

test('user email verification status', function () {
    $user = createUser(['email_verified_at' => null]);
    
    expect($user->hasVerifiedEmail())->toBeFalse();
    
    $user->markEmailAsVerified();
    
    expect($user->hasVerifiedEmail())->toBeTrue();
    expect($user->email_verified_at)->not->toBeNull();
=======
namespace Modules\User\Tests\Unit\Models;

use Modules\User\Models\User;
use Modules\User\Models\Team;
use Modules\User\Models\Tenant;
use Modules\User\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('user can be created', function () {
    expect($this->user)->toBeInstanceOf(User::class);
});

test('user has fillable attributes', function () {
    $fillable = $this->user->getFillable();
    
    expect($fillable)->toContain('name');
    expect($fillable)->toContain('email');
    expect($fillable)->toContain('password');
});

test('user has hidden attributes', function () {
    $hidden = $this->user->getHidden();
    
    expect($hidden)->toContain('password');
    expect($hidden)->toContain('remember_token');
});

test('user has casts defined', function () {
    $casts = $this->user->getCasts();
    
    expect($casts)->toHaveKey('email_verified_at');
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
});

test('user can have teams', function () {
    $team = Team::factory()->create();
    $this->user->teams()->attach($team);
    
    expect($this->user->teams)->toBeInstanceOf(Collection::class);
    expect($this->user->teams)->toHaveCount(1);
    expect($this->user->teams->first())->toBeInstanceOf(Team::class);
});

test('user can have tenants', function () {
    $tenant = Tenant::factory()->create();
    $this->user->tenants()->attach($tenant);
    
    expect($this->user->tenants)->toBeInstanceOf(Collection::class);
    expect($this->user->tenants)->toHaveCount(1);
    expect($this->user->tenants->first())->toBeInstanceOf(Tenant::class);
});

test('user can check if belongs to team', function () {
    $team = Team::factory()->create();
    $this->user->teams()->attach($team);
    
    expect($this->user->belongsToTeam($team))->toBeTrue();
    expect($this->user->belongsToTeam($team->id))->toBeTrue();
});

test('user can check if belongs to tenant', function () {
    $tenant = Tenant::factory()->create();
    $this->user->tenants()->attach($tenant);
    
    expect($this->user->belongsToTenant($tenant))->toBeTrue();
    expect($this->user->belongsToTenant($tenant->id))->toBeTrue();
});

test('user has profile relationship', function () {
    expect($this->user->profile)->toBeNull();
    
    $profile = $this->user->profile()->create([
        'bio' => 'Test bio',
        'location' => 'Test location'
    ]);
    
    expect($this->user->fresh()->profile)->toBeInstanceOf(\Modules\User\Models\Profile::class);
});

test('user has authentication logs', function () {
    expect($this->user->authentications)->toBeInstanceOf(Collection::class);
    expect($this->user->authentications)->toHaveCount(0);
});

test('user has devices', function () {
    expect($this->user->devices)->toBeInstanceOf(Collection::class);
    expect($this->user->devices)->toHaveCount(0);
});

test('user can be scoped by tenant', function () {
    $tenant = Tenant::factory()->create();
    $this->user->tenants()->attach($tenant);
    
    $scopedUsers = User::belongsToTenant($tenant)->get();
    
    expect($scopedUsers)->toHaveCount(1);
    expect($scopedUsers->first()->id)->toBe($this->user->id);
>>>>>>> fc93b0f (.)
});
