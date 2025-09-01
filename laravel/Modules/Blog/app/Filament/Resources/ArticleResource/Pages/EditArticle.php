<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Checkbox;
use Modules\Blog\Actions\Article\TranslateContentAction;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Models\Article;
use Modules\Lang\Filament\Resources\Pages\LangBaseEditRecord;

class EditArticle extends LangBaseEditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('translate')
                ->label('Copia Blocchi nelle altre lingue')
                ->tooltip('translate')
                ->icon('heroicon-o-language')
                ->requiresConfirmation()
                ->modalDescription('Assicurati che la versione italiana sia stata settata e salvata')
                ->form([
                    Checkbox::make('content_blocks')->inline(),
                    Checkbox::make('sidebar_blocks')->inline(),
                    Checkbox::make('footer_blocks')->inline(),
                ])
                ->action(function (Article $record, ArticleResource $article_resource, array $data): void {
                    app(TranslateContentAction::class)->execute(
                        'article',
                        $record->id, $article_resource->getTranslatableLocales(),
                        $data,
                        Article::class
                    );
                }),
        ];
    }
}
