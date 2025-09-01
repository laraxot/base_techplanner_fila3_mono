<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Pages\Actions\ViewAction;
<<<<<<< HEAD
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\TeamResource;

class EditTeam extends EditRecord
=======
use Modules\User\Filament\Resources\TeamResource;

class EditTeam extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    // //
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
