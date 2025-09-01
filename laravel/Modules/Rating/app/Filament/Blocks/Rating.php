<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Illuminate\Support\Facades\App;
use Modules\Rating\Datas\RatingData;
use Modules\Rating\Enums\SupportedLocale;
use Modules\UI\Filament\Forms\Components\RadioImage;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;
use Webmozart\Assert\Assert;

class Rating extends Block
{
    public const BLOCK_TYPE = 'rating';

    /**
     * Create a new rating block.
     */
    public static function create(): Block
    {
        // Ensure we're passing a string to make()
        Assert::stringNotEmpty(static::BLOCK_TYPE, 'Block type must be a non-empty string');
        return parent::make(static::BLOCK_TYPE)
            ->schema([
                TextInput::make('title')
                    ->label('Titolo')
                    ->required(),

                TextInput::make('description')
                    ->label('Descrizione'),

                Toggle::make('disabled')
                    ->label('Disabilitato')
                    ->default(false),
            ])
            ->label(function (): string {
                $locale = App::getLocale();
                $supportedLocale = SupportedLocale::fromString($locale);

                return sprintf('Rating (%s)', $supportedLocale->getLabel());
            });
    }

    /**
     * Create rating data from form data.
     *
     * @param array<string,mixed> $data
     */
    public static function createFromFormData(array $data): RatingData
    {
        return RatingData::fromArray($data);
    }

    /**
     * Create a new rating block with advanced options.
     *
     * @param array<string,mixed> $options
     */
    public static function createAdvanced(
        string $name = self::BLOCK_TYPE,
        string $context = 'form',
        ?array $options = null,
    ): Block {
        // Ensure we're passing a string to execute()
        Assert::stringNotEmpty(static::BLOCK_TYPE, 'Block type must be a non-empty string');
        $blockOptions = $options ?? app(GetViewBlocksOptionsByTypeAction::class)
            ->execute(static::BLOCK_TYPE, true);

        return Block::make($name)
            ->schema([
                RadioImage::make('view')
                    ->options(is_array($blockOptions) ? array_map(fn($value) => is_scalar($value) ? (string)$value : '', $blockOptions) : []),

                Repeater::make('ratings')
                    ->visible(fn (Get $get): bool => $get('locale') === App::getLocale())
                    ->relationship()
                    ->schema([
                        TextInput::make('id')->disabled(),
                        TextInput::make('title')->required(),
                        ColorPicker::make('color'),
                        SpatieMediaLibraryFileUpload::make('rating')
                            ->collection('rating'),
                    ])
                    ->reorderableWithButtons()
                    ->reorderableWithDragAndDrop(true)
                    ->columnSpanFull()
                    ->columns(4)
                    ->live(),
            ])
            ->columns(1);
    }
}
