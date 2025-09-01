<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\BaseProfileResource\Pages;

use Modules\User\Filament\Resources\BaseProfileResource;

class EditProfile extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
{
    protected static string $resource = BaseProfileResource::class;
}
