<?php

namespace Modules\TechPlanner\Filament\Resources\DeviceResource\Pages;

use Filament\Infolists\Components;
use Modules\TechPlanner\Filament\Resources\DeviceResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewDevice extends XotBaseViewRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getInfolistSchema(): array
    {
        return [
            Components\Section::make('Device Information')
                ->schema([
                    Components\TextEntry::make('name')
                        ->label('Name'),
                    Components\TextEntry::make('serial_number')
                        ->label('Serial Number'),
                    Components\TextEntry::make('model')
                        ->label('Model'),
                    Components\TextEntry::make('manufacturer')
                        ->label('Manufacturer'),
                ]),

            Components\Section::make('Dates')
                ->schema([
                    Components\TextEntry::make('purchase_date')
                        ->label('Purchase Date')
                        ->date(),
                    Components\TextEntry::make('warranty_expiration')
                        ->label('Warranty Expiration')
                        ->date(),
                ]),

            Components\Section::make('Additional Information')
                ->schema([
                    Components\TextEntry::make('notes')
                        ->label('Notes')
                        ->markdown(),
                ])
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
