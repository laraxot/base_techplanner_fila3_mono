<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

use Filament\Tables;
use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLocations extends XotBaseListRecords
{
    protected static string $resource = LocationResource::class;

    public function getListTableColumns(): array
    {
        return [
            'name' => Tables\Columns\TextColumn::make('name')
                ->searchable(),
            'street' => Tables\Columns\TextColumn::make('street'),
            'city' => Tables\Columns\TextColumn::make('city')
                ->searchable(),
            'state' => Tables\Columns\TextColumn::make('state')
                ->searchable(),
            'zip' => Tables\Columns\TextColumn::make('zip'),
        ];
    }

    public function getTableColumns(): array
    {
        return $this->getListTableColumns();
    }
}
