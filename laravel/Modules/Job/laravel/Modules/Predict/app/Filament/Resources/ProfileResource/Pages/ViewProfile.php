<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\ProfileResource\Pages;

use Filament\Actions;
use Modules\Predict\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ViewProfile as UserViewProfile;

class ViewProfile extends UserViewProfile
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
