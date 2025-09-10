<?php

/**
 * @see https://medium.com/@laravelprotips/filament-streamline-multiple-widgets-with-one-dynamic-livewire-filter-ed05c978a97f
 */

declare(strict_types=1);

namespace Modules\User\Filament\Pages;

<<<<<<< HEAD
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Modules\User\Filament\Widgets;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\WidgetConfiguration;
use Filament\Pages\Dashboard as BaseBashboard;
use Modules\Xot\Filament\Pages\XotBaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends XotBaseDashboard
{
    

=======
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Get;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Modules\User\Filament\Widgets;
use Modules\Xot\Filament\Pages\XotBaseDashboard;

class Dashboard extends XotBaseDashboard
{
>>>>>>> 9831a351 (.)
    protected static ?string $navigationIcon = 'heroicon-o-home';
    // protected static string $routePath = 'finance';
    // protected static ?string $title = 'Finance dashboard';
    // protected static ?int $navigationSort = 15;

    // protected static string $view = 'user::filament.pages.dashboard';

    /**
     * @return array<class-string<Widget>|WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            Widgets\UsersChartWidget::make(['chart_id' => 'bb']),
            // Widgets\UsersChartWidget::make(['chart_id' => 'aa']),
            Widgets\RecentLoginsWidget::class,
        ];
    }

<<<<<<< HEAD
    public function getFiltersFormSchema():array{
        return [
            DatePicker::make('startDate')
                            ->native(false)
                        // ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
                        ,
                        DatePicker::make('endDate')
                            ->native(false)
                        // ->minDate(fn (Get $get) => $get('startDate') ?: now())
                        // ->maxDate(now()),
                        ,
        ];
    }

    
=======
    public function getFiltersFormSchema(): array
    {
        return [
            DatePicker::make('startDate')
                ->native(false)
            // ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
            ,
            DatePicker::make('endDate')
                ->native(false)
            // ->minDate(fn (Get $get) => $get('startDate') ?: now())
            // ->maxDate(now()),
            ,
        ];
    }
>>>>>>> 9831a351 (.)
}
