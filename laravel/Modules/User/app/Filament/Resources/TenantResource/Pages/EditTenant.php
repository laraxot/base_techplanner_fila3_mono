<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\Pages;

use Filament\Actions;
use Modules\User\Filament\Resources\TenantResource;

<<<<<<< HEAD



use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;





=======
>>>>>>> 9831a351 (.)
class EditTenant extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
