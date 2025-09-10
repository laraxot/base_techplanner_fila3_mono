<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\TeamResource;

<<<<<<< HEAD
class CreateTeam extends CreateRecord
=======
class CreateTeam extends \Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    // //
    protected static string $resource = TeamResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['team_id'] = auth()->id();

        return $data;
    }
}
