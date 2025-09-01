<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\ProfileResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\ProfileResource;

<<<<<<< HEAD
class EditProfile extends EditRecord
=======
class EditProfile extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = ProfileResource::class;
}
