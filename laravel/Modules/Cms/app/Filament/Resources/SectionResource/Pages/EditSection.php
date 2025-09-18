<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\SectionResource\Pages;

use Modules\Cms\Filament\Resources\SectionResource;
use Modules\Lang\Filament\Resources\Pages\LangBaseEditRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditSection extends LangBaseEditRecord
{
    protected static string $resource = SectionResource::class;
}
