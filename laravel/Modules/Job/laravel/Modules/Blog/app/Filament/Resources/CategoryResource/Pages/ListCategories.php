<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListCategories extends XotBaseListRecords
{
    use ListRecords\Concerns\Translatable;

    /**
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'icon' => Tables\Columns\IconColumn::make('icon')
                ->icon(fn ($state) => $state),
            'title' => Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),
            'parent' => Tables\Columns\TextColumn::make('parent.title')
                ->searchable()
                ->sortable(),
            // Tables\Columns\TextColumn::make('updated_at')
            //     ->sortable()
            //     ->dateTime(),
            'image' => SpatieMediaLibraryImageColumn::make('image')
                ->collection('category'),
        ];
    }

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->columns($this->getTableColumns())
    //         ->filters([
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //             Tables\Actions\DeleteAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\DeleteBulkAction::make(),
    //         ]);
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
