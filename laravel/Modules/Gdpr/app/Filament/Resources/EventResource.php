<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources;

use Filament\Forms;
use Modules\Gdpr\Filament\Resources\EventResource\Pages;
use Modules\Gdpr\Models\Event;
use Modules\Xot\Filament\Resources\XotBaseResource;

class EventResource extends XotBaseResource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public static function getFormSchema(): array
    {
        return [
            'treatment_id' => Forms\Components\TextInput::make('treatment_id')
                ->maxLength(36)
                ->default(null),
            'consent_id' => Forms\Components\Select::make('consent_id')
                ->relationship('consent', 'id'),
            'subject_id' => Forms\Components\TextInput::make('subject_id')
                ->required()
                ->maxLength(191),
            'ip' => Forms\Components\TextInput::make('ip')
                ->required()
                ->maxLength(191),
            'action' => Forms\Components\TextInput::make('action')
                ->required()
                ->maxLength(191),
            'payload' => Forms\Components\Textarea::make('payload')
                ->required()
                ->columnSpanFull(),
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public static function getRelations(): array
    {
        return [
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
