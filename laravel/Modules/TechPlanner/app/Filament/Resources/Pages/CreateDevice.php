<?php

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\TechPlanner\Filament\Resources\DeviceResource;

class CreateDevice extends CreateRecord
{
    protected static string $resource = DeviceResource::class;
}
