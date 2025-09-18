<?php

declare(strict_types=1);


namespace Modules\Lang\Filament\Resources;

use Filament\Actions;
use Filament\Forms\Components;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Config;
use Modules\Lang\Filament\Actions\LocaleSwitcherRefresh;
use Modules\Lang\Filament\Resources\TranslationFileResource\Pages;
use Modules\Lang\Filament\Resources\TranslationFileResource\RelationManagers;
use Modules\Lang\Models\TranslationFile;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TranslationFileResource extends XotBaseResource
{
    protected static null|string $model = TranslationFile::class;

    public static function getDefaultTranslatableLocale(): string
    {
        return Config::string('app.locale', 'it');
    }

    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }

    #[\Override]
    public static function getFormSchema(): array
    {
        return [];

        /*
         * return [
         * Components\TextInput::make('key')
         * ->required()
         * ->maxLength(255)
         * ->disabled()
         * ->label('Chiave File'),
         *
         * Components\TextInput::make('name')
         * ->required()
         * ->maxLength(255)
         * ->disabled()
         * ->label('Nome File'),
         *
         * Components\TextInput::make('path')
         * ->required()
         * ->maxLength(255)
         * ->disabled()
         * ->label('Percorso File'),
         *
         * Components\KeyValue::make('content')
         * ->label('Traduzioni')
         * ->keyLabel('Chiave')
         * ->valueLabel('Valore')
         * ->addActionLabel('Aggiungi Traduzione')
         * ->deleteActionLabel('Rimuovi')
         * ->reorderable()
         * ->columnSpanFull(),
         *
         * ];
         */
    }

    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTranslationFiles::route('/'),
            'create' => Pages\CreateTranslationFile::route('/create'),
            //'view' => Pages\ViewTranslationFile::route('/{record}'),
            'edit' => Pages\EditTranslationFile::route('/{record}/edit'),
        ];
    }
}
