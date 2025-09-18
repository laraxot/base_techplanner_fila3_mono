<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Modules\Blog\Filament\Blocks\Chart;
use Modules\Rating\Filament\Blocks\Rating;
use Modules\UI\Filament\Blocks\Image;
use Modules\UI\Filament\Blocks\ImagesGallery;
use Modules\UI\Filament\Blocks\ImageSpatie;
use Modules\UI\Filament\Blocks\Paragraph;
use Modules\UI\Filament\Blocks\Title;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Forms;

class ArticleContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                Title::make('title')->schema([
                    Hidden::make('context')->default($context),
                ]),
                Paragraph::make('paragraph')->schema([
                    Hidden::make('context')->default($context),
                ]),
                // Image::make('image')->schema([
                //     Forms\Components\Hidden::make('context')->default($context),
                // ]),
                ImageSpatie::make('image')->schema([
                    Hidden::make('context')->default($context),
                ]),
                ImagesGallery::make('gallery')->schema([
                    Hidden::make('context')->default($context),
                ]),
                Rating::make('rating')->schema([
                    Hidden::make('context')->default($context),
                ]),
                Chart::make('chart')->schema([
                    Hidden::make('context')->default($context),
                ]),
            ])
            ->collapsible();
    }
}
