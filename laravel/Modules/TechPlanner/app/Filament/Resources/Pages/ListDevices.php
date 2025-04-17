<?php

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\DeviceResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListDevices extends XotBaseListRecords
{
    protected static string $resource = DeviceResource::class;

    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('serial_number')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('model')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('manufacturer')
                ->searchable()
                ->sortable(),
        ];
    }
}
