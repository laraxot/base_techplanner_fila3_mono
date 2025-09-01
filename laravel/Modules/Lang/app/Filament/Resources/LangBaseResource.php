<?php

declare(strict_types=1);

namespace Modules\Lang\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Facades\Config;
use Modules\Xot\Filament\Resources\XotBaseResource;

abstract class LangBaseResource extends XotBaseResource
{
    use Translatable;

    public static function getDefaultTranslatableLocale(): string
    {
        return Config::string('app.locale', 'it');
    }

    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }
}
