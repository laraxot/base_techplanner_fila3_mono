<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class DropdownMenu
{
    public static function make(
        string $name = 'dropdown_menu',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Repeater::make('menu')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Select::make('type')

                            ->options([
                                'categories' => 'Categorie',
                            ])
                            ->required(),
                        Select::make('layout')

                            ->options([
                                'v1' => 'layout 1 (Bootstrap)',
                            ])
                            ->required(),
                    ])->columnSpanFull(),
            ]);
    }
}
