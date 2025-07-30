<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class AppointmentsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'appointments';

    protected static string $resource = AppointmentResource::class;

    /**
     * Get table columns for the relation manager.
     *
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
            'date' => Tables\Columns\TextColumn::make('date')->label('Date')->sortable(),
            'notes' => Tables\Columns\TextColumn::make('notes')->limit(50),
            'machines_count' => Tables\Columns\TextColumn::make('machines_count')
                ->label('Machines Checked')
                ->counts('machines'),
        ];
    }

    /*
    public function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('viewMachines')
                ->label('View Machines')
                ->url(fn ($record) => route('filament.resources.appointments.show', $record)),
        ];
    }
    */
}
