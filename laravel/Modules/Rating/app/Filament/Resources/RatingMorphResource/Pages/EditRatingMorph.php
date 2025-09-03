<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Pages;

use Modules\Rating\Filament\Resources\RatingMorphResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditRatingMorph extends XotBaseEditRecord
{
    protected static string $resource = RatingMorphResource::class;
}
