<?php

declare(strict_types=1);

/**
 * ---.
 */

namespace Modules\Job\Filament\Resources\JobResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Modules\Job\Models\JobManager;
use Modules\Job\Traits\FormatSeconds;

class JobStatsOverview extends BaseWidget
{
    use FormatSeconds;

    /**
     * Get the stats cards for the widget.
     *
     * @return array<Stat>
     */
    protected function getCards(): array
    {
        $aggregatedInfo = $this->getAggregatedJobInfo();

        return [
            Stat::make(__('jobs::translations.total_jobs'), $aggregatedInfo['count'] ?? 0),
            Stat::make(__('jobs::translations.execution_time'), $aggregatedInfo['total_time'] ?? '0'),
            Stat::make(__('jobs::translations.average_time'), $aggregatedInfo['average_time'] ?? '0'),
        ];
    }

    /**
     * Get aggregated job information from database.
     *
     * @return array<string, mixed>
     */
    private function getAggregatedJobInfo(): array
    {
        $aggregationColumns = [
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(finished_at - started_at) as total_time_elapsed'),
            DB::raw('AVG(finished_at - started_at) as average_time_elapsed'),
        ];

        $aggregatedInfo = JobManager::query()
            ->select($aggregationColumns)
            ->first();

<<<<<<< HEAD
        if (!$aggregatedInfo) {
            return [
                'count' => 0,
                'total_time' => '0',
                'average_time' => '0',
            ];
=======
        if ($aggregatedInfo) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $averageTime = isset($aggregatedInfo->average_time_elapsed) ? ceil((float) $aggregatedInfo->average_time_elapsed).'s' : '0';
            $totalTime = isset($aggregatedInfo->total_time_elapsed) ? $this->formatSeconds($aggregatedInfo->total_time_elapsed).'s' : '0';
=======
=======
>>>>>>> ae734db (.)
=======
>>>>>>> c2cfa33 (.)
            $averageTime = app(\Modules\Xot\Actions\Cast\SafeEloquentCastAction::class)
                ->getStringAttribute($aggregatedInfo, 'average_time_elapsed', '0') ? 
                ceil((float) app(\Modules\Xot\Actions\Cast\SafeEloquentCastAction::class)
                    ->getStringAttribute($aggregatedInfo, 'average_time_elapsed', '0')).'s' : '0';
            
            $totalTime = app(\Modules\Xot\Actions\Cast\SafeEloquentCastAction::class)
                ->getStringAttribute($aggregatedInfo, 'total_time_elapsed', '0') ? 
                $this->formatSeconds((int) app(\Modules\Xot\Actions\Cast\SafeEloquentCastAction::class)
                    ->getStringAttribute($aggregatedInfo, 'total_time_elapsed', '0')).'s' : '0';
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 4ab16aa (.)
=======
>>>>>>> ae734db (.)
=======
>>>>>>> c2cfa33 (.)
        } else {
            $averageTime = '0';
            $totalTime = '0';
>>>>>>> 03c1f8f (.)
        }

        return [
            'count' => $aggregatedInfo->count ?? 0,
            'total_time' => $this->formatTimeElapsed($aggregatedInfo->total_time_elapsed),
            'average_time' => $this->formatAverageTime($aggregatedInfo->average_time_elapsed),
        ];
    }

    /**
     * Format total time elapsed.
     *
     * @param mixed $totalTimeElapsed
     * @return string
     */
    private function formatTimeElapsed($totalTimeElapsed): string
    {
        if ($totalTimeElapsed === null) {
            return '0';
        }

        return $this->formatSeconds((int) $totalTimeElapsed) . 's';
    }

    /**
     * Format average time elapsed.
     *
     * @param mixed $averageTimeElapsed
     * @return string
     */
    private function formatAverageTime($averageTimeElapsed): string
    {
        if ($averageTimeElapsed === null) {
            return '0';
        }

        return ceil((float) $averageTimeElapsed) . 's';
    }
}
