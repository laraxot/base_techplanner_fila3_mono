<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources;

use Filament\Forms;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Predict\Filament\Resources\PredictResource\Pages;
use Modules\Predict\Filament\Resources\PredictResource\RelationManagers;
use Modules\Predict\Models\Predict;

class PredictResource extends ArticleResource
{
    protected static ?string $model = Predict::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getFormSchema(): array
    {
        $fields = [
            Forms\Components\TextInput::make('stocks_count')

            ->required()
            ->numeric()
            ->inputMode('decimal'),
            Forms\Components\TextInput::make('stocks_value')
                ->required()
                ->numeric()
                ->inputMode('decimal'),
            Forms\Components\DateTimePicker::make('closed_at')
                ->columnSpan(1)
                ->helperText('Determina fino a quando è possibile scommettere')
                ->required(),
            Forms\Components\DateTimePicker::make('rewarded_at')
                ->nullable()
                ->columnSpan(1),
            ...parent::getFormSchema(),
        ];

        return $fields;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RatingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPredicts::route('/'),
            'create' => Pages\CreatePredict::route('/create'),
            'edit' => Pages\EditPredict::route('/{record}/edit'),
            'view' => Pages\ViewPredict::route('/{record}'),
        ];
    }
}
