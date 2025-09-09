<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\Pages;

use Filament\Pages\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\TechPlanner\Filament\Resources\DeviceResource;

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
                                ->label('Nome'),
                            TextEntry::make('serial_number')
                                ->label('Numero Seriale'),
                            TextEntry::make('model')
                                ->label('Modello'),
                            TextEntry::make('manufacturer')
                                ->label('Produttore'),
                            TextEntry::make('type')
                                ->label('Tipo'),
                            TextEntry::make('status')
                                ->label('Stato'),
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
