<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\ProfileResource\Pages;

use Modules\Predict\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\CreateProfile as UserCreateProfile;

class CreateProfile extends UserCreateProfile
{
    protected static string $resource = ProfileResource::class;
}
