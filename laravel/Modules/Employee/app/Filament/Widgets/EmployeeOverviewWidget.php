<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Widgets\XotBaseStatsOverviewWidget;

/**
 * Widget panoramica dipendenti per il dashboard Employee.
 *
 * Fornisce statistiche chiave sui dipendenti inclusi:
 * - Totale dipendenti registrati
 * - Dipendenti attivi oggi
 * - Dipendenti in ferie
 * - Nuovi assunti del mese
 */
class EmployeeOverviewWidget extends XotBaseStatsOverviewWidget
{
    /**
     * Ordine di visualizzazione del widget.
     */
    protected static ?int $sort = 1;

    /**
     * Restituisce le statistiche da visualizzare nel widget.
     *
     * @return array<\Filament\Widgets\StatsOverviewWidget\Stat>
     */
    protected function getStats(): array
    {
        // Cache delle statistiche per 5 minuti per migliorare performance
        return cache()->remember('employee.overview.stats', 300, function () {
            $today = Carbon::today();
            $thisMonth = Carbon::now()->startOfMonth();

            // Totale dipendenti
            $totalEmployees = Employee::count();

            // Dipendenti attivi oggi (hanno fatto almeno una timbratura)
            // Nota: Utilizziamo la tabella time_entries per le timbrature
            $activeToday = WorkHour::whereDate('timestamp', $today)
                ->distinct('employee_id')
                ->count('employee_id');

            // Dipendenti in ferie (status on_leave)
            $onLeave = Employee::where('status', 'on_leave')->count();

            // Nuovi dipendenti questo mese
            $newThisMonth = Employee::where('created_at', '>=', $thisMonth)->count();

            return [
                Stat::make('Total Employees', $totalEmployees)
                    ->description('All registered employees')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('primary')
                    ->chart($this->getEmployeeTrendChart()),

                Stat::make('Active Today', $activeToday)
                    ->description('Employees with activity today')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color($activeToday > 0 ? 'success' : 'gray')
                    ->chart($this->getDailyActivityChart()),

                Stat::make('On Leave', $onLeave)
                    ->description('Employees currently on leave')
                    ->descriptionIcon('heroicon-m-calendar')
                    ->color($onLeave > 0 ? 'warning' : 'success'),

                Stat::make('New This Month', $newThisMonth)
                    ->description('New hires this month')
                    ->descriptionIcon('heroicon-m-user-plus')
                    ->color($newThisMonth > 0 ? 'info' : 'gray')
                    ->chart($this->getMonthlyHiresChart()),
            ];
        });
    }

    /**
     * Genera dati per il grafico trend dipendenti (ultimi 7 giorni).
     *
     * @return array<int>
     */
    private function getEmployeeTrendChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $data[] = Employee::whereDate('created_at', '<=', $date)->count();
        }

        return $data;
    }

    /**
     * Genera dati per il grafico attività giornaliera (ultimi 7 giorni).
     *
     * @return array<int>
     */
    private function getDailyActivityChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $activeCount = WorkHour::whereDate('timestamp', $date)
                ->distinct('employee_id')
                ->count('employee_id');
            $data[] = $activeCount;
        }

        return $data;
    }

    /**
     * Genera dati per il grafico assunzioni mensili (ultimi 7 mesi).
     *
     * @return array<int>
     */
    private function getMonthlyHiresChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $data[] = Employee::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return $data;
    }
}
