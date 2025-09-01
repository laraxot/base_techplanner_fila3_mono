<?php

declare(strict_types=1);

namespace Modules\Activity\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Modules\Activity\Models\Snapshot;
use Tests\TestCase;

class SnapshotBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_snapshot_with_basic_information(): void
    {
        $snapshotData = [
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode([
                'name' => 'Test Aggregate',
                'status' => 'active',
                'created_at' => now()->toISOString(),
            ]),
        ];

        $snapshot = Snapshot::create($snapshotData);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'aggregate_uuid' => $snapshotData['aggregate_uuid'],
            'aggregate_version' => 1,
        ]);

        expect($snapshotData['aggregate_uuid'], $snapshot->aggregate_uuid);
        expect(1, $snapshot->aggregate_version);
        $this->assertIsArray($snapshot->state);
        expect('Test Aggregate', $snapshot->state['name']);
        expect('active', $snapshot->state['status']);
    }

    /** @test */
    public function it_can_create_snapshot_with_complex_state(): void
    {
        $complexState = [
            'user_info' => [
                'id' => 123,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'profile' => [
                    'avatar' => '/avatars/john.jpg',
                    'bio' => 'Software Developer',
                    'preferences' => [
                        'theme' => 'dark',
                        'language' => 'en',
                        'notifications' => true,
                    ],
                ],
            ],
            'account_status' => [
                'is_active' => true,
                'last_login' => now()->subHours(2)->toISOString(),
                'login_count' => 45,
                'subscription' => [
                    'plan' => 'premium',
                    'expires_at' => now()->addYear()->toISOString(),
                    'features' => ['api_access', 'priority_support', 'advanced_analytics'],
                ],
            ],
            'metadata' => [
                'created_by' => 'system',
                'source' => 'web_registration',
                'tags' => ['verified', 'premium_user'],
            ],
        ];

        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 5,
            'state' => json_encode($complexState),
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'aggregate_version' => 5,
        ]);

        expect(5, $snapshot->aggregate_version);
        $this->assertIsArray($snapshot->state);
        expect('John Doe', $snapshot->state['user_info']['name']);
        expect('premium', $snapshot->state['account_status']['subscription']['plan']);
        expect($snapshot->state['account_status']['is_active']);
        $this->assertContains('verified', $snapshot->state['metadata']['tags']);
    }

    /** @test */
    public function it_can_manage_snapshot_versioning(): void
    {
        $aggregateUuid = Str::uuid()->toString();

        // Crea snapshot con versioni progressive
        $snapshot1 = Snapshot::create([
            'aggregate_uuid' => $aggregateUuid,
            'aggregate_version' => 1,
            'state' => json_encode(['version' => 1, 'data' => 'Initial state']),
        ]);

        $snapshot2 = Snapshot::create([
            'aggregate_uuid' => $aggregateUuid,
            'aggregate_version' => 2,
            'state' => json_encode(['version' => 2, 'data' => 'Updated state']),
        ]);

        $snapshot3 = Snapshot::create([
            'aggregate_uuid' => $aggregateUuid,
            'aggregate_version' => 3,
            'state' => json_encode(['version' => 3, 'data' => 'Final state']),
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot1->id,
            'aggregate_version' => 1,
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot2->id,
            'aggregate_version' => 2,
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot3->id,
            'aggregate_version' => 3,
        ]);

        // Verifica che tutti gli snapshot abbiano lo stesso UUID ma versioni diverse
        expect($aggregateUuid, $snapshot1->aggregate_uuid);
        expect($aggregateUuid, $snapshot2->aggregate_uuid);
        expect($aggregateUuid, $snapshot3->aggregate_uuid);

        expect(1, $snapshot1->aggregate_version);
        expect(2, $snapshot2->aggregate_version);
        expect(3, $snapshot3->aggregate_version);
    }

    /** @test */
    public function it_can_query_snapshots_by_aggregate_uuid(): void
    {
        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();

        // Crea snapshot per il primo aggregate
        Snapshot::create([
            'aggregate_uuid' => $uuid1,
            'aggregate_version' => 1,
            'state' => json_encode(['aggregate' => 'first', 'version' => 1]),
        ]);

        Snapshot::create([
            'aggregate_uuid' => $uuid1,
            'aggregate_version' => 2,
            'state' => json_encode(['aggregate' => 'first', 'version' => 2]),
        ]);

        // Crea snapshot per il secondo aggregate
        Snapshot::create([
            'aggregate_uuid' => $uuid2,
            'aggregate_version' => 1,
            'state' => json_encode(['aggregate' => 'second', 'version' => 1]),
        ]);

        // Query per UUID specifico
        $snapshots1 = Snapshot::where('aggregate_uuid', $uuid1)->get();
        $snapshots2 = Snapshot::where('aggregate_uuid', $uuid2)->get();

        expect(2, $snapshots1);
        expect(1, $snapshots2);

        expect($uuid1, $snapshots1->first()->aggregate_uuid);
        expect($uuid2, $snapshots2->first()->aggregate_uuid);
    }

    /** @test */
    public function it_can_query_snapshots_by_version(): void
    {
        $uuid = Str::uuid()->toString();

        Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 1,
            'state' => json_encode(['version' => 1]),
        ]);

        Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 5,
            'state' => json_encode(['version' => 5]),
        ]);

        Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 10,
            'state' => json_encode(['version' => 10]),
        ]);

        // Query per versione specifica
        $version1Snapshot = Snapshot::where('aggregate_uuid', $uuid)
            ->where('aggregate_version', 1)
            ->first();

        $version5Snapshot = Snapshot::where('aggregate_uuid', $uuid)
            ->where('aggregate_version', 5)
            ->first();

        $version10Snapshot = Snapshot::where('aggregate_uuid', $uuid)
            ->where('aggregate_version', 10)
            ->first();

        expect($version1Snapshot);
        expect($version5Snapshot);
        expect($version10Snapshot);

        expect(1, $version1Snapshot->aggregate_version);
        expect(5, $version5Snapshot->aggregate_version);
        expect(10, $version10Snapshot->aggregate_version);
    }

    /** @test */
    public function it_can_handle_snapshot_with_empty_state(): void
    {
        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode([]),
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'aggregate_version' => 1,
        ]);

        $this->assertIsArray($snapshot->state);
        $this->assertEmpty($snapshot->state);
    }

    /** @test */
    public function it_can_handle_snapshot_with_null_state(): void
    {
        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => null,
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'aggregate_version' => 1,
        ]);

        expect($snapshot->state);
    }

    /** @test */
    public function it_can_restore_state_from_snapshot(): void
    {
        $originalState = [
            'user_id' => 456,
            'settings' => [
                'theme' => 'light',
                'language' => 'it',
                'notifications' => false,
            ],
            'preferences' => [
                'timezone' => 'Europe/Rome',
                'date_format' => 'd/m/Y',
                'currency' => 'EUR',
            ],
        ];

        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 7,
            'state' => json_encode($originalState),
        ]);

        // Simula il ripristino dello stato
        $restoredState = $snapshot->state;

        expect($originalState, $restoredState);
        expect(456, $restoredState['user_id']);
        expect('light', $restoredState['settings']['theme']);
        expect('Europe/Rome', $restoredState['preferences']['timezone']);
        expect('EUR', $restoredState['preferences']['currency']);
    }

    /** @test */
    public function it_can_compare_snapshot_versions(): void
    {
        $uuid = Str::uuid()->toString();

        $snapshot1 = Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 1,
            'state' => json_encode(['value' => 100, 'status' => 'initial']),
        ]);

        $snapshot2 = Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 2,
            'state' => json_encode(['value' => 200, 'status' => 'updated']),
        ]);

        $snapshot3 = Snapshot::create([
            'aggregate_uuid' => $uuid,
            'aggregate_version' => 3,
            'state' => json_encode(['value' => 300, 'status' => 'final']),
        ]);

        // Verifica che le versioni siano progressive
        $this->assertLessThan($snapshot2->aggregate_version, $snapshot1->aggregate_version);
        $this->assertLessThan($snapshot3->aggregate_version, $snapshot2->aggregate_version);

        // Verifica che i valori cambino tra le versioni
        expect(100, $snapshot1->state['value']);
        expect(200, $snapshot2->state['value']);
        expect(300, $snapshot3->state['value']);

        expect('initial', $snapshot1->state['status']);
        expect('updated', $snapshot2->state['status']);
        expect('final', $snapshot3->state['status']);
    }

    /** @test */
    public function it_can_handle_snapshot_with_timestamps(): void
    {
        $now = now();

        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode(['created_at' => $now->toISOString()]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'created_at' => $now->toDateTimeString(),
            'updated_at' => $now->toDateTimeString(),
        ]);

        expect($now->timestamp, $snapshot->created_at->timestamp);
        expect($now->timestamp, $snapshot->updated_at->timestamp);
    }

    /** @test */
    public function it_can_query_snapshots_by_date_range(): void
    {
        $yesterday = now()->subDay();
        $today = now();
        $tomorrow = now()->addDay();

        Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode(['date' => 'yesterday']),
            'created_at' => $yesterday,
        ]);

        Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode(['date' => 'today']),
            'created_at' => $today,
        ]);

        Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode(['date' => 'tomorrow']),
            'created_at' => $tomorrow,
        ]);

        $todaySnapshots = Snapshot::whereDate('created_at', today())->get();
        expect(1, $todaySnapshots);
        expect('today', $todaySnapshots->first()->state['date']);

        $recentSnapshots = Snapshot::where('created_at', '>=', $yesterday)->get();
        expect(2, $recentSnapshots);
    }

    /** @test */
    public function it_can_handle_snapshot_with_metadata(): void
    {
        $metadata = [
            'source' => 'user_action',
            'user_id' => 789,
            'action' => 'profile_update',
            'timestamp' => now()->toISOString(),
            'ip_address' => '192.168.1.100',
            'user_agent' => 'Mozilla/5.0',
            'session_id' => Str::random(40),
        ];

        $snapshot = Snapshot::create([
            'aggregate_uuid' => Str::uuid()->toString(),
            'aggregate_version' => 1,
            'state' => json_encode([
                'profile' => [
                    'name' => 'Alice Johnson',
                    'email' => 'alice@example.com',
                ],
                'metadata' => $metadata,
            ]),
        ]);

        $this->assertDatabaseHas('snapshots', [
            'id' => $snapshot->id,
            'aggregate_version' => 1,
        ]);

        expect('Alice Johnson', $snapshot->state['profile']['name']);
        expect('alice@example.com', $snapshot->state['profile']['email']);
        expect('user_action', $snapshot->state['metadata']['source']);
        expect(789, $snapshot->state['metadata']['user_id']);
        expect('profile_update', $snapshot->state['metadata']['action']);
    }
}
