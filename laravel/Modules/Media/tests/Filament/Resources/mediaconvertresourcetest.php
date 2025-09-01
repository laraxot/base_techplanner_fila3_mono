<?php

declare(strict_types=1);

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Modules\Media\Filament\Resources\MediaConvertResource;

uses(Tests\TestCase::class);

test('get form schema returns expected components', function (): void {
    $schema = MediaConvertResource::getFormSchema();

    expect($schema)->toBeArray();
    expect($schema)->not->toBeEmpty();

    $componentClasses = array_map(fn ($c) => get_class($c), $schema);

    expect($componentClasses)->toContain(Radio::class);
    expect($componentClasses)->toContain(TextInput::class);
});
