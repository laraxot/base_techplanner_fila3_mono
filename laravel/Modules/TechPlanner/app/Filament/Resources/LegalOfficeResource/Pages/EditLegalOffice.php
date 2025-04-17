<?php

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;

class EditLegalOffice extends EditRecord
{
    protected static string $resource = LegalOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
