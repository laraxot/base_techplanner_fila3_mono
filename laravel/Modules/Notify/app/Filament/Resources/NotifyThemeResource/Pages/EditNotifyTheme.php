<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotifyThemeResource\Pages;

use Modules\Notify\Filament\Resources\NotifyThemeResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditNotifyTheme extends XotBaseEditRecord
{
    protected static string $resource = NotifyThemeResource::class;
}
