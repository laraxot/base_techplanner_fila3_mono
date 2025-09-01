<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\DeviceResource\Pages;

use Filament\Actions\DeleteAction;
<<<<<<< HEAD
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\DeviceResource;

class EditDevice extends EditRecord
=======
use Modules\User\Filament\Resources\DeviceResource;

class EditDevice extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
