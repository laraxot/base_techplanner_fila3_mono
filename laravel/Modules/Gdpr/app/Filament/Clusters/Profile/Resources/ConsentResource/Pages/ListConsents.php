<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Clusters\Profile\Resources\ConsentResource\Pages;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Modules\Gdpr\Filament\Clusters\Profile\Resources\ConsentResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListConsents extends XotBaseListRecords
{
    protected static string $resource = ConsentResource::class;

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
            'id' => TextColumn::make('id')
                ->numeric()
                ->sortable(),
            'treatment_id' => TextColumn::make('treatment.name')
                ->sortable(),
            'subject_id' => TextColumn::make('subject.name')
                ->sortable(),
            'is_accepted' => IconColumn::make('is_accepted')
                ->boolean(),
            'data_creazione' => TextColumn::make('data_creazione')
                ->dateTime()
                ->sortable(),
            'data_ultima_modifica' => TextColumn::make('data_ultima_modifica')
                ->dateTime()
                ->sortable(),
        ];
    }
}
