<?php

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\TechPlanner\Filament\Resources\DeviceResource;

class EditDevice extends EditRecord
{
    protected static string $resource = DeviceResource::class;
}
