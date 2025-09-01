<?php

declare(strict_types=1);

use Modules\Geo\Models\Region;

describe('Region Business Logic', function () {
    test('region extends base model', function () {
        expect(Region::class)->toBeSubclassOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('region has factory trait for testing', function () {
        $traits = class_uses(Region::class);

        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
    });

    test('region uses sushi trait for in-memory data', function () {
        $traits = class_uses(Region::class);

        expect($traits)->toHaveKey(\Sushi\Sushi::class);
    });

    test('region has correct key type configured', function () {
        $region = new Region;

        expect($region->getKeyType())->toBe('integer');
    });

    test('region has schema definition for geographic data', function () {
        $region = new Region;

        expect($region)->toHaveProperty('schema');
        expect($region->schema['id'])->toBe('integer');
        expect($region->schema['name'])->toBe('string');
    });

    test('region has factory class configured', function () {
        expect(Region::$factory)->toBe(\Modules\Geo\Database\Factories\RegionFactory::class);
    });

    test('region model can be instantiated without errors', function () {
        $region = new Region;

        expect($region)->toBeInstanceOf(Region::class);
        expect($region)->toBeInstanceOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('region can be queried by name', function () {
        $query = Region::whereName('Lombardia');

        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });

    test('region can be queried by id', function () {
        $query = Region::whereId(1);

        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });
});
