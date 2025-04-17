<?php

namespace Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;

class EditLegalRepresentative extends EditRecord
{
    protected static string $resource = LegalRepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
