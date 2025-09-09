<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\MedicalDirectorResource\Pages;

use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
=======
use Modules\TechPlanner\Filament\Imports\MedicalDirectorImporter;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMedicalDirectors extends XotBaseListRecords
{
    protected static string $resource = MedicalDirectorResource::class;

    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'name' => TextColumn::make('name')
                ->sortable()
                ->searchable(),
            'email' => TextColumn::make('email')
                ->sortable()
                ->searchable(),
            'phone' => TextColumn::make('phone')
                ->sortable()
                ->searchable(),
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
            Tables\Filters\SelectFilter::make('created_at')
                ->options(fn () => MedicalDirectorResource::getModel()::selectRaw('DATE(created_at) as date')
                    ->distinct()
                    ->pluck('date', 'date')
                    ->toArray()),
        ];
    }

    protected function getHeaderActions(): array
    {
        /** @var array<string, \Filament\Actions\Action> $actions */
        $actions = [
            ...parent::getHeaderActions(),
            Actions\ImportAction::make('importMedicalDirector')
                ->importer(MedicalDirectorImporter::class),
        ];

        return $actions;
    }
}
