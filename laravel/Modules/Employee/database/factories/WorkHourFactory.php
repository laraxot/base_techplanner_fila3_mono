<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Models\Employee;
=======
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
>>>>>>> cda86dd (.)

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employee\Models\WorkHour>
 */
class WorkHourFactory extends Factory
{
    /**
<<<<<<< HEAD
     * @var class-string<\Modules\Employee\Models\WorkHour>
=======
     * The name of the factory's corresponding model.
     *
     * @var string
>>>>>>> cda86dd (.)
     */
    protected $model = WorkHour::class;

    /**
<<<<<<< HEAD
=======
     * Define the model's default state.
     *
>>>>>>> cda86dd (.)
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $timestamp = $this->faker->dateTimeBetween('-30 days', 'now');
<<<<<<< HEAD
        $hour = $this->faker->numberBetween(8, 18);
        $minute = $this->faker->randomElement([0, 15, 30, 45]);
        $carbonTimestamp = Carbon::instance($timestamp)->setTime(
            is_int($hour) ? $hour : (int) $hour,
            is_int($minute) ? $minute : (int) $minute,
            0
        );
        
        return [
            'employee_id' => Employee::factory(),
            'type' => $this->faker->randomElement(WorkHourTypeEnum::values()),
=======
        $carbonTimestamp = Carbon::instance($timestamp)->setTime(
            $this->faker->numberBetween(8, 18), // Hour between 8 AM and 6 PM
            $this->faker->randomElement([0, 15, 30, 45]), // Minutes in 15-minute intervals
            0 // Seconds
        );

        return [
            'employee_id' => Employee::factory(),
            'type' => $this->faker->randomElement(WorkHour::TYPES),
>>>>>>> cda86dd (.)
            'timestamp' => $carbonTimestamp,
            'location_lat' => $this->faker->optional(0.3)->latitude(),
            'location_lng' => $this->faker->optional(0.3)->longitude(),
            'location_name' => $this->faker->optional(0.3)->address(),
            'device_info' => $this->faker->optional(0.2)->randomElements([
                'device_type' => 'mobile',
                'browser' => $this->faker->userAgent(),
                'ip_address' => $this->faker->ipv4(),
            ]),
            'photo_path' => $this->faker->optional(0.1)->imageUrl(),
            'notes' => $this->faker->optional(0.3)->sentence(),
<<<<<<< HEAD
            'status' => $this->faker->randomElement(WorkHourStatusEnum::values()),
=======
            'status' => $this->faker->randomElement(WorkHour::STATUSES),
>>>>>>> cda86dd (.)
            'approved_by' => $this->faker->optional(0.4)->numberBetween(1, 10),
            'approved_at' => $this->faker->optional(0.4)->dateTimeBetween('-7 days', 'now'),
        ];
    }

    /**
<<<<<<< HEAD
     * Create a sequence of work hours for a full work day.
     *
     * @param int $employeeId
     * @param Carbon $date
     * @return array<int, \Modules\Employee\Models\WorkHour>
=======
     * Create a realistic work day sequence for an employee.
     *
     * @return array<WorkHour>
>>>>>>> cda86dd (.)
     */
    public function workDaySequence(int $employeeId, Carbon $date): array
    {
        $entries = [];
<<<<<<< HEAD
        
        $clockInTime = $date->copy()->setTime(
            (int) $this->faker->numberBetween(8, 9),
            (int) $this->faker->randomElement([0, 15, 30, 45]),
            0
        );
        
        /** @var \Modules\Employee\Models\WorkHour $clockIn */
        $clockIn = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockInTime,
            'type' => WorkHourTypeEnum::CLOCK_IN->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();
        $entries[] = $clockIn;

        $breakStartTime = $clockInTime->copy()->addHours((int) $this->faker->numberBetween(3, 5));
        /** @var \Modules\Employee\Models\WorkHour $breakStart */
        $breakStart = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakStartTime,
            'type' => WorkHourTypeEnum::BREAK_START->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();
        $entries[] = $breakStart;

        $breakEndTime = $breakStartTime->copy()->addMinutes((int) $this->faker->numberBetween(30, 60));
        /** @var \Modules\Employee\Models\WorkHour $breakEnd */
        $breakEnd = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakEndTime,
            'type' => WorkHourTypeEnum::BREAK_END->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();
        $entries[] = $breakEnd;

        $clockOutTime = $breakEndTime->copy()->addHours((int) $this->faker->numberBetween(3, 5));
        /** @var \Modules\Employee\Models\WorkHour $clockOut */
        $clockOut = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockOutTime,
            'type' => WorkHourTypeEnum::CLOCK_OUT->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();
        $entries[] = $clockOut;
=======

        // Clock in (8:00-9:30 AM)
        $clockInTime = $date->copy()->setTime(
            $this->faker->numberBetween(8, 9),
            $this->faker->randomElement([0, 15, 30, 45])
        );

        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockInTime,
            'type' => WorkHour::TYPE_CLOCK_IN,
            'status' => WorkHour::STATUS_APPROVED,
        ])->make();

        // Break start (12:00-1:00 PM)
        $breakStartTime = $clockInTime->copy()->addHours($this->faker->numberBetween(3, 5));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakStartTime,
            'type' => WorkHour::TYPE_BREAK_START,
            'status' => WorkHour::STATUS_APPROVED,
        ])->make();

        // Break end (30-60 minutes later)
        $breakEndTime = $breakStartTime->copy()->addMinutes($this->faker->numberBetween(30, 60));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakEndTime,
            'type' => WorkHour::TYPE_BREAK_END,
            'status' => WorkHour::STATUS_APPROVED,
        ])->make();

        // Clock out (5:00-7:00 PM)
        $clockOutTime = $breakEndTime->copy()->addHours($this->faker->numberBetween(3, 5));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockOutTime,
            'type' => WorkHour::TYPE_CLOCK_OUT,
            'status' => WorkHour::STATUS_APPROVED,
        ])->make();
