<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\RoleResource;

class ViewRole extends ViewRecord
{
    // //
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
