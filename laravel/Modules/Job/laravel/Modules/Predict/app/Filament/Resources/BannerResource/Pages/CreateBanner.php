<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\BannerResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Predict\Filament\Resources\BannerResource;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;
}
