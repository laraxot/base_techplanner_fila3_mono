<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;

/**
 * Page per la creazione di un nuovo appuntamento.
 * 
 * Estende XotBaseCreateRecord seguendo le regole Laraxot.
 */
class CreateAppointment extends XotBaseCreateRecord
{
    protected static string $resource = AppointmentResource::class;
}
