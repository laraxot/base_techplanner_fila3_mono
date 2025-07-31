<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

use Filament\Tables;
use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListLocations extends XotBaseListRecords
{
    protected static string $resource = LocationResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function getTableComumns(): array
=======
    public function getListTableColumns(): array
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
    public function getListTableColumns(): array
=======
    public function getTableComumns(): array
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
    public function getTableComumns(): array
>>>>>>> 6f0eea5 (.)
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('street'),
            Tables\Columns\TextColumn::make('city')
                ->searchable(),
            Tables\Columns\TextColumn::make('state')
                ->searchable(),
            Tables\Columns\TextColumn::make('zip'),
        ];
    }
}
