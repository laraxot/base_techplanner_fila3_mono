<?php

declare(strict_types=1);

/**
 * @see https://github.com/mooxphp/jobs/tree/main
 */

namespace Modules\Job\Filament\Resources;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Modules\Job\Filament\Resources\JobManagerResource\Pages;
use Modules\Job\Filament\Resources\JobManagerResource\Widgets;
use Modules\Job\Models\JobManager;
use Modules\Xot\Filament\Resources\XotBaseResource;

class JobManagerResource extends XotBaseResource
{
    protected static ?string $model = JobManager::class;

    public static function getFormSchema(): array
    {
        return [
            'job_id' => TextInput::make('job_id')
                ->required()
                ->maxLength(255),
            'name' => TextInput::make('name')
                ->maxLength(255),
            'queue' => TextInput::make('queue')
                ->maxLength(255),
            'started_at' => DateTimePicker::make('started_at'),
            'finished_at' => DateTimePicker::make('finished_at'),
            'failed' => Toggle::make('failed')
                ->required(),
            'attempt' => TextInput::make('attempt')
                ->required(),
            'exception_message' => Textarea::make('exception_message')
                ->maxLength(65535),
        ];
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobManagers::route('/'),
            'create' => Pages\CreateJobManager::route('/create'),
            'edit' => Pages\EditJobManager::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\JobStatsOverview::class,
        ];
    }
}
