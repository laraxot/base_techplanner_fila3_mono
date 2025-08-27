<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;

use Filament\Actions;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;

class EditPhoneCall extends XotBaseEditRecord
{
    protected static string $resource = PhoneCallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
