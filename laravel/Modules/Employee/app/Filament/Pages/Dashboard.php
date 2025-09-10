<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Pages;

use Modules\Employee\Filament\Widgets;
use Modules\Xot\Filament\Pages\XotBaseDashboard;

/**
 * Dashboard per il modulo Employee.
<<<<<<< HEAD
 * 
 * 
=======
 *
>>>>>>> cda86dd (.)
 * Estende XotBaseDashboard che gestisce automaticamente:
 * - Navigazione (icon, title, label, sort)
 * - Filtri del dashboard
 * - Struttura base del dashboard
<<<<<<< HEAD
 * 
 * 
=======
 *
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
    
    // ✅ XotBaseDashboard auto-configura tutto basandosi sul modulo
    
    // protected static string $view = 'employee::filament.pages.dashboard';

    /**
     * Widget da visualizzare nella pagina con configurazione columnSpan personalizzata.
     * TimeClockWidget a tutta larghezza, altri widget in griglia 3x2 (4 colonne ciascuno).
     *
     * @return array<class-string>
     */
    public function getWidgets(): array
    {
        return [
            // Widgets\TimeClockWidget::class,
            // Widgets\TodoWidget::class,
            // Widgets\UpcomingScheduleWidget::class,
            // Widgets\PendingRequestsWidget::class,
            // Widgets\TimeOffBalanceWidget::class,
            // Widgets\TodayPresenceWidget::class,
=======

    // ✅ XotBaseDashboard auto-configura tutto basandosi sul modulo

    /**
     * Widget da visualizzare nell'header del dashboard.
     *
     * @return array<class-string<\Filament\Widgets\Widget>>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            \Modules\Employee\Filament\Widgets\TimeClockWidget::class,
            /*
            \Modules\Employee\Filament\Widgets\EmployeeOverviewWidget::class,
            \Modules\Employee\Filament\Resources\WorkHourResource\Widgets\WorkHourStatsWidget::class,
            \Modules\Employee\Filament\Widgets\TodoWidget::class,
            */
>>>>>>> cda86dd (.)
        ];
    }

    /**
<<<<<<< HEAD
     * Configura il numero di colonne per i widget (3 widget per riga).
     */
    protected function getWidgetsColumns(): int | array
    {
        return 3;
    }

=======
     * Get the widgets that should be displayed in the footer.
     *
     * @return array<class-string>
     */
    protected function getFooterWidgets(): array
    {
        return [
            /*
            \Modules\Employee\Filament\Widgets\UpcomingScheduleWidget::class,
            \Modules\Employee\Filament\Widgets\TimeOffBalanceWidget::class,
            \Modules\Employee\Filament\Widgets\TodayPresenceWidget::class,
            \Modules\Employee\Filament\Widgets\PendingRequestsWidget::class,
            */
        ];
    }

    public function getWidgets(): array
    {
        return [];
    }
>>>>>>> cda86dd (.)
}
