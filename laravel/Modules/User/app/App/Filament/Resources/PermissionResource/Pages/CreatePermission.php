<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\PermissionResource;

class CreatePermission extends CreateRecord
{
    // //
    protected static string $resource = PermissionResource::class;
}
