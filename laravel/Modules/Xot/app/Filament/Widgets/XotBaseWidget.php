<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Cache;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Widgets\WidgetConfiguration;
use Filament\Widgets\Widget as FilamentWidget;
use Modules\Xot\Actions\View\GetViewByClassAction;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Actions\Action;
=======
use Filament\Widgets\Widget as FilamentWidget;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\WidgetConfiguration;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Modules\Xot\Actions\View\GetViewByClassAction;
>>>>>>> 9d6070e (.)

/**
 * @property bool $shouldRender
 *
 */
<<<<<<< HEAD
abstract class XotBaseWidget extends FilamentWidget implements HasForms
{
    use InteractsWithPageFilters;
    //use InteractsWithPageTable;
    use InteractsWithForms;

    public string $title = '';
    public string $icon = '';
    protected int|string|array $columnSpan = 'full';
=======
abstract class XotBaseWidget extends FilamentWidget
{
    use InteractsWithPageFilters;
    public string $title = '';
    public string $icon = '';
>>>>>>> 9d6070e (.)
    /**
     * The view that should be rendered for the widget.
     *
     * This property allows either a string that can be rendered as a view
     * (prefixed with a namespace like 'module-name::view-name') or a path to a
     * Blade view file.
     *
     * @var view-string
     */
    protected static string $view;


<<<<<<< HEAD
    public array $listener = [
        'filters-updated' => 'filtersUpdated',

    ];

    public ?array $data = [];

    /*
=======
>>>>>>> 9d6070e (.)
    public function __construct()
    {
        //parent::__construct();//Cannot call constructor
        $view = app(GetViewByClassAction::class)->execute(static::class);
<<<<<<< HEAD
        if(view()->exists($view)){
            $this->view = $view;
        }
    }
    */
    /*
    public function mount(): void
    {
        $this->form->fill();
    }
    */


    abstract public function getFormSchema(): array;


    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            //->columns(2)
            ->statePath('data');
    }



     protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
=======
        static::$view = $view;
>>>>>>> 9d6070e (.)

    }
}
