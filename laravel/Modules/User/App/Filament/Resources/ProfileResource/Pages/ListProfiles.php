<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\ProfileResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\User\Filament\Resources\ProfileResource;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;
}
