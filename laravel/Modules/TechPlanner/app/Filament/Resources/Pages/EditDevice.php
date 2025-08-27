<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\TechPlanner\Filament\Resources\DeviceResource;

class EditDevice extends XotBaseEditRecord
{
    protected static string $resource = DeviceResource::class;
}
