<?php

declare(strict_types=1);

namespace Modules\Employee\Actions\TimeTracking;

use Carbon\Carbon;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\TimeEntry;
use Spatie\QueueableAction\QueueableAction;

class ClockInAction
{
    use QueueableAction;

    public function execute(Employee $employee): void
    {
        // Check if already clocked in today without a clock out
        $lastEntry = TimeEntry::where('employee_id', $employee->id)
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->first();

        if ($lastEntry && $lastEntry->type === 'clock_in') {
            // Optionally throw an exception or handle the case where user is already clocked in
            return;
        }

        TimeEntry::create([
            'employee_id' => $employee->id,
            'type' => 'clock_in',
        ]);
    }
}
