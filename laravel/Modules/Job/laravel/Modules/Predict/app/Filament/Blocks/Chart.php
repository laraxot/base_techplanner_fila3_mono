<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
// use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;
use Modules\UI\Filament\Forms\Components\RadioImage;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;

class Chart
{
    public static function make(
        // string $name = 'ratings_statistics_graph',
        string $name = 'chart', // nome e' lo snake della classe
        string $context = 'form',
    ): Block {
        // $view = 'blog::components.blocks.chart.v1';
        // $views = app(GetViewsSiblingsAndSelfAction::class)->execute($view);

        $options = app(GetViewBlocksOptionsByTypeAction::class)
            ->execute('chart', true);

        return Block::make($name)
            ->schema([
                // TextInput::make('text')
                //     ->required(),

                // Select::make('chart_type')
                //     // ->options([
                //     //     'line' => 'Line Chart',
                //     //     // 'h3' => 'h3',
                //     //     // 'h4' => 'h4',
                //     // ])
                //     ->options($options)
                //     ->columnSpanFull(),
                // // ->afterStateHydrated(staic fn ($state, $set) => $state || $set('level', 'h2')),

                RadioImage::make('view')
                    ->options($options),
            ])
            // ->columns('form' === $context ? 2 : 1);
            ->columns(1);
    }
}
