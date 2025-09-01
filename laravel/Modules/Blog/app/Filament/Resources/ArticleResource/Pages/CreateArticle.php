<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;

class CreateArticle extends LangBaseCreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
