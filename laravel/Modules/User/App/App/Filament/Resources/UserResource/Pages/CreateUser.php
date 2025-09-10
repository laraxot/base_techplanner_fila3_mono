<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\UserResource;

<<<<<<< HEAD
class CreateUser extends CreateRecord
=======
class CreateUser extends \Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    // //
    protected static string $resource = UserResource::class;
}
