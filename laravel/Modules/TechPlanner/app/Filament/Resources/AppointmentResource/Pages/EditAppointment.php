<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;

use Filament\Actions;
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

/**
 * Page per la modifica di un appuntamento.
 * 
 * Estende XotBaseEditRecord seguendo le regole Laraxot.
 */
class EditAppointment extends XotBaseEditRecord
{
    protected static string $resource = \Modules\TechPlanner\Filament\Resources\AppointmentResource::class;
}
