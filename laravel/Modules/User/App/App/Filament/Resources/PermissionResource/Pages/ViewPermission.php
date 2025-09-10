<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\PermissionResource;

<<<<<<< HEAD
class ViewPermission extends ViewRecord
=======
class ViewPermission extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    // //
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
