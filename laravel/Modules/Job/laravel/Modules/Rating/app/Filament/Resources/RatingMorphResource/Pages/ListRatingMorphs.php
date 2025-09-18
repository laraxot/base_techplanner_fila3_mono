<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Pages;

use Filament\Pages\Actions;
use Filament\Tables\Columns;
use Modules\Rating\Filament\Resources\RatingMorphResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRatingMorphs extends XotBaseListRecords
{
    protected static string $resource = RatingMorphResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getListTableColumns(): array
    {
        return [
            'id' => Columns\TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'rating' => Columns\TextColumn::make('rating')
                ->sortable()
                ->searchable(),
            'ratingable_type' => Columns\TextColumn::make('ratingable_type')
                ->label('Type')
                ->sortable(),
            'ratingable_id' => Columns\TextColumn::make('ratingable_id')
                ->label('ID')
                ->sortable(),
            'created_at' => Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ];
    }
}
