<?php

namespace Modules\UI\Filament\Resources\CollectionLangResource\Pages;

use Filament\Tables\Columns;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Modules\UI\Filament\Resources\CollectionLangResource;

class ListCollections extends LangBaseListRecords
{
    protected static string $resource = CollectionLangResource::class;

    public function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->forceSearchCaseInsensitive()
                ->label((string) __('Collections Name'))
                ->searchable()
                ->sortable()
                ->toggleable(),
            Columns\TextColumn::make('values-list')
                ->badge()
                ->separator(',')
                ->label((string) __('Collections Values'))
                ->searchable(['values'])
                ->toggleable(),
        ];
    }
}
