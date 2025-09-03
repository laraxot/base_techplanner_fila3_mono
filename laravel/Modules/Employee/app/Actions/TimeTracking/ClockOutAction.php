<?php

declare(strict_types=1);

namespace Modules\Employee\Actions\TimeTracking;

use Carbon\Carbon;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\TimeEntry;
use Spatie\QueueableAction\QueueableAction;

class ClockOutAction
{
    use QueueableAction;

    public function execute(Employee $employee): void
    {
        // Check if there is a clock in to clock out from
        $lastEntry = TimeEntry::where('employee_id', $employee->id)
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->first();

        if (! $lastEntry || $lastEntry->type === 'clock_out') {
            // Optionally throw an exception or handle the case where user is not clocked in
            return;
        }

        TimeEntry::create([
            'employee_id' => $employee->id,
            'type' => 'clock_out',
        ]);
    }
}
