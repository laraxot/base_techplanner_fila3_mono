<?php

declare(strict_types=1);

use Modules\Activity\Models\Snapshot;

test('snapshot has correct fillable attributes', function () {
    $snapshot = new Snapshot();
    
    $expectedFillable = [
        'id',
        'aggregate_uuid',
        'aggregate_version',
        'state',
        'created_at',
        'updated_at',
    ];
    
    expect($snapshot->getFillable())->toBe($expectedFillable);
});

test('snapshot uses correct connection', function () {
    $snapshot = new Snapshot();
    
    expect($snapshot->getConnectionName())->toBe('activity');
});

test('snapshot state is cast to array', function () {
    $stateData = ['balance' => 100, 'status' => 'active', 'transactions' => []];
    $snapshot = Snapshot::factory()->create(['state' => $stateData]);
    
    expect($snapshot->state)
        ->toBeArray()
        ->toHaveKey('balance', 100)
        ->toHaveKey('status', 'active')
        ->toHaveKey('transactions', []);
});

test('snapshot can scope by aggregate uuid', function () {
    $uuid1 = \Illuminate\Support\Str::uuid();
    $uuid2 = \Illuminate\Support\Str::uuid();
    
    $snapshot1 = Snapshot::factory()->create(['aggregate_uuid' => $uuid1]);
    $snapshot2 = Snapshot::factory()->create(['aggregate_uuid' => $uuid2]);
    
    $scopedSnapshots = Snapshot::uuid($uuid1)->get();
    
    expect($scopedSnapshots)
        ->toHaveCount(1)
        ->first()->id->toBe($snapshot1->id);
});

test('snapshot factory creates valid instances', function () {
    $snapshot = Snapshot::factory()->make();
    
    expect($snapshot)
        ->aggregate_uuid->toBeUuid()
        ->aggregate_version->toBeInt()->toBeGreaterThanOrEqual(1)
        ->state->toBeArray();
});

test('snapshot can be created with complex state data', function () {
    $complexState = [
        'user' => [
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'roles' => ['admin', 'user']
        ],
        'settings' => [
            'notifications' => true,
            'theme' => 'dark',
            'preferences' => ['language' => 'en', 'timezone' => 'UTC']
        ],
        'metadata' => [
            'created_at' => now()->toISOString(),
            'version' => '1.0.0',
            'checksum' => md5('test')
        ]
    ];
    
    $snapshot = Snapshot::factory()->create(['state' => $complexState]);
    
    expect($snapshot->fresh()->state)
        ->toBeArray()
        ->toHaveKey('user')
        ->toHaveKey('settings')
        ->toHaveKey('metadata')
        ->user->toBeArray()->toHaveKeys(['id', 'name', 'email', 'roles'])
        ->settings->toBeArray()->toHaveKeys(['notifications', 'theme', 'preferences'])
        ->metadata->toBeArray()->toHaveKeys(['created_at', 'version', 'checksum']);
});

test('snapshot state maintains data integrity after save and retrieval', function () {
    $originalState = [
        'numeric_values' => [1, 2.5, 1000],
        'string_values' => ['hello', 'world', 'test'],
        'boolean_values' => [true, false, true],
        'null_values' => [null, 'not null', null],
        'nested_arrays' => [
            ['level1' => ['level2' => ['level3' => 'deep']]],
            ['simple' => 'value']
        ]
    ];
    
    $snapshot = Snapshot::factory()->create(['state' => $originalState]);
    $retrievedSnapshot = $snapshot->fresh();
    
    expect($retrievedSnapshot->state)->toBe($originalState);
});

test('snapshot aggregate version validation', function () {
    $snapshot = Snapshot::factory()->make(['aggregate_version' => 0]);
    
    expect(fn() => $snapshot->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('snapshot aggregate uuid validation', function () {
    $snapshot = Snapshot::factory()->make(['aggregate_uuid' => 'invalid-uuid']);
    
    expect(fn() => $snapshot->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('snapshot state cannot be null', function () {
    $snapshot = Snapshot::factory()->make(['state' => null]);
    
    expect(fn() => $snapshot->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('snapshot state must be array', function () {
    $snapshot = Snapshot::factory()->make(['state' => 'invalid-string']);
    
    expect(fn() => $snapshot->save())->toThrow(\Illuminate\Database\QueryException::class);
});