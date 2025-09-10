<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\TeamResource;

class ViewTeam extends ViewRecord
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
