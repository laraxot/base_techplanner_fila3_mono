<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\TextWidgetResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Predict\Filament\Resources\TextWidgetResource;

class CreateTextWidget extends CreateRecord
{
    protected static string $resource = TextWidgetResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
