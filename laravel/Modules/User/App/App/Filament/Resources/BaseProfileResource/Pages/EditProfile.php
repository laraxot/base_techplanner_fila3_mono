<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\BaseProfileResource\Pages;

<<<<<<< HEAD
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Resources\BaseProfileResource;

class EditProfile extends EditRecord
=======
<<<<<<<< HEAD:app/Filament/Resources/BaseProfileResource/Pages/EditProfile.php
========
use Filament\Resources\Pages\EditRecord;
>>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8:app/App/Filament/Resources/BaseProfileResource/Pages/EditProfile.php
use Modules\User\Filament\Resources\BaseProfileResource;

class EditProfile extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = BaseProfileResource::class;
}
