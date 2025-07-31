<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources;

use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Modules\Geo\Filament\Resources\LocationResource\Pages;
use Modules\Geo\Models\Location;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Resource per la gestione dei luoghi.
 *
 * Questa classe gestisce l'interfaccia amministrativa per i luoghi,
 * fornendo funzionalità per la creazione, modifica e visualizzazione dei luoghi
 * sulla mappa.
 */
class LocationResource extends XotBaseResource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Geo';

    protected static ?int $navigationSort = 2;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('latitude')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('longitude')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('street')
                ->maxLength(255),
            Forms\Components\TextInput::make('city')
                ->maxLength(255),
            Forms\Components\TextInput::make('state')
                ->maxLength(255),
            Forms\Components\TextInput::make('zip')
                ->maxLength(255),
            Forms\Components\TextInput::make('formatted_address')
                ->maxLength(1024),

            Map::make('location')
                ->reactive()
                ->afterStateUpdated(function (array $state, callable $set, callable $get) {
                    $set('lat', $state['lat']);
                    $set('lng', $state['lng']);
                })
                ->drawingControl()
                ->defaultLocation([39.526610, -107.727261])
                ->mapControls([
                    'zoomControl' => true,
                    'mapTypeControl' => true,
                    'scaleControl' => true,
                    'streetViewControl' => true,
                    'rotateControl' => true,
                    'fullscreenControl' => true,
                ])
                ->autocomplete('formatted_address')
                ->autocompleteReverse()
                ->reverseGeocode([
                    'street' => 'street_number|route',
                    'city' => 'locality',
                    'state' => 'administrative_area_level_1',
                    'zip' => 'postal_code',
                ]),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('street')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('zip')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                RadiusFilter::make('location')
                    ->section('Radius Filter')
                    ->selectUnit(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                RadiusAction::make('location'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'view' => Pages\ViewLocation::route('/{record}'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
