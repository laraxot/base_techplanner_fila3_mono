<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\DeviceResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\User\Filament\Resources\DeviceResource;

<<<<<<< HEAD



use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;





=======
>>>>>>> 9831a351 (.)
class EditDevice extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
