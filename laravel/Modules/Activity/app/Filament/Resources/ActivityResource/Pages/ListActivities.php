<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources\ActivityResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Activity\Filament\Resources\ActivityResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
<<<<<<< HEAD
use Filament\Tables\Columns\Tables;
=======
>>>>>>> 6727cc6 (.)

/**
 * @see ActivityResource
 */
class ListActivities extends XotBaseListRecords
{
    protected static string $resource = ActivityResource::class;

<<<<<<< HEAD
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->sortable()
                ->searchable(),
            TextColumn::make('description')
                ->searchable()
                ->limit(50),
            TextColumn::make('subject_type')
                ->searchable(),
            TextColumn::make('subject_id')
                ->searchable(),
            TextColumn::make('causer_type')
                ->searchable(),
            TextColumn::make('causer_id')
                ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
=======
    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->label('ID'),

            'description' => TextColumn::make('description')
                ->searchable()
                ->label('Description'),

            'subject_type' => TextColumn::make('subject_type')
                ->searchable()
                ->label('Subject Type'),

            'subject_id' => TextColumn::make('subject_id')
                ->sortable()
                ->label('Subject ID'),

            'causer_type' => TextColumn::make('causer_type')
                ->searchable()
                ->label('Causer Type'),

            'causer_id' => TextColumn::make('causer_id')
                ->sortable()
                ->label('Causer ID'),

            'created_at' => TextColumn::make('created_at')
                ->sortable()
                ->dateTime()
                ->label('Created At'),

>>>>>>> 6727cc6 (.)
        ];
    }
}
