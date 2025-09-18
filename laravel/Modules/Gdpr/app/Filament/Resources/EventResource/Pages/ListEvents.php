<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources\EventResource\Pages;

use Filament\Tables;
use Modules\Gdpr\Filament\Resources\EventResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListEvents extends XotBaseListRecords
{
    protected static string $resource = EventResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
    public function getTableColumns(): array
=======
    public function getListTableColumns(): array
>>>>>>> cb0fd7e5 (.)
=======
    public function getListTableColumns(): array
>>>>>>> 6f6abe7c (.)
=======
    public function getListTableColumns(): array
>>>>>>> ee97d89f (.)
=======
    public function getTableColumns(): array
>>>>>>> faeca70 (.)
    {
        return [
            'id' => Tables\Columns\TextColumn::make('id')
                ->numeric()
                ->sortable()
                ->searchable(),
            'treatment_id' => Tables\Columns\TextColumn::make('treatment_id')
                ->numeric()
                ->sortable()
                ->searchable(),
            'consent_id' => Tables\Columns\TextColumn::make('consent.id')
                ->numeric()
                ->sortable()
                ->searchable(),
            'subject_id' => Tables\Columns\TextColumn::make('subject_id')
                ->numeric()
                ->sortable()
                ->searchable(),
            'ip' => Tables\Columns\TextColumn::make('ip')
                ->searchable(),
            'action' => Tables\Columns\TextColumn::make('action')
                ->searchable(),
            'created_at' => Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            'updated_at' => Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
