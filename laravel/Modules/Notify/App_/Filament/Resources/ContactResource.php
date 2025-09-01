<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources;

use Filament\Forms;
use Modules\Notify\Models\Contact;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ContactResource extends XotBaseResource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getFormSchema(): array
    {
        return [
            'name' => Forms\Components\TextInput::make('name')
                ->required(),
            'email' => Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            'phone' => Forms\Components\TextInput::make('phone')
                ->tel()
                ->nullable(),
        ];
    }
}
