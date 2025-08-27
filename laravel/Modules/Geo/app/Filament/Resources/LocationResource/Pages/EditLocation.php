<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Filament\Actions;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Geo\Filament\Resources\LocationResource;
use Webmozart\Assert\Assert;

class EditLocation extends XotBaseEditRecord
{
    use InteractsWithMaps;

    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        Assert::string($url = $this->getResource()::getUrl('index'));

        return $url;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //            LocationResource\Widgets\LocationMapTableWidget::class,
        ];
    }
}
