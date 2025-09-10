<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Collection;
=======
>>>>>>> cda86dd (.)
use Modules\Employee\Models\WorkHour;
use Modules\User\Models\User;

class WorkHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        /** @var \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User> $users */
        $users = User::all();
        if ($users->isEmpty()) {
            /** @var \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User> $users */
            $users = User::factory(5)->create();
        }

=======
        // Get all users or create some if none exist
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        // Create work hour entries for the last 30 days
>>>>>>> cda86dd (.)
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        foreach ($users as $user) {
<<<<<<< HEAD
            if (!$user instanceof \Modules\User\Models\User) {
                continue;
            }
            
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
=======
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                // Skip weekends (optional - remove if you want weekend entries)
>>>>>>> cda86dd (.)
                if ($currentDate->isWeekend()) {
                    $currentDate->addDay();

                    continue;
                }

                // 80% chance of having work entries for each day
                if (rand(1, 100) <= 80) {
<<<<<<< HEAD
                    $userId = $user->id;
                    if (is_int($userId) || (is_string($userId) && ctype_digit($userId))) {
                        $this->createWorkDayEntries((int) $userId, $currentDate->copy());
                    }
=======
                    $this->createWorkDayEntries($user->id, $currentDate->copy());
>>>>>>> cda86dd (.)
                }

                $currentDate->addDay();
            }
        }

<<<<<<< HEAD
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
=======
        // Create some incomplete work days (for testing validation)
        $this->createIncompleteWorkDays($users->take(2));
    }

    /**
     * Create a complete work day sequence for a user.
     */
    private function createWorkDayEntries(int $userId, Carbon $date): void
    {
        // Clock in (8:00-9:30 AM)
        $clockInTime = $date->copy()->setTime(
            rand(8, 9),
            collect([0, 15, 30, 45])->random(),
            0
        );

        WorkHour::create([
            'user_id' => $userId,
            'badge_id' => 'EMP'.str_pad((string) $userId, 4, '0', STR_PAD_LEFT),
            'date' => $date->toDateString(),
            'time' => $clockInTime,
            'type' => WorkHour::TYPE_CLOCK_IN,
            'notes' => rand(1, 100) <= 20 ? 'Started work' : null,
        ]);

        // Break start (12:00-1:00 PM)
        $breakStartTime = $clockInTime->copy()->addHours(rand(3, 5))->addMinutes(rand(0, 30));
        WorkHour::create([
            'user_id' => $userId,
            'badge_id' => 'EMP'.str_pad((string) $userId, 4, '0', STR_PAD_LEFT),
            'date' => $date->toDateString(),
            'time' => $breakStartTime,
            'type' => WorkHour::TYPE_BREAK_START,
            'notes' => rand(1, 100) <= 10 ? 'Lunch break' : null,
>>>>>>> cda86dd (.)
        ]);

        // Break end (30-60 minutes later)
        $breakEndTime = $breakStartTime->copy()->addMinutes(rand(30, 60));
        WorkHour::create([
<<<<<<< HEAD
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
=======
            'user_id' => $userId,
            'badge_id' => 'EMP'.str_pad((string) $userId, 4, '0', STR_PAD_LEFT),
            'date' => $date->toDateString(),
            'time' => $breakEndTime,
            'type' => WorkHour::TYPE_BREAK_END,
            'notes' => rand(1, 100) <= 10 ? 'Back from lunch' : null,
        ]);

        // Clock out (5:00-7:00 PM)
        $clockOutTime = $breakEndTime->copy()->addHours(rand(3, 5))->addMinutes(rand(0, 30));
        WorkHour::create([
            'user_id' => $userId,
            'badge_id' => 'EMP'.str_pad((string) $userId, 4, '0', STR_PAD_LEFT),
            'date' => $date->toDateString(),
            'time' => $clockOutTime,
            'type' => WorkHour::TYPE_CLOCK_OUT,
            'notes' => rand(1, 100) <= 20 ? 'End of work day' : null,
>>>>>>> cda86dd (.)
        ]);
    }

    /**
     * Create some incomplete work days for testing.
<<<<<<< HEAD
     */
    /**
     * @param \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\User> $users
     */
    private function createIncompleteWorkDays(Collection $users): void
    {
        foreach ($users as $user) {
            if (!$user instanceof \Modules\User\Models\User) {
                continue;
            }
            $today = Carbon::today();

            $userId = $user->id;
            if (!is_int($userId) && !is_string($userId)) {
                continue;
            }
            
            // User who clocked in but didn't clock out
            WorkHour::create([
                'employee_id' => (int) $userId,
                'timestamp' => $today->copy()->setTime(8, 30, 0),
                'type' => 'clock_in',
                'notes' => 'Current work session',
                'status' => 'pending',
            ]);

            // User on break yesterday
            $yesterday = Carbon::yesterday();
            WorkHour::create([
                'employee_id' => (int) $userId,
                'timestamp' => $yesterday->copy()->setTime(8, 0, 0),
                'type' => 'clock_in',
                'status' => 'approved',
            ]);

            WorkHour::create([
                'employee_id' => (int) $userId,
                'timestamp' => $yesterday->copy()->setTime(12, 0, 0),
                'type' => 'break_start',
                'notes' => 'Extended lunch break',
                'status' => 'pending',
=======
     *
     * @param  \Illuminate\Support\Collection<int, User>  $users
     */
    private function createIncompleteWorkDays($users): void
    {
        foreach ($users as $user) {
            $today = Carbon::today();

            // User who clocked in but didn't clock out
            WorkHour::create([
                'user_id' => $user->id,
                'badge_id' => 'EMP'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                'date' => $today->toDateString(),
                'time' => $today->copy()->setTime(8, 30, 0),
                'type' => WorkHour::TYPE_CLOCK_IN,
                'notes' => 'Current work session',
            ]);

            // User on break
            $yesterday = Carbon::yesterday();
            WorkHour::create([
                'user_id' => $user->id,
                'badge_id' => 'EMP'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                'date' => $yesterday->toDateString(),
                'time' => $yesterday->copy()->setTime(8, 0, 0),
                'type' => WorkHour::TYPE_CLOCK_IN,
            ]);

            WorkHour::create([
                'user_id' => $user->id,
                'badge_id' => 'EMP'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                'date' => $yesterday->toDateString(),
                'time' => $yesterday->copy()->setTime(12, 0, 0),
                'type' => WorkHour::TYPE_BREAK_START,
                'notes' => 'Extended lunch break',
>>>>>>> cda86dd (.)
            ]);
        }
    }
}
