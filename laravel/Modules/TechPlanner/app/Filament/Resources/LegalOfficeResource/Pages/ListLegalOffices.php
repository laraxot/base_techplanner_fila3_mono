<?php

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalOffices extends XotBaseListRecords
{
    protected static string $resource = LegalOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
