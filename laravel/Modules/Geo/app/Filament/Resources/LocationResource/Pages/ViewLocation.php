<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

use Filament\Pages\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\KeyValueEntry;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Geo\Filament\Resources\LocationResource;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;

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
                                ->size(TextEntry\TextEntrySize::Large),
                            TextEntry::make('formatted_address')
                                ->label('Indirizzo Formattato')
                                ->size(TextEntry\TextEntrySize::Large),
                        ]),
                    TextEntry::make('description')
                        ->label('Descrizione')
                        ->columnSpan(2),
                ])
                ->collapsible(),

            Section::make('Coordinate Geografiche')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('lat')
                                ->label('Latitudine')
                                ->numeric(
                                    decimalPlaces: 6,
                                    decimalSeparator: '.',
                                    thousandsSeparator: ',',
                                ),
                            TextEntry::make('lng')
                                ->label('Longitudine')
                                ->numeric(
                                    decimalPlaces: 6,
                                    decimalSeparator: '.',
                                    thousandsSeparator: ',',
                                ),
                        ]),
                    KeyValueEntry::make('location')
                        ->label('Coordinate')
                        ->keyLabel('Tipo')
                        ->valueLabel('Valore')
                        ->columnSpan(2),
                ])
                ->collapsible(),

            Section::make('Indirizzo Dettagliato')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('street')
                                ->label('Via'),
                            TextEntry::make('city')
                                ->label('Città'),
                            TextEntry::make('state')
                                ->label('Stato/Provincia'),
                            TextEntry::make('zip')
                                ->label('CAP'),
                        ]),
                ])
                ->collapsible(),

            Section::make('Stato e Metadati')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('processed')
                                ->label('Processato')
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'warning'),
                            TextEntry::make('model_type')
                                ->label('Tipo Modello'),
                            TextEntry::make('model_id')
                                ->label('ID Modello'),
                        ]),
                ])
                ->collapsible(),

            Section::make('Informazioni di Sistema')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('created_at')
                                ->label('Data Creazione')
                                ->dateTime(),
                            TextEntry::make('updated_at')
                                ->label('Data Aggiornamento')
                                ->dateTime(),
                            TextEntry::make('created_by')
                                ->label('Creato da'),
                            TextEntry::make('updated_by')
                                ->label('Aggiornato da'),
                        ]),
                ])
                ->collapsible(),
        ];
    }
}
