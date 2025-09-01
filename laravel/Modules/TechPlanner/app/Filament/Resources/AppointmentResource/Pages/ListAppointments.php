<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * Page per la lista degli appuntamenti.
 * 
 * Estende XotBaseListRecords seguendo le regole Laraxot.
 */
class ListAppointments extends XotBaseListRecords
{
    protected static string $resource = \Modules\TechPlanner\Filament\Resources\AppointmentResource::class;
}
