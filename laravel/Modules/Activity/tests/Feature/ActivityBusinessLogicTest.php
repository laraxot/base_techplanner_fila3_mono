<?php

declare(strict_types=1);

use Modules\Activity\Models\Activity;
use Illuminate\Support\Str;

describe('Activity Business Logic', function () {
    it('can create activity with basic information', function () {
        $activityData = [
            'log_name' => 'default',
            'description' => 'User logged in',
            'subject_type' => 'App\Models\User',
            'subject_id' => 123,
            'causer_type' => 'App\Models\User',
            'causer_id' => 123,
            'properties' => json_encode([
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0',
                'login_method' => 'email',
            ]),
            'event' => 'created',
            'batch_uuid' => Str::uuid()->toString(),
        ];

        $activity = Activity::create($activityData);

        expect($activity)
            ->toBeInstanceOf(Activity::class)
            ->and($activity->log_name)->toBe('default')
            ->and($activity->description)->toBe('User logged in')
            ->and($activity->subject_type)->toBe('App\Models\User')
            ->and($activity->subject_id)->toBe(123)
            ->and($activity->event)->toBe('created');
    });

    it('can track user authentication activities', function () {
        $loginActivity = Activity::create([
            'log_name' => 'auth',
            'description' => 'User logged in successfully',
            'subject_type' => 'App\Models\User',
            'subject_id' => 456,
            'causer_type' => 'App\Models\User',
            'causer_id' => 456,
            'properties' => json_encode([
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Chrome/91.0.4472.124',
                'login_time' => now()->toISOString(),
            ]),
            'event' => 'login',
        ]);

        $logoutActivity = Activity::create([
            'log_name' => 'auth',
            'description' => 'User logged out',
            'subject_type' => 'App\Models\User',
            'subject_id' => 456,
            'causer_type' => 'App\Models\User',
            'causer_id' => 456,
            'properties' => json_encode([
                'ip_address' => '192.168.1.100',
                'session_duration' => 3600,
                'logout_time' => now()->toISOString(),
            ]),
            'event' => 'logout',
        ]);

        expect($loginActivity->event)->toBe('login')
            ->and($logoutActivity->event)->toBe('logout')
            ->and($loginActivity->log_name)->toBe('auth')
            ->and($logoutActivity->log_name)->toBe('auth');
    });

    it('can track model crud activities', function () {
        $createActivity = Activity::create([
            'log_name' => 'models',
            'description' => 'User created',
            'subject_type' => 'App\Models\User',
            'subject_id' => 789,
            'causer_type' => 'App\Models\User',
            'causer_id' => 1,
            'properties' => json_encode([
                'old' => null,
                'attributes' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                ],
            ]),
            'event' => 'created',
        ]);

        $updateActivity = Activity::create([
            'log_name' => 'models',
            'description' => 'User updated',
            'subject_type' => 'App\Models\User',
            'subject_id' => 789,
            'causer_type' => 'App\Models\User',
            'causer_id' => 1,
            'properties' => json_encode([
                'old' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                ],
                'attributes' => [
                    'name' => 'John Smith',
                    'email' => 'john.smith@example.com',
                ],
            ]),
            'event' => 'updated',
        ]);

        expect($createActivity->event)->toBe('created')
            ->and($updateActivity->event)->toBe('updated')
            ->and($createActivity->subject_id)->toBe(789)
            ->and($updateActivity->subject_id)->toBe(789);
    });

    it('can use batch uuid for grouping activities', function () {
        $batchUuid = Str::uuid()->toString();

        $activity1 = Activity::create([
            'log_name' => 'batch',
            'description' => 'Batch operation started',
            'subject_type' => 'App\Models\Import',
            'subject_id' => 404,
            'causer_type' => 'App\Models\User',
            'causer_id' => 505,
            'properties' => json_encode(['step' => 'start']),
            'event' => 'batch_started',
            'batch_uuid' => $batchUuid,
        ]);

        $activity2 = Activity::create([
            'log_name' => 'batch',
            'description' => 'Batch operation completed',
            'subject_type' => 'App\Models\Import',
            'subject_id' => 404,
            'causer_type' => 'App\Models\User',
            'causer_id' => 505,
            'properties' => json_encode(['step' => 'complete', 'records_processed' => 1000]),
            'event' => 'batch_completed',
            'batch_uuid' => $batchUuid,
        ]);

        expect($activity1->batch_uuid)->toBe($batchUuid)
            ->and($activity2->batch_uuid)->toBe($batchUuid);

        $batchActivities = Activity::where('batch_uuid', $batchUuid)->get();
        expect($batchActivities)->toHaveCount(2);
    });

    it('can filter activities by log name', function () {
        Activity::create([
            'log_name' => 'auth',
            'description' => 'Login activity',
            'subject_type' => 'App\Models\User',
            'subject_id' => 606,
            'causer_type' => 'App\Models\User',
            'causer_id' => 606,
            'properties' => json_encode([]),
            'event' => 'login',
        ]);

        Activity::create([
            'log_name' => 'models',
            'description' => 'Model activity',
            'subject_type' => 'App\Models\User',
            'subject_id' => 606,
            'causer_type' => 'App\Models\User',
            'causer_id' => 606,
            'properties' => json_encode([]),
            'event' => 'created',
        ]);

        $authActivities = Activity::where('log_name', 'auth')->get();
        $modelActivities = Activity::where('log_name', 'models')->get();

        expect($authActivities)->toHaveCount(1)
            ->and($modelActivities)->toHaveCount(1)
            ->and($authActivities->first()->log_name)->toBe('auth')
            ->and($modelActivities->first()->log_name)->toBe('models');
    });

    it('can handle activity with complex properties', function () {
        $complexActivity = Activity::create([
            'log_name' => 'complex',
            'description' => 'Complex operation with nested data',
            'subject_type' => 'App\Models\Order',
            'subject_id' => 909,
            'causer_type' => 'App\Models\User',
            'causer_id' => 1010,
            'properties' => json_encode([
                'order_details' => [
                    'items' => [
                        ['id' => 1, 'name' => 'Product A', 'quantity' => 2, 'price' => 25.99],
                        ['id' => 2, 'name' => 'Product B', 'quantity' => 1, 'price' => 15.50],
                    ],
                    'total_amount' => 67.48,
                    'currency' => 'EUR',
                ],
                'customer_info' => [
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com',
                ],
            ]),
            'event' => 'order_placed',
        ]);

        expect($complexActivity->event)->toBe('order_placed')
            ->and($complexActivity->log_name)->toBe('complex');

        $properties = json_decode($complexActivity->properties, true);
        expect($properties['order_details']['total_amount'])->toBe(67.48)
            ->and($properties['customer_info']['name'])->toBe('Jane Smith');
    });
});
