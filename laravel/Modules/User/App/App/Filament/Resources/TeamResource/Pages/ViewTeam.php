<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\TeamResource;

<<<<<<< HEAD
class ViewTeam extends ViewRecord
=======
class ViewTeam extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    // //
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
