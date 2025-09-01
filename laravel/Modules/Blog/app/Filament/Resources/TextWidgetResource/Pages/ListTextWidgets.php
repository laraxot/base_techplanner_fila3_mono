<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Pages\Actions;
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListTextWidgets extends XotBaseListRecords
{
    
    public function getTableColumns(): array
    {
        return [
            'id' => \Filament\Tables\Columns\TextColumn::make('id')->sortable(),
            'key' => \Filament\Tables\Columns\TextColumn::make('key')->searchable(),
            'title' => \Filament\Tables\Columns\TextColumn::make('title')->limit(40),
            'active' => \Filament\Tables\Columns\IconColumn::make('active')->boolean(),
            'created_at' => \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ];
    }
    // protected static string $resource = TextWidgetResource::class;

   
}
