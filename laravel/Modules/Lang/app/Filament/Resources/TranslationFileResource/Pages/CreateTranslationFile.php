<?php

namespace Modules\Lang\Filament\Resources\TranslationFileResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;
use Modules\Lang\Filament\Resources\TranslationFileResource;

class CreateTranslationFile extends LangBaseCreateRecord
{
    protected static string $resource = TranslationFileResource::class;
}
