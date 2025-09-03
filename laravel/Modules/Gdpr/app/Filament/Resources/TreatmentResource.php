<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources;

use Filament\Forms;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages;
use Modules\Gdpr\Models\Treatment;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TreatmentResource extends XotBaseResource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
