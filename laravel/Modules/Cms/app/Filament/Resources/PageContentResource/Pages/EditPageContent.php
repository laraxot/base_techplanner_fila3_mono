<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use Filament\Actions;
use Modules\Lang\Filament\Resources\Pages\LangBaseEditRecord;
use Modules\Cms\Filament\Resources\PageContentResource;

class EditPageContent extends LangBaseEditRecord
{
    
    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
