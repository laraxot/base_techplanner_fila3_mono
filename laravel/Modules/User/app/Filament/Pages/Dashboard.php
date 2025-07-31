<?php

/**
 * @see https://medium.com/@laravelprotips/filament-streamline-multiple-widgets-with-one-dynamic-livewire-filter-ed05c978a97f
 */

declare(strict_types=1);

namespace Modules\User\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Modules\Xot\Filament\Pages\XotBaseDashboard;
use Modules\User\Filament\Widgets;

/**
 * Dashboard per il modulo User.
 * 
 * Estende XotBaseDashboard che gestisce automaticamente:
 * - Navigazione (icon, title, label, sort)
 * - Filtri del dashboard
 * - Struttura base del dashboard
 * 
 * REGOLA CRITICA: NON ridefinire proprietà di navigazione
 * che sono già gestite centralmente da XotBaseDashboard.
 */
class Dashboard extends XotBaseDashboard
{
    // ❌ NON ridefinire queste proprietà (gestite da XotBaseDashboard):
    // protected static ?string $navigationIcon
    // protected static ?string $title
    // protected static ?string $navigationLabel
    // protected static ?int $navigationSort
    
    // ✅ XotBaseDashboard auto-configura tutto basandosi sul modulo
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

    /**
     * Schema dei filtri specifici per il modulo User.
     * 
     * Questo metodo è chiamato da XotBaseDashboard::filtersForm()
     * per personalizzare i filtri del dashboard.
     *
     * @return array<int, \Filament\Forms\Components\Component>
     */
    public function getFiltersFormSchema(): array
    {
        return [
            DatePicker::make('startDate')
                ->native(false),
                // ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
            DatePicker::make('endDate')
                ->native(false),
                // ->minDate(fn (Get $get) => $get('startDate') ?: now())
                // ->maxDate(now()),
        ];
    }
}
