<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;use Modules\TechPlanner\Enums\PhoneCallEnum;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;
use Modules\TechPlanner\Models\PhoneCall;
use Modules\Xot\Filament\Resources\XotBaseResource;

class PhoneCallResource extends XotBaseResource
{
    protected static ?string $model = PhoneCall::class;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\DateTimePicker::make('date'),
            Forms\Components\TextInput::make('duration'),
            Forms\Components\Textarea::make('notes'),
            Forms\Components\Select::make('call_type')
                ->options(PhoneCallEnum::class),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhoneCalls::route('/'),
            'create' => Pages\CreatePhoneCall::route('/create'),
            'edit' => Pages\EditPhoneCall::route('/{record}/edit'),
        ];
    }
}
