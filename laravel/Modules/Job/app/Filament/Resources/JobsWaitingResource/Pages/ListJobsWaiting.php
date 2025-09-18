<?php

declare(strict_types=1);

/**
 * ---.
 */

namespace Modules\Job\Filament\Resources\JobsWaitingResource\Pages;

use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Modules\Job\Filament\Resources\JobsWaitingResource;
use Modules\Job\Filament\Resources\JobsWaitingResource\Widgets\JobsWaitingOverview;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListJobsWaiting extends XotBaseListRecords
{
    public static string $resource = JobsWaitingResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
    
=======
=======
>>>>>>> 2e199498 (.)
    public function getHeaderActions(): array
    {
        return [];
    }
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)

    public function getHeaderWidgets(): array
    {
        return [
            JobsWaitingOverview::class,
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
   

    public function getTableColumns(): array
    {
        /** @var array<string, \Filament\Tables\Columns\Column> */
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),
            'queue' => TextColumn::make('queue')
                ->searchable()
                ->sortable(),
            'display_name' => TextColumn::make('display_name')
                ->searchable()
                ->sortable()
                ->wrap(),
            'status' => TextColumn::make('status')
=======
=======
>>>>>>> 2e199498 (.)
    public function getTitle(): string
    {
        return __('jobs::translations.title');
    }

    public function getTableActions(): array
    {
        return [];
    }

    public function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make(),
        ];
    }

    public function getGridTableColumns(): array
    {
        return [];
    }

    public function getListTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->searchable()
                ->sortable(),
            TextColumn::make('queue')
                ->searchable()
                ->sortable(),
            TextColumn::make('display_name')
                ->searchable()
                ->sortable()
                ->wrap(),
            TextColumn::make('status')
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
                ->badge()
                ->sortable()
                ->color(
                    static fn (string $state): string => match ($state) {
                        'running' => 'primary',
                        'waiting' => 'success',
                        'failed' => 'danger',
                        default => 'secondary',
                    }
                ),
<<<<<<< HEAD
<<<<<<< HEAD
            'attempts' => TextColumn::make('attempts')
                ->numeric()
                ->sortable(),
            'available_at' => TextColumn::make('available_at')
                ->dateTime()
                ->sortable(),
            'reserved_at' => TextColumn::make('reserved_at')
                ->dateTime()
                ->sortable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
=======
=======
>>>>>>> 2e199498 (.)
            TextColumn::make('attempts')
                ->numeric()
                ->sortable(),
            TextColumn::make('available_at')
                ->dateTime()
                ->sortable(),
            TextColumn::make('reserved_at')
                ->dateTime()
                ->sortable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            TextColumn::make('updated_at')
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
                ->dateTime()
                ->sortable(),
        ];
    }
}
