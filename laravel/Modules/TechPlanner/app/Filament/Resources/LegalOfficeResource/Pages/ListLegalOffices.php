<?php

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;

class ListLegalOffices extends ListRecords
{
    protected static string $resource = LegalOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
