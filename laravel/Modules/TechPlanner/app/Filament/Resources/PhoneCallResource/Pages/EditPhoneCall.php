<?php

namespace Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;

class EditPhoneCall extends EditRecord
{
    protected static string $resource = PhoneCallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
