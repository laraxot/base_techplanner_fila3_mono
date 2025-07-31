<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\DeviceVerificationResource\Pages;

use Filament\Actions;
use Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListDeviceVerifications extends XotBaseListRecords
{
    protected static string $resource = DeviceVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->model(config('filament-export.model'))
                ->columnMap([
                    'device_id' => 'ID Dispositivo',
                    'data_verifica' => 'Data Verifica',
                    'esito' => 'Esito',
                    'note' => 'Note',
                    'prossima_verifica' => 'Data Prossima Verifica',
                ])
                ->dateFormat('Y-m-d')
                ->notifications(),
            Actions\ExportAction::make()
                ->model(config('filament-export.model'))
                ->csvDelimiter(',')
                ->dateFormat('Y-m-d')
                ->columnMap([
                    'device_id' => 'ID Dispositivo',
                    'data_verifica' => 'Data Verifica',
                    'esito' => 'Esito',
                    'note' => 'Note',
                    'prossima_verifica' => 'Data Prossima Verifica',
                ]),
        ];
    }

    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('device.model')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('verification_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('next_verification_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('result')
                ->searchable(),
            Tables\Columns\TextColumn::make('verification_type')
                ->searchable(),
        ];
    }
}
