<?php

namespace Modules\TechPlanner\Filament\Resources\DeviceVerificationResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditDeviceVerification extends XotBaseEditRecord
{
    protected static string $resource = DeviceVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
