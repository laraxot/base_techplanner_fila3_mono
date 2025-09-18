<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Rating\Filament\Resources\RatingMorphResource;

class CreateRatingMorph extends CreateRecord
{
    protected static string $resource = RatingMorphResource::class;
}
