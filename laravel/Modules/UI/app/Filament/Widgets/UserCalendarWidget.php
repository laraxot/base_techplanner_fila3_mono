<?php
namespace Modules\UI\Filament\Widgets;


use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use App\Filament\Resources\EventResource;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DateTimePicker;

class UserCalendarWidget extends FullCalendarWidget
{
    use \Saade\FilamentFullCalendar\Widgets\Concerns\InteractsWithEvents;
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

        $action=$this->getActionName(__FUNCTION__);
        return app($action)->execute();
        //*
        return [
            TextInput::make('title'),
 
            Grid::make()
                ->schema([
                    DateTimePicker::make('starts_at'),
                    DateTimePicker::make('ends_at'),
                ]),
        ];
        //*/
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
      dd('test');
    }

    
}