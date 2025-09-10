<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Tables\Columns;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

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
            'date' => Columns\TextColumn::make('date')->label('Date')->sortable(),
            'notes' => Columns\TextColumn::make('notes')->limit(50),
            /*
            'machines_count' => Columns\TextColumn::make('machines_count')
                ->label('Machines Checked')
                ->counts('machines'),
            */
        ];
    }


    public function canAttach(): bool
    {
        return false;
    }

    public function canCreate(): bool
    {
        return true;
    }
}
