<?php

declare(strict_types=1);

use Modules\Activity\Models\StoredEvent;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

test('stored event has correct fillable attributes', function () {
    $storedEvent = new StoredEvent();
    
    $expectedFillable = [
        'id',
        'aggregate_uuid',
        'aggregate_version',
        'event_version',
        'event_class',
        'event_properties',
        'meta_data',
        'created_at',
        'updated_by',
        'created_by',
    ];
    
    expect($storedEvent->getFillable())->toBe($expectedFillable);
});

test('stored event uses correct connection', function () {
    $storedEvent = new StoredEvent();
    
    expect($storedEvent->getConnectionName())->toBe('activity');
});

test('stored event uses correct table', function () {
    $storedEvent = new StoredEvent();
    
    expect($storedEvent->getTable())->toBe('stored_events');
});

test('stored event event properties are cast to array', function () {
    $eventProperties = ['amount' => 100, 'description' => 'Test event', 'metadata' => ['ip' => '127.0.0.1']];
    $storedEvent = StoredEvent::factory()->create(['event_properties' => $eventProperties]);
    
    expect($storedEvent->event_properties)
        ->toBeArray()
        ->toHaveKey('amount', 100)
        ->toHaveKey('description', 'Test event')
        ->toHaveKey('metadata', ['ip' => '127.0.0.1']);
});

test('stored event meta data is schemaless attributes', function () {
    $metaData = ['user_agent' => 'Test Browser', 'ip_address' => '192.168.1.1'];
    $storedEvent = StoredEvent::factory()->create(['meta_data' => $metaData]);
    
    expect($storedEvent->meta_data)
        ->toBeInstanceOf(Spatie\SchemalessAttributes\SchemalessAttributes::class)
        ->user_agent->toBe('Test Browser')
        ->ip_address->toBe('192.168.1.1');
});

test('stored event can scope by aggregate uuid', function () {
    $uuid1 = \Illuminate\Support\Str::uuid();
    $uuid2 = \Illuminate\Support\Str::uuid();
    
    $event1 = StoredEvent::factory()->create(['aggregate_uuid' => $uuid1]);
    $event2 = StoredEvent::factory()->create(['aggregate_uuid' => $uuid2]);
    
    $scopedEvents = StoredEvent::whereAggregateUuid($uuid1)->get();
    
    expect($scopedEvents)
        ->toHaveCount(1)
        ->first()->id->toBe($event1->id);
});

test('stored event can scope by event class', function () {
    $class1 = 'App\\Events\\UserCreated';
    $class2 = 'App\\Events\\UserUpdated';
    
    $event1 = StoredEvent::factory()->create(['event_class' => $class1]);
    $event2 = StoredEvent::factory()->create(['event_class' => $class2]);
    
    $scopedEvents = StoredEvent::whereEventClass($class1)->get();
    
    expect($scopedEvents)
        ->toHaveCount(1)
        ->first()->id->toBe($event1->id);
});

test('stored event can scope by aggregate version', function () {
    $event1 = StoredEvent::factory()->create(['aggregate_version' => 1]);
    $event2 = StoredEvent::factory()->create(['aggregate_version' => 2]);
    
    $scopedEvents = StoredEvent::whereAggregateVersion(1)->get();
    
    expect($scopedEvents)
        ->toHaveCount(1)
        ->first()->id->toBe($event1->id);
});

test('stored event can scope after version', function () {
    $event1 = StoredEvent::factory()->create(['aggregate_version' => 1]);
    $event2 = StoredEvent::factory()->create(['aggregate_version' => 2]);
    $event3 = StoredEvent::factory()->create(['aggregate_version' => 3]);
    
    $scopedEvents = StoredEvent::afterVersion(1)->get();
    
    expect($scopedEvents)
        ->toHaveCount(2)
        ->pluck('id')->toContain($event2->id, $event3->id);
});

test('stored event can get event instance', function () {
    $mockEvent = new class() extends ShouldBeStored {
        public function __construct(public string $name = 'Test Event') {}
    };
    
    $storedEvent = StoredEvent::factory()->create([
        'event_class' => get_class($mockEvent),
        'event_properties' => ['name' => 'Test Event']
    ]);
    
    $eventInstance = $storedEvent->event;
    
    expect($eventInstance)
        ->toBeInstanceOf(ShouldBeStored::class)
        ->name->toBe('Test Event');
});

test('stored event factory creates valid instances', function () {
    $storedEvent = StoredEvent::factory()->make();
    
    expect($storedEvent)
        ->event_class->toBeString()->not->toBeEmpty()
        ->event_version->toBeInt()->toBeGreaterThanOrEqual(1)
        ->event_properties->toBeArray();
});

test('stored event can handle complex event properties', function () {
    $complexProperties = [
        'user' => [
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'profile' => ['avatar' => 'test.jpg', 'bio' => 'Test bio']
        ],
        'changes' => [
            'old' => ['status' => 'pending', 'balance' => 0],
            'new' => ['status' => 'completed', 'balance' => 100]
        ],
        'metadata' => [
            'ip' => '127.0.0.1',
            'user_agent' => 'Test Browser/1.0',
            'timestamp' => now()->toISOString()
        ]
    ];
    
    $storedEvent = StoredEvent::factory()->create(['event_properties' => $complexProperties]);
    
    expect($storedEvent->fresh()->event_properties)
        ->toBeArray()
        ->toHaveKey('user')
        ->toHaveKey('changes')
        ->toHaveKey('metadata')
        ->user->toBeArray()->toHaveKeys(['id', 'name', 'email', 'profile'])
        ->changes->toBeArray()->toHaveKeys(['old', 'new'])
        ->metadata->toBeArray()->toHaveKeys(['ip', 'user_agent', 'timestamp']);
});

test('stored event meta data supports schemaless operations', function () {
    $storedEvent = StoredEvent::factory()->create(['meta_data' => []]);
    
    $storedEvent->meta_data->user_id = 123;
    $storedEvent->meta_data->session_id = 'abc123';
    $storedEvent->save();
    
    $freshEvent = $storedEvent->fresh();
    
    expect($freshEvent->meta_data)
        ->user_id->toBe(123)
        ->session_id->toBe('abc123');
});

test('stored event aggregate uuid validation', function () {
    $storedEvent = StoredEvent::factory()->make(['aggregate_uuid' => 'invalid-uuid']);
    
    expect(fn() => $storedEvent->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('stored event event class cannot be null', function () {
    $storedEvent = StoredEvent::factory()->make(['event_class' => null]);
    
    expect(fn() => $storedEvent->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('stored event event properties must be array', function () {
    $storedEvent = StoredEvent::factory()->make(['event_properties' => 'invalid-string']);
    
    expect(fn() => $storedEvent->save())->toThrow(\Illuminate\Database\QueryException::class);
});