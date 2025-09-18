<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\BaseProfileResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\BaseProfileResource;

class EditProfile extends EditRecord
{
    protected static string $resource = BaseProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
