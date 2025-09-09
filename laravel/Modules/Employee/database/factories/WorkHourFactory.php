<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Models\Employee;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Enums\WorkHourStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employee\Models\WorkHour>
 */
class WorkHourFactory extends Factory
{
    /**
     * @var class-string<\Modules\Employee\Models\WorkHour>
     */
    protected $model = WorkHour::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $timestamp = $this->faker->dateTimeBetween('-30 days', 'now');
        $carbonTimestamp = Carbon::instance($timestamp)->setTime(
            (int) $this->faker->numberBetween(8, 18),
            (int) $this->faker->randomElement([0, 15, 30, 45]),
            0
        );
        
        return [
            'employee_id' => Employee::factory(),
            'type' => $this->faker->randomElement(WorkHourTypeEnum::values()),
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
            'status' => $this->faker->randomElement(WorkHourStatusEnum::values()),
            'approved_by' => $this->faker->optional(0.4)->numberBetween(1, 10),
            'approved_at' => $this->faker->optional(0.4)->dateTimeBetween('-7 days', 'now'),
        ];
    }

    /**
     * @param int $employeeId
     * @param Carbon $date
     * @return array<int, WorkHour>
     */
    public function workDaySequence(int $employeeId, Carbon $date): array
    {
        $entries = [];
        
        $clockInTime = $date->copy()->setTime(
            (int) $this->faker->numberBetween(8, 9),
            (int) $this->faker->randomElement([0, 15, 30, 45]),
            0
        );
        
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockInTime,
            'type' => WorkHourTypeEnum::CLOCK_IN->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();

        $breakStartTime = $clockInTime->copy()->addHours((int) $this->faker->numberBetween(3, 5));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakStartTime,
            'type' => WorkHourTypeEnum::BREAK_START->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();

        $breakEndTime = $breakStartTime->copy()->addMinutes((int) $this->faker->numberBetween(30, 60));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $breakEndTime,
            'type' => WorkHourTypeEnum::BREAK_END->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();

        $clockOutTime = $breakEndTime->copy()->addHours((int) $this->faker->numberBetween(3, 5));
        $entries[] = $this->state([
            'employee_id' => $employeeId,
            'timestamp' => $clockOutTime,
            'type' => WorkHourTypeEnum::CLOCK_OUT->value,
            'status' => WorkHourStatusEnum::APPROVED->value,
        ])->make();

        /** @var array<int, WorkHour> $entries */
        return $entries;
    }

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

    public function today(): static
    {
        return $this->state([
            'date' => Carbon::today()->toDateString(),
            'timestamp' => Carbon::now(),
        ]);
    }

    public function forDate(Carbon $date): static
    {
        return $this->state([
            'date' => $date->toDateString(),
            'timestamp' => $date->copy()->setTime(
                (int) $this->faker->numberBetween(8, 18),
                (int) $this->faker->randomElement([0, 15, 30, 45]),
                0
            ),
        ]);
    }

    public function withNotes(): static
    {
        return $this->state([
            'notes' => $this->faker->sentence(),
        ]);
    }

    public function withBadge(): static
    {
        return $this->state([
            'badge_id' => $this->faker->numerify('EMP####'),
        ]);
    }
}