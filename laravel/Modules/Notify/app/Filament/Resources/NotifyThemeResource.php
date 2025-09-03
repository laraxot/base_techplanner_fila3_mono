<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Modules\Notify\Models\NotifyTheme;
use Modules\Xot\Filament\Resources\XotBaseResource;

class NotifyThemeResource extends XotBaseResource
{
    protected static ?string $model = NotifyTheme::class;

    public static function getFormSchema(): array
    {
        return [
            Select::make('lang'),
            Select::make('type'),
            Select::make('post_type'),
            TextInput::make('post_id'),
            TextInput::make('subject'),
            TextInput::make('from'),
            TextInput::make('from_email'),
            SpatieMediaLibraryFileUpload::make('logo_src')
                ->enableOpen()
                ->enableDownload()
                ->columnSpanFull()
                ->disk('uploads')
                ->directory('photos')
                ->preserveFilenames(),
            TextInput::make('logo_width'),
            TextInput::make('logo_height'),
            Select::make('theme')
                ->default('empty'),
            Textarea::make('body')
                ->columnSpanFull(),
            RichEditor::make('body_html')
                ->columnSpanFull(),
        ];
    }
}
