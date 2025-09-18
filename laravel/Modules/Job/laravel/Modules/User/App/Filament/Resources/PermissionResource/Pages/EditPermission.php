<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\PermissionResource;

class EditPermission extends EditRecord
{
    // //
    protected static string $resource = PermissionResource::class;
}
