<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use Modules\Cms\Filament\Resources\PageContentResource;
use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;

class CreatePageContent extends LangBaseCreateRecord
{
    protected static string $resource = PageContentResource::class;
}
