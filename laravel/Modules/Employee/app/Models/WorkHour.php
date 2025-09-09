<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Models\Employee;

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
 * @property array<string, mixed>|null $device_info
 * @property string|null $photo_path
 * @property string|null $notes
 * @property string $status
 * @property int|null $approved_by
 * @property Carbon|null $approved_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Employee $employee
 * @property-read \Modules\User\Models\User|null $approvedBy
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
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work_hours';

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
            'type' => \Modules\Employee\Enums\WorkHourTypeEnum::class,
            'status' => \Modules\Employee\Enums\WorkHourStatusEnum::class,
        ];
    }

    /**
     * Get the employee that owns the work hour record.
     *
     * @return BelongsTo<Employee, $this>
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the user who approved the time entry.
     *
     * @return BelongsTo<\Modules\User\Models\User, $this>
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\User\Models\User::class, 'approved_by');
    }

    /**
     * Scope a query to only include work hours for a specific employee.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param int $employeeId
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForEmployee(Builder $query, int $employeeId): Builder
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope a query to only include work hours of a specific type.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include work hours for a specific date.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForDate(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('timestamp', $date);
    }

    /**
     * Scope a query to only include work hours for today.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('timestamp', Carbon::today());
    }

     /**
     * @return string
     */    public function getFormattedTimeAttribute(): string
    {
        return $this->timestamp->format('H:i:s');
    }

     /**
     * @return string
     */    public function getFormattedDateAttribute(): string
    {
        return $this->timestamp->format('d/m/Y');
    }

     /**
     * @return string
     */    public function getFormattedDateTimeAttribute(): string
    {
        return $this->timestamp->format('d/m/Y H:i:s');
    }

     /** Check if the work hour is a clock in.
     *
     * @return bool
     */    public function isClockIn(): bool
    {
        return $this->type === WorkHourTypeEnum::CLOCK_IN->value;
    }

    public function isClockOut(): bool
    {
        return $this->type === WorkHourTypeEnum::CLOCK_OUT->value;
    }

    public function isBreakStart(): bool
    {
        return $this->type === WorkHourTypeEnum::BREAK_START->value;
    }

    public function isBreakEnd(): bool
    {
        return $this->type === WorkHourTypeEnum::BREAK_END->value;
    }

            public static function getLastEntryForEmployee(int $employeeId, ?Carbon $date = null): ?WorkHour
    {
        $date = $date ?? Carbon::today();
        return static::forEmployee($employeeId)
            ->forDate($date)
            ->orderBy('timestamp', 'desc')
            ->first();
    }

     /**
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
     */    public static function getNextAction(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (! $lastEntry) {
            return WorkHourTypeEnum::CLOCK_IN->value;
        }

        return match ($lastEntry->type) {
            WorkHourTypeEnum::CLOCK_IN->value => WorkHourTypeEnum::BREAK_START->value,
            WorkHourTypeEnum::BREAK_START->value => WorkHourTypeEnum::BREAK_END->value,
            WorkHourTypeEnum::BREAK_END->value => WorkHourTypeEnum::CLOCK_OUT->value,
            WorkHourTypeEnum::CLOCK_OUT->value => WorkHourTypeEnum::CLOCK_IN->value,
            default => WorkHourTypeEnum::CLOCK_IN->value,
        };
    }

    /**
     * @param int $employeeId
     * @param string $type
     * @param Carbon|null $date
     * @return bool
     */    
    public static function isValidNextEntry(int $employeeId, string $type, ?Carbon $date = null): bool
    {
        $expectedAction = static::getNextAction($employeeId, $date);
        return $expectedAction === $type;
    }

    /**
     * @param int $employeeId
     * @param Carbon|null $date     * @return \Illuminate\Database\Eloquent\Collection<int, WorkHour>
     */
    public static function getTodayEntries(int $employeeId, ?Carbon $date = null): \Illuminate\Database\Eloquent\Collection
    {
        $date = $date ?? Carbon::today();
        
        return static::forEmployee($employeeId)
            ->forDate($date)
            ->orderBy('timestamp', 'asc')
            ->get();
    }
     /**
     * @param int $employeeId
     * @param Carbon|null $date
     * @return float Hours worked
     */
    public static function calculateWorkedHours(int $employeeId, ?Carbon $date = null): float
    {
        $entries = static::getTodayEntries($employeeId, $date);
        $totalMinutes = 0;
        $clockInTime = null;

        foreach ($entries as $entry) {
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
                    
            }
        }

        return round($totalMinutes / 60, 2);
    }

     /**
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
     */
    public static function getCurrentStatus(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (! $lastEntry) {
            return "not_clocked_in";
        }

        return match ($lastEntry->type) {
            WorkHourTypeEnum::CLOCK_IN->value => "clocked_in",
            WorkHourTypeEnum::BREAK_START->value => "on_break",
            WorkHourTypeEnum::BREAK_END->value => "clocked_in",
            WorkHourTypeEnum::CLOCK_OUT->value => "clocked_out",
            default => "not_clocked_in",
        };
    }
}
