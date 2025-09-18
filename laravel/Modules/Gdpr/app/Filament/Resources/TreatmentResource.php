<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages;
use Modules\Gdpr\Models\Treatment;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TreatmentResource extends XotBaseResource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public static function getFormSchema(): array
    {
        return [
            'active' => Forms\Components\Toggle::make('active')
                ->required(),
            'required' => Forms\Components\Toggle::make('required')
                ->required(),
            'name' => Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(191),
            'description' => Forms\Components\Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            'documentVersion' => Forms\Components\TextInput::make('documentVersion')
                ->maxLength(191)
                ->default(null),
            'documentUrl' => Forms\Components\TextInput::make('documentUrl')
                ->maxLength(191)
                ->default(null),
            'weight' => Forms\Components\TextInput::make('weight')
                ->required()
                ->numeric(),
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
            // Tables\Columns\TextColumn::make('id')
            //
            //     ->searchable(),
            Tables\Columns\IconColumn::make('active')
                ->boolean(),
            Tables\Columns\IconColumn::make('required')
                ->boolean(),
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('documentVersion')
                ->searchable(),
            Tables\Columns\TextColumn::make('documentUrl')
                ->searchable(),
            Tables\Columns\TextColumn::make('weight')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
