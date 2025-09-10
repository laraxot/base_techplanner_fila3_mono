<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Models\Employee;
=======
>>>>>>> cda86dd (.)

/**
 * Class WorkHour.
 *
 * @property int $id
 * @property int $employee_id
 * @property string $type
 * @property Carbon $timestamp
 * @property float|null $location_lat
 * @property float|null $location_lng
 * @property string|null $location_name
<<<<<<< HEAD
 * @property array<string, mixed>|null $device_info
=======
 * @property array|null $device_info
>>>>>>> cda86dd (.)
 * @property string|null $photo_path
 * @property string|null $notes
 * @property string $status
 * @property int|null $approved_by
 * @property Carbon|null $approved_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Employee $employee
 * @property-read \Modules\User\Models\User|null $approvedBy
<<<<<<< HEAD
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read string $formatted_date
 * @property-read string $formatted_date_time
 * @property-read string $formatted_time
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static Builder<static>|WorkHour forDate(\Carbon\Carbon $date)
 * @method static Builder<static>|WorkHour forEmployee(int $employeeId)
 * @method static Builder<static>|WorkHour newModelQuery()
 * @method static Builder<static>|WorkHour newQuery()
 * @method static Builder<static>|WorkHour ofType(string $type)
 * @method static Builder<static>|WorkHour query()
 * @method static Builder<static>|WorkHour today()
 * @method static Builder<static>|WorkHour whereApprovedAt($value)
 * @method static Builder<static>|WorkHour whereApprovedBy($value)
 * @method static Builder<static>|WorkHour whereCreatedAt($value)
 * @method static Builder<static>|WorkHour whereDeviceInfo($value)
 * @method static Builder<static>|WorkHour whereEmployeeId($value)
 * @method static Builder<static>|WorkHour whereId($value)
 * @method static Builder<static>|WorkHour whereLocationLat($value)
 * @method static Builder<static>|WorkHour whereLocationLng($value)
 * @method static Builder<static>|WorkHour whereLocationName($value)
 * @method static Builder<static>|WorkHour whereNotes($value)
 * @method static Builder<static>|WorkHour wherePhotoPath($value)
 * @method static Builder<static>|WorkHour whereStatus($value)
 * @method static Builder<static>|WorkHour whereTimestamp($value)
 * @method static Builder<static>|WorkHour whereType($value)
 * @method static Builder<static>|WorkHour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkHour extends BaseModel
{
    public const TYPES = [
        WorkHourTypeEnum::CLOCK_IN->value,
        WorkHourTypeEnum::CLOCK_OUT->value,
        WorkHourTypeEnum::BREAK_START->value,
        WorkHourTypeEnum::BREAK_END->value,
    ];

    public const STATUSES = [
        'pending',
        'approved',
        'rejected',
=======
 */
class WorkHour extends BaseModel
{
    public const TYPE_CLOCK_IN = 'clock_in';

    public const TYPE_CLOCK_OUT = 'clock_out';

    public const TYPE_BREAK_START = 'break_start';

    public const TYPE_BREAK_END = 'break_end';

    public const TYPES = [
        self::TYPE_CLOCK_IN,
        self::TYPE_CLOCK_OUT,
        self::TYPE_BREAK_START,
        self::TYPE_BREAK_END,
    ];

