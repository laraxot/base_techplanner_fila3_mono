<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Geo\Filament\Resources\AddressResource\Pages;
use Modules\Geo\Filament\Resources\AddressResource\RelationManagers;
use Modules\Geo\Models\Address;
use Modules\Geo\Models\Locality;
use Modules\Geo\Models\Province;
use Modules\Geo\Models\Region;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Resource per la gestione degli indirizzi geografici.
 *
 * Fornisce un'interfaccia completa per:
 * - Creazione di nuovi indirizzi con validazione geografica
 * - Modifica dei dati esistenti
 * - Visualizzazione delle informazioni su mappa
 * - Gestione delle relazioni con altri modelli
 * fornendo funzionalità per la creazione, modifica e visualizzazione
 * degli indirizzi su mappa.
 */
class AddressResource extends XotBaseResource
{
    protected static null|string $model = Address::class;

    // ✅ CORRETTO - NIENTE navigationGroup - La gestione è centralizzata in XotBaseResource

    protected static null|int $navigationSort = 3;

    /**
     * @return array<string, \Filament\Forms\Components\Component>
     */
    #[\Override]
    public static function getFormSchema(): array
    {
        return [
            'name' => Forms\Components\TextInput::make('name')->maxLength(255),
            'country' => Forms\Components\TextInput::make('country') //Nazione
                ->maxLength(255)
                ->default('Italia')
                ->visible(false)
                ->columnSpan(2),
            'administrative_area_level_1' => Select::make('administrative_area_level_1')
                ->options(Region::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('administrative_area_level_2', null);
                    $set('locality', null);
                    $set('postal_code', null);
                    $set('cap', null);
                }),
            'administrative_area_level_2' => Select::make('administrative_area_level_2')
                ->options(Province::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('cap', null);
                    $set('postal_code', null);
                    $set('locality', null);
                })
                ->disabled(fn(Get $get) => !$get('administrative_area_level_1'))
                ->placeholder(__('filament-forms::components.select.placeholder')),
            'locality' => Select::make('locality')
                ->options(Locality::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->disabled(fn(Get $get) => !$get('administrative_area_level_1') || !$get('administrative_area_level_2'))
                ->extraAttributes(['class' => 'h-8 flex items-center'])
                ->afterStateUpdated(function (Set $set) {
                    $set('postal_code', null);
                })
                ->placeholder(__('filament-forms::components.select.placeholder')),
            'postal_code' => Select::make('postal_code')
                ->options(Locality::getPostalCodeOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->disabled(fn(Get $get) => !$get('administrative_area_level_1') || !$get('administrative_area_level_2'))
                ->placeholder(__('filament-forms::components.select.placeholder')),
            'route' => Forms\Components\TextInput::make('route')->required()->maxLength(255),
            'street_number' => Forms\Components\TextInput::make('street_number')->maxLength(20),
            'is_primary' => Forms\Components\Toggle::make('is_primary')->default(false),
        ];
    }

    public static function getSearchStep(): array
    {
        return [
            'region' => Select::make('region')
                ->options(Region::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('province', null);
                    $set('locality', null);
                    $set('postal_code', null);
                    $set('cap', null);
                }),
            'province' => Select::make('province')
                ->options(Province::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('cap', null);
                    $set('postal_code', null);
                    $set('locality', null);
                })
                ->disabled(fn(Get $get) => !$get('region'))
                ->placeholder(__('filament-forms::components.select.placeholder')),
            //->extraAttributes([
            //'class' => 'h-9'
            //])
            'locality' => Select::make('locality')
                ->options(Locality::getOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->disabled(fn(Get $get) => !$get('region') || !$get('province'))
                ->placeholder(__('filament-forms::components.select.placeholder'))
                ->afterStateUpdated(function (Set $set) {
                    $set('postal_code', null);
                }),
            'postal_code' => Select::make('postal_code')
                ->options(Locality::getPostalCodeOptions(...))
                ->searchable()
                ->required()
                ->live()
                ->disabled(fn(Get $get) => !$get('region') || !$get('province'))
                ->placeholder(__('filament-forms::components.select.placeholder')),
        ];
    }
}
