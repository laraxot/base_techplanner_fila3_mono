<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

use Modules\User\Models\Team;
use Modules\User\Models\User;
use Modules\User\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->team = Team::factory()->create();
});

test('team can be created', function () {
    expect($this->team)->toBeInstanceOf(Team::class);
});

test('team has fillable attributes', function () {
    $fillable = $this->team->getFillable();
    
    expect($fillable)->toContain('name');
    expect($fillable)->toContain('personal_team');
});

test('team has casts defined', function () {
    $casts = $this->team->getCasts();
    
    expect($casts)->toHaveKey('personal_team');
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
});

test('team can have users', function () {
    $user = User::factory()->create();
    $this->team->users()->attach($user);
    
    expect($this->team->users)->toBeInstanceOf(Collection::class);
    expect($this->team->users)->toHaveCount(1);
    expect($this->team->users->first())->toBeInstanceOf(User::class);
});

test('team can have owner', function () {
    $owner = User::factory()->create();
    $this->team->users()->attach($owner, ['role' => 'owner']);
    
    expect($this->team->owner)->toBeInstanceOf(User::class);
    expect($this->team->owner->id)->toBe($owner->id);
});

test('team can check if user is owner', function () {
    $owner = User::factory()->create();
    $this->team->users()->attach($owner, ['role' => 'owner']);
    
    expect($this->team->userHasPermission($owner, 'delete'))->toBeTrue();
    expect($this->team->userHasPermission($owner, 'update'))->toBeTrue();
});

test('team can check if user has permission', function () {
    $user = User::factory()->create();
    $this->team->users()->attach($user, ['role' => 'member']);
    
    expect($this->team->userHasPermission($user, 'read'))->toBeTrue();
    expect($this->team->userHasPermission($user, 'delete'))->toBeFalse();
});

test('team can be personal', function () {
    $personalTeam = Team::factory()->create(['personal_team' => true]);
    
    expect($personalTeam->personal_team)->toBeTrue();
});

test('team can be non personal', function () {
    $nonPersonalTeam = Team::factory()->create(['personal_team' => false]);
    
    expect($nonPersonalTeam->personal_team)->toBeFalse();
});

test('team has proper table name', function () {
    expect($this->team->getTable())->toBe('teams');
});

test('team can be scoped by user', function () {
    $user = User::factory()->create();
    $this->team->users()->attach($user);
    
    $userTeams = Team::forUser($user)->get();
    
    expect($userTeams)->toHaveCount(1);
    expect($userTeams->first()->id)->toBe($this->team->id);
});
