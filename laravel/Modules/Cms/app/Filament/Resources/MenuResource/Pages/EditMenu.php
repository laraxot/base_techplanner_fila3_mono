<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\MenuResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Cms\Filament\Resources\MenuResource;

class EditMenu extends XotBaseEditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
