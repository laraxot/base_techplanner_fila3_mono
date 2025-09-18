<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Modules\Gdpr\Filament\Resources\ConsentResource\Pages;
use Modules\Gdpr\Models\Consent;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ConsentResource extends XotBaseResource
{
    protected static ?string $model = Consent::class;

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
            'treatment_id' => Forms\Components\Select::make('treatment_id')
                ->relationship('treatment', 'name')
                ->required(),
            'subject_id' => Forms\Components\TextInput::make('subject_id')
                ->required()
                ->maxLength(191),
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
            Tables\Columns\TextColumn::make('id')

                ->searchable(),
            Tables\Columns\TextColumn::make('treatment.name')
                ->searchable(),
            Tables\Columns\TextColumn::make('subject_id')
                ->searchable(),
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
            'index' => Pages\ListConsents::route('/'),
            'create' => Pages\CreateConsent::route('/create'),
            'edit' => Pages\EditConsent::route('/{record}/edit'),
        ];
    }
}
