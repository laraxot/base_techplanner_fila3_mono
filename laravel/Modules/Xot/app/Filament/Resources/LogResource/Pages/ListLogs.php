<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\LogResource\Pages;

use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Modules\Xot\Filament\Resources\LogResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

/**
 * @see LogResource
 */
class ListLogs extends XotBaseListRecords
{
    protected static string $resource = LogResource::class;

    #[\Override]
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->sortable()->label('ID'),
            'message' => TextColumn::make('message')
                ->searchable()
                ->wrap()
                ->label('Message'),
            'level' => TextColumn::make('level')
                ->searchable()
                ->sortable()
                ->label('Level'),
            'level_name' => TextColumn::make('level_name')
                ->searchable()
                ->sortable()
                ->label('Level Name'),
            'context' => TextColumn::make('context')
                ->searchable()
                ->wrap()
                ->label('Context'),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->label('Created At'),
        ];
    }

    #[\Override]
    public function getTableFilters(): array
    {
        return [
            'level_name' => Tables\Filters\SelectFilter::make('level_name')->options([
                'emergency' => 'Emergency',
                'alert' => 'Alert',
                'critical' => 'Critical',
                'error' => 'Error',
                'warning' => 'Warning',
                'notice' => 'Notice',
                'info' => 'Info',
                'debug' => 'Debug',
            ]),
        ];
    }

    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    #[\Override]
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
     * @return array<string, Tables\Actions\BulkAction>
     */
    #[\Override]
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }
}
