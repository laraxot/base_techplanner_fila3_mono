<?php

declare(strict_types=1);

use Modules\Activity\Models\Snapshot;

describe('Snapshot Business Logic', function () {
    test('snapshot has correct connection configured', function () {
        $snapshot = new Snapshot();
        
        expect($snapshot->getConnectionName())->toBe('activity');
    });

    test('snapshot has expected fillable fields for event sourcing', function () {
        $snapshot = new Snapshot();
        $expectedFillable = [
            'id',
            'aggregate_uuid',
            'aggregate_version',
            'state',
            'created_at',
            'updated_at'
        ];
        
        expect($snapshot->getFillable())->toEqual($expectedFillable);
    });

    test('snapshot extends base snapshot', function () {
        expect(is_subclass_of(Snapshot::class, \Modules\Activity\Models\BaseSnapshot::class))->toBeTrue();
    });

    test('snapshot has factory trait for testing', function () {
        $traits = class_uses(Snapshot::class);
        
        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
    });

    test('snapshot has uuid scope method', function () {
        expect(method_exists(Snapshot::class, 'scopeUuid'))->toBeTrue();
    });

    test('snapshot can query by aggregate version', function () {
        expect(method_exists(Snapshot::class, 'whereAggregateVersion'))->toBeTrue();
    });
});