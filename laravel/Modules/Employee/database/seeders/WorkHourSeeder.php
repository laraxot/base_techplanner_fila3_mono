<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Employee\Models\WorkHour;
use Modules\User\Models\User;

class WorkHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        foreach ($users as $user) {
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                if ($currentDate->isWeekend()) {
                    $currentDate->addDay();
                    continue;
                }

                // 80% chance of having work entries for each day
                if (rand(1, 100) <= 80) {
                    $this->createWorkDayEntries($user->id, $currentDate->copy());
                }

                $currentDate->addDay();
            }
        }

        $this->createIncompleteWorkDays($users);
    }

    private function createWorkDayEntries(int $employeeId, Carbon $date): void
    {
        $clockInTime = $date->copy()->setTime(rand(7, 9), rand(0, 59), 0);
        WorkHour::create([
            'employee_id' => $employeeId,
            'timestamp' => $clockInTime,
            'type' => 'clock_in',
            'notes' => rand(1, 100) <= 10 ? 'Morning shift' : null,
            'status' => 'approved',
        ]);

        // Break start (3-5 hours later)
        $breakStartTime = $clockInTime->copy()->addHours(rand(3, 5))->addMinutes(rand(0, 30));
        WorkHour::create([
            'employee_id' => $employeeId,
            'timestamp' => $breakStartTime,
            'type' => 'break_start',
            'notes' => rand(1, 100) <= 10 ? 'Lunch break' : null,
            'status' => 'approved',
        ]);

        // Break end (30-60 minutes later)
        $breakEndTime = $breakStartTime->copy()->addMinutes(rand(30, 60));
        WorkHour::create([
            'employee_id' => $employeeId,
            'timestamp' => $breakEndTime,
            'type' => 'break_end',
            'notes' => rand(1, 100) <= 10 ? 'Back from lunch' : null,
            'status' => 'approved',
        ]);

        // Clock out (3-5 hours after break end)
        $clockOutTime = $breakEndTime->copy()->addHours(rand(3, 5))->addMinutes(rand(0, 30));
        WorkHour::create([
            'employee_id' => $employeeId,
            'timestamp' => $clockOutTime,
            'type' => 'clock_out',
            'notes' => rand(1, 100) <= 20 ? 'End of work day' : null,
            'status' => 'approved',
        ]);
    }

    /**
     * Create some incomplete work days for testing.
     */
    /**
     * @param \Illuminate\Database\Eloquent\Collection<int, \Modules\Employee\Models\Employee> $users
     */
    private function createIncompleteWorkDays($users): void
    {
        foreach ($users as $user) {
            $today = Carbon::today();

            // User who clocked in but didn't clock out
            WorkHour::create([
                'employee_id' => $user->id,
                'timestamp' => $today->copy()->setTime(8, 30, 0),
                'type' => 'clock_in',
                'notes' => 'Current work session',
                'status' => 'pending',
            ]);

            // User on break yesterday
            $yesterday = Carbon::yesterday();
            WorkHour::create([
                'employee_id' => $user->id,
                'timestamp' => $yesterday->copy()->setTime(8, 0, 0),
                'type' => 'clock_in',
                'status' => 'approved',
            ]);

            WorkHour::create([
                'employee_id' => $user->id,
                'timestamp' => $yesterday->copy()->setTime(12, 0, 0),
                'type' => 'break_start',
                'notes' => 'Extended lunch break',
                'status' => 'pending',
            ]);
        }
    }
}