    public const STATUS_PENDING = 'pending';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
>>>>>>> cda86dd (.)
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $table = 'work_hours';
=======
    protected $table = 'time_entries';
>>>>>>> cda86dd (.)

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'employee_id',
        'type',
        'timestamp',
        'location_lat',
        'location_lng',
        'location_name',
        'device_info',
        'photo_path',
        'notes',
        'status',
        'approved_by',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'timestamp' => 'datetime',
            'location_lat' => 'decimal:8',
            'location_lng' => 'decimal:8',
            'device_info' => 'array',
            'approved_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
<<<<<<< HEAD
            'type' => \Modules\Employee\Enums\WorkHourTypeEnum::class,
            'status' => \Modules\Employee\Enums\WorkHourStatusEnum::class,
=======
>>>>>>> cda86dd (.)
        ];
    }

    /**
     * Get the employee that owns the work hour record.
     *
<<<<<<< HEAD
     * @return BelongsTo<Employee, $this>
=======
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\Employee\Models\Employee, \Modules\Employee\Models\WorkHour>
>>>>>>> cda86dd (.)
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the user who approved the time entry.
     *
<<<<<<< HEAD
     * @return BelongsTo<\Modules\User\Models\User, $this>
=======
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\WorkHour>
>>>>>>> cda86dd (.)
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\User\Models\User::class, 'approved_by');
    }

    /**
     * Scope a query to only include work hours for a specific employee.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param int $employeeId
=======
     * @param  \Illuminate\Database\Eloquent\Builder<static>  $query
>>>>>>> cda86dd (.)
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForEmployee(Builder $query, int $employeeId): Builder
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope a query to only include work hours of a specific type.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param string $type
=======
     * @param  \Illuminate\Database\Eloquent\Builder<static>  $query
>>>>>>> cda86dd (.)
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include work hours for a specific date.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param Carbon $date
=======
     * @param  \Illuminate\Database\Eloquent\Builder<static>  $query
>>>>>>> cda86dd (.)
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForDate(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('timestamp', $date);
    }

    /**
     * Scope a query to only include work hours for today.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
=======
     * @param  \Illuminate\Database\Eloquent\Builder<static>  $query
>>>>>>> cda86dd (.)
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('timestamp', Carbon::today());
    }

    /**
     * Get the formatted time.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> cda86dd (.)
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->timestamp->format('H:i:s');
    }

    /**
     * Get the formatted date.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> cda86dd (.)
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->timestamp->format('d/m/Y');
    }

    /**
     * Get the formatted date and time.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> cda86dd (.)
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->timestamp->format('d/m/Y H:i:s');
    }

    /**
     * Check if the work hour is a clock in.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isClockIn(): bool
    {
        return $this->type === WorkHourTypeEnum::CLOCK_IN->value;
=======
     */
    public function isClockIn(): bool
    {
        return $this->type === self::TYPE_CLOCK_IN;
>>>>>>> cda86dd (.)
    }

    /**
     * Check if the work hour is a clock out.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isClockOut(): bool
    {
        return $this->type === WorkHourTypeEnum::CLOCK_OUT->value;
=======
     */
    public function isClockOut(): bool
    {
        return $this->type === self::TYPE_CLOCK_OUT;
>>>>>>> cda86dd (.)
    }

    /**
     * Check if the work hour is a break start.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isBreakStart(): bool
    {
        return $this->type === WorkHourTypeEnum::BREAK_START->value;
=======
     */
    public function isBreakStart(): bool
    {
        return $this->type === self::TYPE_BREAK_START;
>>>>>>> cda86dd (.)
    }

    /**
     * Check if the work hour is a break end.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isBreakEnd(): bool
    {
        return $this->type === WorkHourTypeEnum::BREAK_END->value;
=======
     */
    public function isBreakEnd(): bool
    {
        return $this->type === self::TYPE_BREAK_END;
>>>>>>> cda86dd (.)
    }

    /**
     * Get the last work hour entry for an employee on a specific date.
<<<<<<< HEAD
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return WorkHour|null
=======
>>>>>>> cda86dd (.)
     */
    public static function getLastEntryForEmployee(int $employeeId, ?Carbon $date = null): ?WorkHour
    {
        $date = $date ?? Carbon::today();
<<<<<<< HEAD
        
=======

>>>>>>> cda86dd (.)
        return static::forEmployee($employeeId)
            ->forDate($date)
            ->orderBy('timestamp', 'desc')
            ->first();
    }

    /**
     * Get the next expected action for an employee based on their last entry.
<<<<<<< HEAD
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
=======
>>>>>>> cda86dd (.)
     */
    public static function getNextAction(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (! $lastEntry) {
<<<<<<< HEAD
            return WorkHourTypeEnum::CLOCK_IN->value;
        }

        return match ($lastEntry->type) {
            WorkHourTypeEnum::CLOCK_IN->value => WorkHourTypeEnum::BREAK_START->value,
            WorkHourTypeEnum::BREAK_START->value => WorkHourTypeEnum::BREAK_END->value,
            WorkHourTypeEnum::BREAK_END->value => WorkHourTypeEnum::CLOCK_OUT->value,
            WorkHourTypeEnum::CLOCK_OUT->value => WorkHourTypeEnum::CLOCK_IN->value,
            default => WorkHourTypeEnum::CLOCK_IN->value,
=======
            return self::TYPE_CLOCK_IN;
        }

        return match ($lastEntry->type) {
            self::TYPE_CLOCK_IN => self::TYPE_BREAK_START,
            self::TYPE_BREAK_START => self::TYPE_BREAK_END,
            self::TYPE_BREAK_END => self::TYPE_CLOCK_OUT,
            self::TYPE_CLOCK_OUT => self::TYPE_CLOCK_IN,
            default => self::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
        };
    }

    /**
     * Validate if a new entry is allowed based on the last entry.
<<<<<<< HEAD
     *
     * @param int $employeeId
     * @param string $type
     * @param Carbon|null $date
     * @return bool
=======
>>>>>>> cda86dd (.)
     */
    public static function isValidNextEntry(int $employeeId, string $type, ?Carbon $date = null): bool
    {
        $expectedAction = static::getNextAction($employeeId, $date);
<<<<<<< HEAD
=======

>>>>>>> cda86dd (.)
        return $expectedAction === $type;
    }

    /**
     * Get all work hours for an employee on a specific date.
     *
<<<<<<< HEAD
     * @param int $employeeId
     * @param Carbon|null $date
=======
>>>>>>> cda86dd (.)
     * @return \Illuminate\Database\Eloquent\Collection<int, WorkHour>
     */
    public static function getTodayEntries(int $employeeId, ?Carbon $date = null): \Illuminate\Database\Eloquent\Collection
    {
        $date = $date ?? Carbon::today();
<<<<<<< HEAD
        
=======

>>>>>>> cda86dd (.)
        return static::forEmployee($employeeId)
            ->forDate($date)
            ->orderBy('timestamp', 'asc')
            ->get();
    }

    /**
     * Calculate total worked hours for an employee on a specific date.
     *
<<<<<<< HEAD
     * @param int $employeeId
     * @param Carbon|null $date
=======
>>>>>>> cda86dd (.)
     * @return float Hours worked
     */
    public static function calculateWorkedHours(int $employeeId, ?Carbon $date = null): float
    {
        $entries = static::getTodayEntries($employeeId, $date);
<<<<<<< HEAD
        
=======

>>>>>>> cda86dd (.)
        if ($entries->isEmpty()) {
            return 0.0;
        }

        $totalMinutes = 0;
        $clockInTime = null;
<<<<<<< HEAD

        /** @var WorkHour $entry */
        foreach ($entries as $entry) {
            if (!($entry instanceof WorkHour)) {
                continue;
            }
            switch ($entry->type) {
                case WorkHourTypeEnum::CLOCK_IN->value:
                    $clockInTime = $entry->timestamp;
                    break;

                case WorkHourTypeEnum::BREAK_START->value:
                    if ($clockInTime) {
                        $totalMinutes += $clockInTime->diffInMinutes($entry->timestamp);
                    }
                    $clockInTime = null;
                    break;

                case WorkHourTypeEnum::BREAK_END->value:
                    $clockInTime = $entry->timestamp; // Resume work
                    break;

                case WorkHourTypeEnum::CLOCK_OUT->value:
=======
        $breakStartTime = null;

        foreach ($entries as $entry) {
            switch ($entry->type) {
                case self::TYPE_CLOCK_IN:
                    $clockInTime = $entry->timestamp;
                    break;

                case self::TYPE_BREAK_START:
                    if ($clockInTime) {
                        $totalMinutes += $clockInTime->diffInMinutes($entry->timestamp);
                    }
                    $breakStartTime = $entry->timestamp;
                    break;

                case self::TYPE_BREAK_END:
                    $clockInTime = $entry->timestamp; // Resume work
                    break;

                case self::TYPE_CLOCK_OUT:
>>>>>>> cda86dd (.)
                    if ($clockInTime) {
                        $totalMinutes += $clockInTime->diffInMinutes($entry->timestamp);
                        $clockInTime = null;
                    }
                    break;
            }
        }

        return round($totalMinutes / 60, 2);
    }

    /**
     * Get the current status for an employee.
<<<<<<< HEAD
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
=======
>>>>>>> cda86dd (.)
     */
    public static function getCurrentStatus(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (! $lastEntry) {
            return 'not_clocked_in';
        }

        return match ($lastEntry->type) {
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'clocked_in',
            WorkHourTypeEnum::BREAK_START->value => 'on_break',
            WorkHourTypeEnum::BREAK_END->value => 'clocked_in',
            WorkHourTypeEnum::CLOCK_OUT->value => 'clocked_out',
            default => 'not_clocked_in',
        };
    }
}
=======
            self::TYPE_CLOCK_IN => 'clocked_in',
            self::TYPE_BREAK_START => 'on_break',
            self::TYPE_BREAK_END => 'clocked_in',
            self::TYPE_CLOCK_OUT => 'clocked_out',
            default => 'not_clocked_in',
        };
    }
}
>>>>>>> cda86dd (.)
