<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Filament\Infolists\Components;
=======
use Modules\TechPlanner\Filament\Resources\ClientResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewClient extends XotBaseViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getInfolistSchema(): array
    {
        return [
            \Filament\Infolists\Components\Section::make('Company Information')
                ->schema([
                    \Filament\Infolists\Components\TextEntry::make('company_name')->label('Company Name'),
                    \Filament\Infolists\Components\TextEntry::make('activity')->label('Activity'),
                    \Filament\Infolists\Components\TextEntry::make('business_closed')->label('Business Closed'),
                    \Filament\Infolists\Components\TextEntry::make('tax_code')->label('Tax Code'),
                    \Filament\Infolists\Components\TextEntry::make('vat_number')->label('VAT Number'),
                    \Filament\Infolists\Components\TextEntry::make('fiscal_code')->label('Fiscal Code'),
                ]),
            
            \Filament\Infolists\Components\Section::make('Contact Information')
                ->schema([
                    \Filament\Infolists\Components\TextEntry::make('address')->label('Address'),
                    \Filament\Infolists\Components\TextEntry::make('street_number')->label('Street Number'),
                    \Filament\Infolists\Components\TextEntry::make('city')->label('City'),
                    \Filament\Infolists\Components\TextEntry::make('postal_code')->label('Postal Code'),
                    \Filament\Infolists\Components\TextEntry::make('province')->label('Province'),
                    \Filament\Infolists\Components\TextEntry::make('country')->label('Country'),
                    \Filament\Infolists\Components\TextEntry::make('phone')->label('Phone'),
                    \Filament\Infolists\Components\TextEntry::make('mobile')->label('Mobile'),
                    \Filament\Infolists\Components\TextEntry::make('fax')->label('Fax'),
                    \Filament\Infolists\Components\TextEntry::make('email')->label('Email'),
                ]),

            \Filament\Infolists\Components\Section::make('Additional Information')
                ->schema([
                    \Filament\Infolists\Components\TextEntry::make('competent_health_unit')->label('Competent Health Unit'),
                    \Filament\Infolists\Components\TextEntry::make('company_office')->label('Company Office'),
                    \Filament\Infolists\Components\TextEntry::make('notes')->label('Notes'),
                ])
=======
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
