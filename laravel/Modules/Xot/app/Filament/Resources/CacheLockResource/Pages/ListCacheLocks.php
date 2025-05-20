<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\CacheLockResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Xot\Filament\Resources\CacheLockResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;




<<<<<<< HEAD
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManagers\XotBaseRelationManager;
=======
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;
>>>>>>> 9d6070e (.)





class ListCacheLocks extends XotBaseListRecords
{
    protected static string $resource = CacheLockResource::class;

<<<<<<< HEAD
    public function getTableColumns(): array
=======
    public function getListTableColumns(): array
>>>>>>> 9d6070e (.)
    {
        return [
            'key' => TextColumn::make('key')
                ->searchable()
                ->sortable()
                ->wrap(),
            'owner' => TextColumn::make('owner')
                ->searchable()
                ->sortable()
                ->wrap(),
            'expiration' => TextColumn::make('expiration')
                ->numeric()
                ->sortable(),
        ];
    }
}
