<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Geo\Filament\Resources\LocationResource;
use Webmozart\Assert\Assert;

class CreateLocation extends XotBaseCreateRecord
{
    use InteractsWithMaps;

    protected static string $resource = LocationResource::class;

    protected function getRedirectUrl(): string
    {
        Assert::string($url = $this->getResource()::getUrl('index'));

        return $url;
    }
}
