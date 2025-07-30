<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Resources\SnapshotResource\Pages;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Modules\Activity\Filament\Resources\SnapshotResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * @see SnapshotResource
 */
class ListSnapshots extends XotBaseListRecords
{
    protected static string $resource = SnapshotResource::class;

    /**
     * Get the list table columns.
     *
     * @return array<string, Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'aggregate_uuid' => TextColumn::make('aggregate_uuid')
                ->searchable(),
            'aggregate_version' => TextColumn::make('aggregate_version')
                ->sortable(),
            'state' => TextColumn::make('state')
                ->searchable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * @return array<Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('aggregate_type')
                ->options([
                    'user' => 'User',
                    'profile' => 'Profile',
                    'role' => 'Role',
                ])
                ->multiple(),
        ];
    }

    /**
     * @return array<Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }

    /**
     * @return array<Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }
}
