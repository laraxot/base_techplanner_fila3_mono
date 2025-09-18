<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Blocks\XotBaseBlock;

final class InfoBlock extends XotBaseBlock
{
    #[\Override]
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')->required()->label(__('cms::blocks.info.fields.title')),
            RichEditor::make('description')->required()->label(__('cms::blocks.info.fields.description')),
            FileUpload::make('logo')
                ->image()
                ->required()
                ->label(__('cms::blocks.info.fields.logo')),
            TextInput::make('copyright')->required()->label(__('cms::blocks.info.fields.copyright')),
        ];
    }

    public static function getBlockLabel(): string
    {
        return __('cms::blocks.info.label');
    }
}
