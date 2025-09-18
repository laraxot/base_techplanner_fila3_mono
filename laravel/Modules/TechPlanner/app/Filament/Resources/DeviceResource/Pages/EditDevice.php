<?php

declare(strict_types=1);


namespace Modules\TechPlanner\Filament\Resources\DeviceResource\Pages;

use Modules\TechPlanner\Filament\Resources\DeviceResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditDevice extends XotBaseEditRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
