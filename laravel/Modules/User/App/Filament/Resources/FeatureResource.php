<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Modules\User\Filament\Resources\FeatureResource\Pages;
use Modules\User\Models\Feature;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * @property Feature $record
 *                           -------
 */
class FeatureResource extends XotBaseResource
{
    protected static ?string $model = Feature::class;

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->placeholder(static::trans('fields.name.placeholder'))
                ->helperText(static::trans('fields.name.helper_text')),

            TextInput::make('scope')
                ->required()
                ->maxLength(255)
                ->placeholder(static::trans('fields.scope.placeholder'))
                ->helperText(static::trans('fields.scope.helper_text')),

            TextInput::make('value')
                ->required()
                ->maxLength(255)
                ->placeholder(static::trans('fields.value.placeholder'))
                ->helperText(static::trans('fields.value.helper_text')),
        ];
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
