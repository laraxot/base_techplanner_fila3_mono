<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\SocialProviderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\SocialProviderResource;

<<<<<<< HEAD
class ViewSocialProvider extends ViewRecord
=======
class ViewSocialProvider extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = SocialProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
