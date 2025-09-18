<?php

declare(strict_types=1);

/**
 * @see HusamTariq\FilamentDatabaseSchedule
 */

namespace Modules\Job\Observers;

use Modules\Job\Enums\Status;
use Modules\Job\Models\Schedule;
use Modules\Job\Services\ScheduleService;

class ScheduleObserver
{
    /**
     * Undocumented function.
     */
    public function created(): void
    {
        $this->clearCache();
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function updated(Schedule $schedule): void
=======
    public function updated(Schedule $_schedule): void
>>>>>>> 4e86067 (.)
    {
        $this->clearCache();
    }

    /**
     * Undocumented function.
     */
    public function deleted(Schedule $schedule): void
    {
        $schedule->status = Status::Trashed;
        $schedule->saveQuietly();
        $this->clearCache();
    }

    /**
     * Undocumented function.
     */
    public function restored(Schedule $schedule): void
    {
        $schedule->status = Status::Inactive;
        $schedule->saveQuietly();
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function saved(Schedule $schedule): void
=======
    public function saved(Schedule $_schedule): void
>>>>>>> 4e86067 (.)
    {
        $this->clearCache();
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected function clearCache(): void
    {
        if (config('job::cache.enabled')) {
            $scheduleService = app(ScheduleService::class);
            if ($scheduleService !== null) {
                $scheduleService->clearCache();
            }
        }
    }
}
