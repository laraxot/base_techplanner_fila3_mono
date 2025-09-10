<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Modules\User\Filament\Resources\TeamResource;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class TeamsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string $resource = TeamResource::class;
}
