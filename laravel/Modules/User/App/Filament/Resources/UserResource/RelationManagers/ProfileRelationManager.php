<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Modules\User\Filament\Resources\ProfileResource;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class ProfileRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'profile';

    protected static ?string $recordTitleAttribute = 'first_name';

    protected static string $resource = ProfileResource::class;
}
