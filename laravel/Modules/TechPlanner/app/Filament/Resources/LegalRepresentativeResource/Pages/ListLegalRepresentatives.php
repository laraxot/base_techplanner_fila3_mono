<?php

namespace Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;

class ListLegalRepresentatives extends ListRecords
{
    protected static string $resource = LegalRepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
