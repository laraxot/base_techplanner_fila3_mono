<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Cheesegrits\FilamentGoogleMaps\Actions\GoToAction;
use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Modules\Geo\Models\Location;
use Modules\Geo\Models\Place;

class LocationMapTableWidget extends MapTableWidget
{
    protected static ?string $heading = 'Location Map';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?string $mapId = 'incidents';

    protected static ?bool $filtered = true;

    protected static bool $collapsible = true;

    public ?bool $mapIsFilter = false;

    protected static ?string $markerAction = 'markerAction';

    public function getConfig(): array
    {
        $config = parent::getConfig();

        $config['center'] = [
            'lat' => 34.730369,
            'lng' => -86.586104,
        ];

        return $config;
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()->schema([
                TextInput::make('name')
                    ->maxLength(256),
                TextInput::make('lat')
                    ->maxLength(32),
                TextInput::make('lng')
                    ->maxLength(32),
                TextInput::make('street')
                    ->maxLength(255),
                TextInput::make('city')
                    ->maxLength(255),
                TextInput::make('state')
                    ->maxLength(255),
                TextInput::make('zip')
                    ->maxLength(255),
                TextInput::make('formatted_address')
                    ->maxLength(1024),
            ]),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Location::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
            TextColumn::make('street')
                ->searchable()
                ->sortable(),
            TextColumn::make('city')
                ->searchable()
                ->sortable(),
            TextColumn::make('state')
                ->searchable()
                ->sortable(),
            TextColumn::make('zip')
                ->searchable()
                ->sortable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            MapIsFilter::make(),
            RadiusFilter::make(),
        ];
    }

    protected function getTableRecordAction(): ?string
    {
        return 'markerAction';
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create Location'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            GoToAction::make()
                ->label('Go to Location'),
            RadiusAction::make()
                ->label('Radius Search'),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public function markerAction(): void
    {
        // Implementazione dell'azione marker
    }
}
