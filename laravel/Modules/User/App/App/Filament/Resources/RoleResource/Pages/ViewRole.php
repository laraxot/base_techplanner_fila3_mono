<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\RoleResource;

<<<<<<< HEAD
class ViewRole extends ViewRecord
=======
class ViewRole extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
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
