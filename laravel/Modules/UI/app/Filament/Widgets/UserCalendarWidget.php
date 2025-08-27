<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use function Safe\class_alias;
use App\Filament\Resources\EventResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DateTimePicker;

// Provide a local alias to avoid fatal when the package isn't installed during static analysis.
if (class_exists(\Saade\FilamentFullCalendar\Widgets\FullCalendarWidget::class)) {
    class_alias(\Saade\FilamentFullCalendar\Widgets\FullCalendarWidget::class, __NAMESPACE__.'\\_FullCalendarBase');
} else {
    abstract class _FullCalendarBase {}
}

class UserCalendarWidget extends _FullCalendarBase
{
    public string $type;

    
    public function getActionName(string $function): string
    {
        $action_suffix=Str::of($function)->studly()->append('Action')->toString();
        $resource=XotData::make()->getUserResourceClassByType($this->type);
        $model = $resource::getModel();
        $action=\Illuminate\Support\Str::of($model)
            ->replace('\Models\\', '\Actions\\')
            ->append('\Calendar\\'.$action_suffix)
            ->toString();
        return $action;
    }
    
    public function fetchEvents(array $fetchInfo): array
    {
        $action=$this->getActionName(__FUNCTION__);
        return app($action)->execute($fetchInfo);
    }

    public function getFormSchema(): array
    {
        $action = $this->getActionName(__FUNCTION__);
        
        if (class_exists($action)) {
            return app($action)->execute();
        }
        
        // Fallback schema
        return [
            TextInput::make('title'),
 
            Grid::make()
                ->schema([
                    DateTimePicker::make('starts_at'),
                    DateTimePicker::make('ends_at'),
                ]),
        ];
    }

   
    /*
    protected function modalActions(): array
    {
        return [
            \Saade\FilamentFullCalendar\Actions\EditAction::make(),
            \Saade\FilamentFullCalendar\Actions\DeleteAction::make(),
        ];
    }
    */

    public function onDateSelect(string $start, ?string $end, bool $allDay, ?array $view, ?array $resource): void
    {
        // TODO: Implementare la logica per la selezione della data
        // dd('test');
    }

    
}