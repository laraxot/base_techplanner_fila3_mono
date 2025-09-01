<?php

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Modules\TechPlanner\Filament\Resources\DeviceResource\Pages;
use Modules\TechPlanner\Models\Device;
use Modules\Xot\Filament\Resources\XotBaseResource;

class DeviceResource extends XotBaseResource
{
    protected static ?string $model = Device::class;

    protected static ?string $navigationGroup = 'TechPlanner';

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('serial_number')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('model')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('manufacturer')
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('purchase_date')
                ->required(),
            Forms\Components\DatePicker::make('warranty_expiration')
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'view' => Pages\ViewDevice::route('/{record}'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DeviceVerificationsRelationManager::class,
        ];
    }
}
