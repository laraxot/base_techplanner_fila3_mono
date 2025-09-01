<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationResource\Pages;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Modules\Notify\Filament\Resources\NotificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListNotifications extends XotBaseListRecords
{
    protected static string $resource = NotificationResource::class;

    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->numeric()
                ->sortable(),
            'type' => TextColumn::make('type')
                ->searchable()
                ->sortable(),
            'notifiable' => TextColumn::make('notifiable.name')
                ->searchable()
                ->sortable(),
            'data' => TextColumn::make('data')
                ->searchable(),
            'read_at' => TextColumn::make('read_at')
                ->dateTime()
                ->sortable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    public function getTableFilters(): array
    {
        return [
            'read' => Tables\Filters\Filter::make('is_read')
                ->query(fn ($query) => $query->where('read_at', '!=', null))
                ->label('Read'),
            'unread' => Tables\Filters\Filter::make('is_unread')
                ->query(fn ($query) => $query->whereNull('read_at'))
                ->label('Unread'),
            'type' => Tables\Filters\SelectFilter::make('type')
                ->options([
                    'info' => 'Info',
                    'success' => 'Success',
                    'warning' => 'Warning',
                    'error' => 'Error',
                ])
                ->multiple(),
        ];
    }
}
