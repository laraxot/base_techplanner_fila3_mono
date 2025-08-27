<?php

namespace Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalRepresentatives extends XotBaseListRecords
{
    protected static string $resource = LegalRepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
