<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Activity\Tests\Unit\Filament;

=======
>>>>>>> f371b59 (.)
use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Activity\Filament\Resources\StoredEventResource;
use Modules\Xot\Filament\Resources\XotBaseResource;

test('activity resources extend xot base resource', function () {
    expect(ActivityResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
<<<<<<< HEAD

    expect(SnapshotResource::class)
        ->toBeSubclassOf(XotBaseResource::class);

=======
    
    expect(SnapshotResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
    
>>>>>>> f371b59 (.)
    expect(StoredEventResource::class)
        ->toBeSubclassOf(XotBaseResource::class);
});

test('activity resource does not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    expect($reflection->hasMethod('getPages'))->toBeFalse()
        ->and($reflection->hasMethod('getRelations'))->toBeFalse()
        ->and($reflection->hasMethod('form'))->toBeFalse()
        ->and($reflection->hasMethod('table'))->toBeFalse();
});

test('activity resource implements required getFormSchema method', function () {
    $reflection = new ReflectionClass(ActivityResource::class);
<<<<<<< HEAD

    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();

=======
    
    expect($reflection->hasMethod('getFormSchema'))->toBeTrue();
    
>>>>>>> f371b59 (.)
    $method = $reflection->getMethod('getFormSchema');
    expect($method->isPublic())->toBeTrue()
        ->and($method->isStatic())->toBeTrue()
        ->and($method->getReturnType()?->getName())->toBe('array');
});

test('snapshot resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(SnapshotResource::class);
<<<<<<< HEAD

    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) &&
                          isset($pagesValue['create']) &&
                          isset($pagesValue['edit']);

        expect($isStandardPages)->toBeFalse()->with('SnapshotResource should not implement getPages() for standard pages');
    }

    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

=======
    
    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');
    
    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);
        
        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) && 
                          isset($pagesValue['create']) && 
                          isset($pagesValue['edit']);
        
        expect($isStandardPages)->toBeFalse()->with('SnapshotResource should not implement getPages() for standard pages');
    }
    
    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);
        
        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);
        
>>>>>>> f371b59 (.)
        expect($isEmptyRelations)->toBeFalse()->with('SnapshotResource should not implement getRelations() for empty relations');
    }
});

test('stored event resource should not implement unnecessary methods', function () {
    $reflection = new ReflectionClass(StoredEventResource::class);
<<<<<<< HEAD

    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');

    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);

        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) &&
                          isset($pagesValue['create']) &&
                          isset($pagesValue['edit']);

        expect($isStandardPages)->toBeFalse()->with('StoredEventResource should not implement getPages() for standard pages');
    }

    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);

        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);

=======
    
    // These methods should NOT be implemented (they return standard values)
    $hasUnnecessaryPages = $reflection->hasMethod('getPages');
    $hasUnnecessaryRelations = $reflection->hasMethod('getRelations');
    
    if ($hasUnnecessaryPages) {
        $pagesMethod = $reflection->getMethod('getPages');
        $pagesValue = $pagesMethod->invoke(null);
        
        // If it returns standard pages, it shouldn't be implemented
        $isStandardPages = isset($pagesValue['index']) && 
                          isset($pagesValue['create']) && 
                          isset($pagesValue['edit']);
        
        expect($isStandardPages)->toBeFalse()->with('StoredEventResource should not implement getPages() for standard pages');
    }
    
    if ($hasUnnecessaryRelations) {
        $relationsMethod = $reflection->getMethod('getRelations');
        $relationsValue = $relationsMethod->invoke(null);
        
        // If it returns empty array, it shouldn't be implemented
        $isEmptyRelations = empty($relationsValue);
        
>>>>>>> f371b59 (.)
        expect($isEmptyRelations)->toBeFalse()->with('StoredEventResource should not implement getRelations() for empty relations');
    }
});

test('activity resource has correct model configuration', function () {
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');
<<<<<<< HEAD

    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');

=======
    
    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');
    
>>>>>>> f371b59 (.)
    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
});

test('activity resource form schema returns array', function () {
    $schema = ActivityResource::getFormSchema();
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'properties',
=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'log_name',
        'description', 
        'subject_type',
        'subject_id',
        'properties'
>>>>>>> f371b59 (.)
    ]);
});

test('snapshot resource form schema returns array', function () {
    $schema = SnapshotResource::getFormSchema();
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> f371b59 (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'model_type',
        'model_id',
<<<<<<< HEAD
        'state',
=======
        'state'
>>>>>>> f371b59 (.)
    ]);
});

test('stored event resource form schema returns array', function () {
    $schema = StoredEventResource::getFormSchema();
<<<<<<< HEAD

    expect($schema)->toBeArray()->not->toBeEmpty();

=======
    
    expect($schema)->toBeArray()->not->toBeEmpty();
    
>>>>>>> f371b59 (.)
    // Verify it contains expected fields
    expect($schema)->toHaveKeys([
        'event_class',
        'event_properties',
<<<<<<< HEAD
        'aggregate_uuid',
=======
        'aggregate_uuid'
>>>>>>> f371b59 (.)
    ]);
});

test('resources use proper xot base resource functionality', function () {
    // Test that the base resource functionality works
    $activityPages = ActivityResource::getPages();
    $snapshotPages = SnapshotResource::getPages();
    $storedEventPages = StoredEventResource::getPages();
<<<<<<< HEAD

    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);

=======
    
    expect($activityPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($snapshotPages)->toHaveKeys(['index', 'create', 'edit']);
    expect($storedEventPages)->toHaveKeys(['index', 'create', 'edit']);
    
>>>>>>> f371b59 (.)
    // Test relation discovery
    $activityRelations = ActivityResource::getRelations();
    $snapshotRelations = SnapshotResource::getRelations();
    $storedEventRelations = StoredEventResource::getRelations();
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    expect($activityRelations)->toBeArray();
    expect($snapshotRelations)->toBeArray();
    expect($storedEventRelations)->toBeArray();
});

test('resources follow xot base resource naming conventions', function () {
    // Test that resource names follow conventions
    expect(class_basename(ActivityResource::class))
        ->toBe('ActivityResource');
<<<<<<< HEAD

    expect(class_basename(SnapshotResource::class))
        ->toBe('SnapshotResource');

    expect(class_basename(StoredEventResource::class))
        ->toBe('StoredEventResource');

    // Test that model names are correctly derived
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');

    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');

    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
});
=======
    
    expect(class_basename(SnapshotResource::class))
        ->toBe('SnapshotResource');
    
    expect(class_basename(StoredEventResource::class))
        ->toBe('StoredEventResource');
    
    // Test that model names are correctly derived
    expect(ActivityResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Activity');
    
    expect(SnapshotResource::getModel())
        ->toBe('Modules\\Activity\\Models\\Snapshot');
    
    expect(StoredEventResource::getModel())
        ->toBe('Modules\\Activity\\Models\\StoredEvent');
});
>>>>>>> f371b59 (.)
