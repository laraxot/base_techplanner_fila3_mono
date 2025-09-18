<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Cms\Models\Page;

class PageCard
{
    public static function make(
        string $name = 'page_card',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Select::make('page_id')

                    ->options(Page::orderBy('title')->pluck('title', 'id')),

                TextInput::make('text'),
            ])

            ->columns('form' === $context ? 2 : 1);
    }
}
