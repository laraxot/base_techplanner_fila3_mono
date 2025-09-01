<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class NavigationBlock extends XotBaseBlock
{
    public static function getBlockSchema(): array
    {
        return [
            Repeater::make('items')
                ->label('Voci di menu')
                ->schema([
                    TextInput::make('label')
                        ->label('Etichetta')
                        ->required(),

                    TextInput::make('url')
                        ->label('URL')
                        ->required(),

                    Select::make('type')
                        ->label('Tipo')
                        ->options([
                            'link' => 'Link',
                            'button' => 'Pulsante',
                            'dropdown' => 'Menu a tendina',
                        ])
                        ->default('link')
                        ->reactive(),

                    Select::make('style')
                        ->label('Stile')
                        ->options([
                            'default' => 'Default',
                            'primary' => 'Primario',
                            'secondary' => 'Secondario',
                        ])
                        ->default('default')
                        ->visible(fn (Get $get) => $get('type') === 'button'),

                    Repeater::make('children')
                        ->label('Sottomenu')
                        ->schema([
                            TextInput::make('label')
                                ->label('Etichetta')
                                ->required(),

                            TextInput::make('url')
                                ->label('URL')
                                ->required(),

                            Select::make('type')
                                ->label('Tipo')
                                ->options([
                                    'link' => 'Link',
                                    'button' => 'Pulsante',
                                ])
                                ->default('link'),
                        ])
                        ->visible(fn (Get $get) => $get('type') === 'dropdown')
                        ->collapsible(),
                ])
                ->collapsible()
                ->reorderable(),

            Select::make('alignment')
                ->label('Allineamento')
                ->options([
                    'start' => 'Sinistra',
                    'center' => 'Centro',
                    'end' => 'Destra',
                ])
                ->default('start'),

            Select::make('orientation')
                ->label('Orientamento')
                ->options([
                    'horizontal' => 'Orizzontale',
                    'vertical' => 'Verticale',
                ])
                ->default('horizontal'),
        ];
    }

    public static function getBlockLabel(): string
    {
        return __('cms::blocks.navigation.label');
    }
}
