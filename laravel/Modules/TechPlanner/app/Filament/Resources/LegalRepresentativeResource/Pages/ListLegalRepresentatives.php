<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLegalRepresentatives extends XotBaseListRecords
{
    protected static string $resource = LegalRepresentativeResource::class;

    #[\Override]
    protected function getHeaderActions(): array
    {
        return [
            'create' => Actions\CreateAction::make(),
        ];
    }
}
