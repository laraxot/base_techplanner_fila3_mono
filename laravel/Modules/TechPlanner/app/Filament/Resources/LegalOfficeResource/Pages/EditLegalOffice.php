<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;

use Filament\Actions;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;

class EditLegalOffice extends XotBaseEditRecord
{
    protected static string $resource = LegalOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
