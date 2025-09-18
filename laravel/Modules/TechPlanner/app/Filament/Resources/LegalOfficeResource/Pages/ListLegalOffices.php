<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalOffices extends XotBaseListRecords
{
    protected static string $resource = LegalOfficeResource::class;

    #[\Override]
    protected function getHeaderActions(): array
    {
        return [
            'create' => Actions\CreateAction::make(),
        ];
    }
}
