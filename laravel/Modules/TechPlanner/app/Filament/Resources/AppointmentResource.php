<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Filament\Resources\AppointmentResource\Pages;
use Modules\TechPlanner\Models\Appointment;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * ---
 */
class AppointmentResource extends XotBaseResource
{
    protected static ?string $model = Appointment::class;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('client_id')
                ->relationship('client', 'name')
                ->required(),
            Forms\Components\DatePicker::make('date')
                ->required(),
            Forms\Components\TimePicker::make('time')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'scheduled' => 'Scheduled',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])

                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return true;
    }

    public static function canDetach(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return true;
    }
}
