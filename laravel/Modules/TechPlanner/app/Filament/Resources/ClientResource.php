<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Modules\TechPlanner\Models\Client;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Geo\Filament\Forms\Components\AddressSection;
use Modules\Notify\Filament\Forms\Components\ContactSection;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

/**
 * @property ClientResource $resource
 */
class ClientResource extends XotBaseResource
{
    protected static ?string $model = Client::class;

    public static function getFormSchema(): array
    {
        $fixes=Client::whereNull('city')->whereNotNull('company_office')->get();//company_office
        foreach($fixes as $client){
            $client->update(['city'=>$client->company_office]);
        }
        $fixes=Client::whereNull('route')->whereNotNull('address')->get();//company_office
        foreach($fixes as $client){
            $client->update(['route'=>$client->address]);
        }
        return [
            'business_closed' => TextInput::make('business_closed'),                // cessato
            // 'name' => TextInput::make('name'),
            'activity' => TextInput::make('activity'),              // attivita
            'company_name' => TextInput::make('company_name')->required(),               // ditta
            'tax_code' => TextInput::make('tax_code'),              // cf
            'vat_number' => TextInput::make('vat_number')->nullable(),
            'fiscal_code' => TextInput::make('fiscal_code')->nullable(),
            'street_address' => TextInput::make('address')->nullable(),
            'street_number' => TextInput::make('street_number'),         // numero_civico
            'city' => TextInput::make('city')->nullable(),
            'postal_code' => TextInput::make('postal_code')->nullable(),
            'province' => TextInput::make('province')->nullable(),
            'country' => TextInput::make('country')->nullable(),
            //'address'=>AddressSection::make('address'),//->relationship('address'), TO DO !
            'contacts' => ContactSection::make('contacts'),
            // --------------------------------------
            'competent_health_unit' => TextInput::make('competent_health_unit'), // az_ulss_competente
            'company_office' => TextInput::make('company_office'),        // sede_ditta
            'notes' => Textarea::make('notes'),                 // note
            // 'longitude' => TextInput::make('longitude'),
            // 'latitude' => TextInput::make('latitude'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }

    /*
    public static function getRelations(): array
    {
        return [
            RelationManagers\PhoneCallsRelationManager::class,
            RelationManagers\AppointmentsRelationManager::class,
            RelationManagers\DevicesRelationManager::class,
            RelationManagers\LegalRepresentativesRelationManager::class,
            RelationManagers\LegalOfficesRelationManager::class,
            RelationManagers\MedicalDirectorsRelationManager::class,
        ];
    }
        */
    /*
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Indirizzo' => $record->full_address,
            'Coordinate' => $record->latitude && $record->longitude
                ? "{$record->latitude}, {$record->longitude}"
                : 'Non disponibili',
        ];
    }
        */
}
