<?php

namespace Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;

use Filament\Actions;
use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListAppointments extends XotBaseListRecords
{
    protected static string $resource = AppointmentResource::class;

    public function getTableColumns(): array
    {
        return [
            'client.name' => Tables\Columns\TextColumn::make('client.name')
                ->searchable()
                ->sortable(),
            'date' => Tables\Columns\TextColumn::make('date')
                ->date()
                ->sortable(),
            'time' => Tables\Columns\TextColumn::make('time')
                ->time()
                ->sortable(),
            'status' => Tables\Columns\TextColumn::make('status')
                ->searchable()
                ->sortable(),
            'notes' => Tables\Columns\TextColumn::make('notes')
                ->searchable()
                ->wrap(),
            'created_at' => Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