>>>>>>> cda86dd (.)

        return $entries;
    }

<<<<<<< HEAD
    public function clockIn(): static
    {
        return $this->state([
            'type' => 'clock_in',
            'timestamp' => $this->faker->dateTimeBetween('08:00', '09:30'),
        ]);
    }

    public function clockOut(): static
    {
        return $this->state([
            'type' => 'clock_out',
            'timestamp' => $this->faker->dateTimeBetween('17:00', '19:00'),
        ]);
    }

    public function breakStart(): static
    {
        return $this->state([
            'type' => 'break_start',
            'timestamp' => $this->faker->dateTimeBetween('12:00', '14:00'),
        ]);
    }

    public function breakEnd(): static
    {
        return $this->state([
            'type' => 'break_end',
            'timestamp' => $this->faker->dateTimeBetween('13:00', '14:00'),
        ]);
    }

=======
    /**
     * Create a clock in entry.
     */
    public function clockIn(): static
    {
        return $this->state([
            'type' => WorkHour::TYPE_CLOCK_IN,
            'time' => $this->faker->dateTimeBetween('08:00', '09:30'),
        ]);
    }

    /**
     * Create a clock out entry.
     */
    public function clockOut(): static
    {
        return $this->state([
            'type' => WorkHour::TYPE_CLOCK_OUT,
            'time' => $this->faker->dateTimeBetween('17:00', '19:00'),
        ]);
    }

    /**
     * Create a break start entry.
     */
    public function breakStart(): static
    {
        return $this->state([
            'type' => WorkHour::TYPE_BREAK_START,
            'time' => $this->faker->dateTimeBetween('12:00', '14:00'),
        ]);
    }

    /**
     * Create a break end entry.
     */
    public function breakEnd(): static
    {
        return $this->state([
            'type' => WorkHour::TYPE_BREAK_END,
            'time' => $this->faker->dateTimeBetween('12:30', '14:30'),
        ]);
    }

    /**
     * Create entries for today.
     */
>>>>>>> cda86dd (.)
    public function today(): static
    {
        return $this->state([
            'date' => Carbon::today()->toDateString(),
<<<<<<< HEAD
            'timestamp' => Carbon::now(),
        ]);
    }

=======
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Create entries for a specific date.
     */
>>>>>>> cda86dd (.)
    public function forDate(Carbon $date): static
    {
        return $this->state([
            'date' => $date->toDateString(),
<<<<<<< HEAD
            'timestamp' => $date->copy()->setTime(
                (int) $this->faker->numberBetween(8, 18),
                (int) $this->faker->randomElement([0, 15, 30, 45]),
                0
=======
            'time' => $date->copy()->setTime(
                $this->faker->numberBetween(8, 18),
                $this->faker->randomElement([0, 15, 30, 45])
>>>>>>> cda86dd (.)
            ),
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Create entries with notes.
     */
>>>>>>> cda86dd (.)
    public function withNotes(): static
    {
        return $this->state([
            'notes' => $this->faker->sentence(),
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Create entries with badge ID.
     */
>>>>>>> cda86dd (.)
    public function withBadge(): static
    {
        return $this->state([
            'badge_id' => $this->faker->numerify('EMP####'),
        ]);
    }
}
