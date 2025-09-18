<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\PageRegistration;
use Modules\Media\Filament\Resources\MediaResource\Pages;
use Modules\Media\Models\Media;
use Modules\Xot\Filament\Resources\XotBaseResource;

class MediaResource extends XotBaseResource
{
    protected static null|string $model = Media::class;

    /**
     * @return array<string, \Filament\Forms\Components\Component>
     */
    #[\Override]
    public static function getFormSchema(): array
    {
        return [
            'file' => FileUpload::make('file')
                ->hint(static::trans('fields.file_hint'))
                ->storeFileNamesIn('original_file_name')
                ->visibility('private')
                ->required()
                ->columnSpanFull(),
            'attachment_type' => Radio::make('attachment_type'),
            'name' => TextInput::make('name')
                ->translateLabel()
                ->hint(static::trans('fields.name.hint'))
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }

    /**
     * @psalm-return array<never, never>
     */
    #[\Override]
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * @return PageRegistration[]
     *
     * @psalm-return array{index: PageRegistration, create: PageRegistration, edit: PageRegistration}
     */
    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
            'view' => Pages\ViewMedia::route('/{record}'),
            'convert' => Pages\ConvertMedia::route('/{record}/convert'),
        ];
    }
}
