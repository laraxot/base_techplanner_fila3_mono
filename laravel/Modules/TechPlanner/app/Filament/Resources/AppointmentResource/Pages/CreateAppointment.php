<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;

class CreateAppointment extends XotBaseCreateRecord
{
    protected static string $resource = AppointmentResource::class;
}
