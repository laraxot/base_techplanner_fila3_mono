<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Predict\Filament\Resources\ProfileResource\Pages;
use Modules\Predict\Filament\Resources\ProfileResource\RelationManagers;
use Modules\Predict\Models\Profile;
use Modules\User\Filament\Resources\BaseProfileResource;

class ProfileResource extends BaseProfileResource
{
    use Translatable;

    protected static ?string $model = Profile::class;

    public static function getRelations(): array
    {
        return [
            RelationManagers\RatingMorphsRelationManager::class,
        ];
    }

    public static function getFormSchema(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
            'view' => Pages\ViewProfile::route('/{record}'),
            // 'getcredits' => Pages\GetCreditProfile::route('/{record}/getcredits'),
        ];
    }
}
