<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

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
