<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationResource\Pages;

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Modules\Notify\Filament\Resources\NotificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListNotifications extends XotBaseListRecords
{
    protected static string $resource = NotificationResource::class;

    public function getTableFilters(): array
    {
        return [
            Filter::make('is_read')
                ->query(fn (Builder $query): Builder => $query->whereNotNull('read_at')),
            Filter::make('is_unread')
                ->query(fn (Builder $query): Builder => $query->whereNull('read_at')),
            SelectFilter::make('type')
                ->multiple(),
        ];
    }
}
