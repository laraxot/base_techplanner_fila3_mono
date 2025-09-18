<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class BannerAndSlides
{
    public static function make(
        string $name = 'banner_and_slides',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                TextInput::make('title')
                    ->required(),
                Select::make('layout')

                    ->options([
                        'v1' => 'layout 1 (Bootstrap)',
                    ])
                    ->required(),
            ]);
    }
}
