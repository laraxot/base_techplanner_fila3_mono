<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\Rating\Models\RatingMorph;
use Modules\Xot\Filament\Resources\XotBaseResource;

class RatingMorphResource extends XotBaseResource
{
    protected static ?string $model = RatingMorph::class;

    public static function getFormSchema(): array
    {
        return [
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ratingable_type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ratingable_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
