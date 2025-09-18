<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Resources\CategoryResource\Pages;
use Modules\Blog\Models\Category;
use Modules\UI\Filament\Forms\Components\IconPicker;
use Modules\Xot\Filament\Resources\XotBaseResource;

class CategoryResource extends XotBaseResource
{
    use Translatable;

    // protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Content';

    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }

    public static function getFormSchema(): array
    {
        return static::getFormFields();
    }

    public static function getFormFields(): array
    {
        return [
            Forms\Components\Grid::make()->columns(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpan(1)
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(static function (Forms\Set $set, Forms\Get $get, string $state): void {
                        if ($get('slug')) {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->columnSpan(1)
                    ->required(),

                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'title')
                    ->columnSpan(1)
                    ->nullable(),

                IconPicker::make('icon')
                    ->columnSpan(1)
                    ->nullable(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull()
                    ->disk('uploads')
                    ->directory('categories')
                    ->collection('image'),
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            // 'index' => Pages\ManageCategories::route('/'),
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
