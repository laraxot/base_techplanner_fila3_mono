<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Clusters\Profile\Resources;

use Modules\Gdpr\Filament\Clusters\Profile as ProfileCluster;
use Modules\Gdpr\Filament\Clusters\Profile\Resources\ConsentResource\Pages;
use Modules\Gdpr\Models\Consent;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ConsentResource extends XotBaseResource
{
    protected static ?string $model = Consent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = ProfileCluster::class;

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
    public static function getRelations(): array
    {
        return [
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
