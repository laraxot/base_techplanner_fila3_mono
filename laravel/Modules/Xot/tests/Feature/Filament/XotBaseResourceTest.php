<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Feature\Filament\XotBaseResourceTest;

namespace Modules\Xot\Tests\Feature\Filament;


        protected static ?int $navigationSort = 1;
    };
});

test('xot base resource extends filament resource', function () {
    expect($this->resource)->toBeInstanceOf(Resource::class);
});

test('xot base resource has navigation icon', function () {
    expect($this->resource::getNavigationIcon())->toBe('heroicon-o-rectangle-stack');
});

test('xot base resource has navigation group', function () {
    expect($this->resource::getNavigationGroup())->toBe('Test Group');
});

test('xot base resource has navigation sort', function () {
    expect($this->resource::getNavigationSort())->toBe(1);
});

test('xot base resource can be instantiated', function () {
    expect($this->resource)->toBeInstanceOf(XotBaseResource::class);
});
