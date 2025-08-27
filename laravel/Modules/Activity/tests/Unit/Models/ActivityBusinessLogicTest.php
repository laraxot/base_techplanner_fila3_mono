<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Modules\User\Models\User;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

test('activity implements activity contract', function () {
    $activity = Activity::factory()->make();
    
    expect($activity)->toBeInstanceOf(ActivityContract::class);
});

test('activity has correct fillable attributes', function () {
    $activity = new Activity();
    
    $expectedFillable = [
        'id',
        'log_name',
        'description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
        'created_at',
        'updated_at',
    ];
    
    expect($activity->getFillable())->toBe($expectedFillable);
});

test('activity uses correct connection', function () {
    $activity = new Activity();
    
    expect($activity->getConnectionName())->toBe('activity');
});

test('activity properties are cast to collection', function () {
    $activity = Activity::factory()->create([
        'properties' => ['key' => 'value', 'count' => 42]
    ]);
    
    expect($activity->properties)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveKey('key', 'value')
        ->toHaveKey('count', 42);
});

test('activity can scope by log name', function () {
    $defaultActivity = Activity::factory()->create(['log_name' => 'default']);
    $customActivity = Activity::factory()->create(['log_name' => 'custom']);
    
    $scopedActivities = Activity::inLog('custom')->get();
    
    expect($scopedActivities)
        ->toHaveCount(1)
        ->first()->id->toBe($customActivity->id);
});

test('activity can scope by event', function () {
    $createdActivity = Activity::factory()->create(['event' => 'created']);
    $updatedActivity = Activity::factory()->create(['event' => 'updated']);
    
    $scopedActivities = Activity::forEvent('created')->get();
    
    expect($scopedActivities)
        ->toHaveCount(1)
        ->first()->id->toBe($createdActivity->id);
});

test('activity can scope by causer', function () {
    $user = User::factory()->create();
    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id
    ]);
    
    $scopedActivities = Activity::causedBy($user)->get();
    
    expect($scopedActivities)
        ->toHaveCount(1)
        ->first()->id->toBe($activity->id);
});

test('activity can scope by subject', function () {
    $user = User::factory()->create();
    $activity = Activity::factory()->create([
        'subject_type' => User::class,
        'subject_id' => $user->id
    ]);
    
    $scopedActivities = Activity::forSubject($user)->get();
    
    expect($scopedActivities)
        ->toHaveCount(1)
        ->first()->id->toBe($activity->id);
});

test('activity can scope by batch uuid', function () {
    $batchUuid = \Illuminate\Support\Str::uuid();
    $activity = Activity::factory()->create(['batch_uuid' => $batchUuid]);
    
    $scopedActivities = Activity::forBatch($batchUuid)->get();
    
    expect($scopedActivities)
        ->toHaveCount(1)
        ->first()->id->toBe($activity->id);
});

test('activity changes property returns diff collection', function () {
    $activity = Activity::factory()->create([
        'properties' => ['attributes' => ['name' => 'new'], 'old' => ['name' => 'old']]
    ]);
    
    expect($activity->changes)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveKey('attributes')
        ->toHaveKey('old');
});

test('activity causer relationship returns correct model', function () {
    $user = User::factory()->create();
    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => $user->id
    ]);
    
    expect($activity->causer)
        ->toBeInstanceOf(User::class)
        ->id->toBe($user->id);
});

test('activity subject relationship returns correct model', function () {
    $user = User::factory()->create();
    $activity = Activity::factory()->create([
        'subject_type' => User::class,
        'subject_id' => $user->id
    ]);
    
    expect($activity->subject)
        ->toBeInstanceOf(User::class)
        ->id->toBe($user->id);
});

test('activity subject relationship returns null for non-existent subject', function () {
    $activity = Activity::factory()->create([
        'subject_type' => User::class,
        'subject_id' => 999999
    ]);
    
    expect($activity->subject)->toBeNull();
});

test('activity causer relationship returns null for non-existent causer', function () {
    $activity = Activity::factory()->create([
        'causer_type' => User::class,
        'causer_id' => 999999
    ]);
    
    expect($activity->causer)->toBeNull();
});

test('activity has batch scope works correctly', function () {
    $withBatch = Activity::factory()->create(['batch_uuid' => \Illuminate\Support\Str::uuid()]);
    $withoutBatch = Activity::factory()->create(['batch_uuid' => null]);
    
    $activitiesWithBatch = Activity::hasBatch()->get();
    
    expect($activitiesWithBatch)
        ->toHaveCount(1)
        ->first()->id->toBe($withBatch->id);
});

test('activity properties are properly serialized and unserialized', function () {
    $complexData = [
        'user' => ['id' => 1, 'name' => 'Test User'],
        'changes' => ['old' => ['status' => 'pending'], 'new' => ['status' => 'completed']],
        'metadata' => ['ip' => '127.0.0.1', 'user_agent' => 'Test Browser']
    ];
    
    $activity = Activity::factory()->create(['properties' => $complexData]);
    $freshActivity = $activity->fresh();
    
    expect($freshActivity->properties)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveKey('user')
        ->toHaveKey('changes')
        ->toHaveKey('metadata')
        ->user->toBeArray()->toHaveKeys(['id', 'name'])
        ->changes->toBeArray()->toHaveKeys(['old', 'new']);
});