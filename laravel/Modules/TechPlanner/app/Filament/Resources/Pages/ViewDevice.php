<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Actions;
use Modules\TechPlanner\Filament\Resources\DeviceResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewDevice extends XotBaseViewRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    /**
     * @return array<int|string,\Filament\Infolists\Components\Component>
     */
    protected function getInfolistSchema(): array
    {
        return [
            Section::make('Informazioni Base')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('name')
                                ->label('Nome')
                                ->searchable(),
                            TextEntry::make('serial_number')
                                ->label('Numero Seriale')
                                ->searchable(),
                            TextEntry::make('model')
                                ->label('Modello')
                                ->searchable(),
                            TextEntry::make('manufacturer')
                                ->label('Produttore')
                                ->searchable(),
                            TextEntry::make('type')
                                ->label('Tipo')
                                ->searchable(),
                            TextEntry::make('status')
                                ->label('Stato')
                                ->searchable(),
                        ]),
                ])
                ->collapsible(),

            Section::make('Dettagli Aggiuntivi')
                ->schema([
                    TextEntry::make('description')
                        ->label('Descrizione')
                        ->columnSpan(2),
                    TextEntry::make('purchase_date')
                        ->label('Data Acquisto')
                        ->date(),
                    TextEntry::make('warranty_expiry')
                        ->label('Scadenza Garanzia')
                        ->date(),
                    TextEntry::make('created_at')
                        ->label('Creato Il')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->label('Aggiornato Il')
                        ->dateTime(),
                ])
                ->collapsible(),
        ];
    }
}
