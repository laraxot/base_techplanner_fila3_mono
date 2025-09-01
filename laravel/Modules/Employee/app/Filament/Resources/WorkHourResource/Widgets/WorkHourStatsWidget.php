<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Widgets\XotBaseStatsOverviewWidget;

class WorkHourStatsWidget extends XotBaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();

        // Get stats for today
        $todayTotal = WorkHour::whereDate('timestamp', $today)->count();
        $todayClockIns = WorkHour::where('type', WorkHour::TYPE_CLOCK_IN)
            ->whereDate('timestamp', $today)
            ->count();
        $todayClockOuts = WorkHour::where('type', WorkHour::TYPE_CLOCK_OUT)
            ->whereDate('timestamp', $today)
            ->count();

        // Get stats for this week
        $weekTotal = WorkHour::whereBetween('timestamp', [$thisWeekStart, $thisWeekEnd])->count();

        // Get pending approvals count
        $pendingApprovals = WorkHour::where('status', WorkHour::STATUS_PENDING)->count();

        return [
            Stat::make('Today\'s Entries', $todayTotal)
                ->description('Total time entries today')
                ->descriptionIcon('heroicon-m-clock')
                ->color('primary'),

            Stat::make('This Week', $weekTotal)
                ->description('Total entries this week')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),

            Stat::make('Clock In/Out', $todayClockIns.'/'.$todayClockOuts)
                ->description('Today\'s clock-ins/outs')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('Pending Approval', $pendingApprovals)
                ->description('Entries awaiting approval')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color($pendingApprovals > 0 ? 'warning' : 'success'),
        ];
    }
}
