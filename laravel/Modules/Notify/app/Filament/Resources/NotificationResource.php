<?php

namespace Modules\Notify\Filament\Resources;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Modules\Notify\Filament\Resources\NotificationResource\Pages;
use Modules\Notify\Models\Notification;
use Modules\Xot\Filament\Resources\XotBaseResource;

class NotificationResource extends XotBaseResource
{
    protected static ?string $model = Notification::class;


    public static function getFormSchema(): array
    {
        return [
            TextInput::make('type')
                ->required(),

            TextInput::make('notifiable_type')
                ->required(),

            TextInput::make('notifiable_id')
                ->required()
                ->numeric(),
            Textarea::make('data')
                ->columnSpanFull(),

            DateTimePicker::make('read_at')
                ->nullable(),

            TextInput::make('created_by')
                ->disabled(),

            TextInput::make('updated_by')
                ->disabled(),
        ];
    }


}
