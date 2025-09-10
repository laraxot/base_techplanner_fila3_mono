<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\FeatureResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Modules\User\Filament\Resources\FeatureResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListFeatures extends XotBaseListRecords
{
    protected static string $resource = FeatureResource::class;

    /**
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->wrap(),
            'scope' => TextColumn::make('scope')
                ->searchable()
                ->sortable(),
            'value' => TextColumn::make('value')
                ->searchable()
                ->wrap(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * Undocumented function.
     *
     * @return array<\Filament\Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
        ];
    }

    /**
     * Undocumented function.
     *
     * @return array<\Filament\Tables\Actions\Action|\Filament\Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            ViewAction::make()
                ->label(''),
            EditAction::make()
                ->label(''),
            DeleteAction::make()
                ->label('')
                ->requiresConfirmation(),
        ];
    }

    /**
     * @return array<\Filament\Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            \Filament\Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
