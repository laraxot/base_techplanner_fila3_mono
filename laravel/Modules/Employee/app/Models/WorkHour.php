<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
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
 * @property array|null $device_info
 * @property string|null $photo_path
 * @property string|null $notes
 * @property string $status
 * @property int|null $approved_by
 * @property Carbon|null $approved_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Employee $employee
 * @property-read \Modules\User\Models\User|null $approvedBy
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
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'time_entries';

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
        ];
    }

    /**
     * Get the employee that owns the work hour record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\Employee\Models\Employee, \Modules\Employee\Models\WorkHour>
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the user who approved the time entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\WorkHour>
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
     * Get the formatted time.
     *
     * @return string
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->timestamp->format('H:i:s');
    }

    /**
     * Get the formatted date.
     *
     * @return string
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->timestamp->format('d/m/Y');
    }

    /**
     * Get the formatted date and time.
     *
     * @return string
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->timestamp->format('d/m/Y H:i:s');
    }

    /**
     * Check if the work hour is a clock in.
     *
     * @return bool
     */
    public function isClockIn(): bool
    {
        return $this->type === self::TYPE_CLOCK_IN;
    }

    /**
     * Check if the work hour is a clock out.
     *
     * @return bool
     */
    public function isClockOut(): bool
    {
        return $this->type === self::TYPE_CLOCK_OUT;
    }

    /**
     * Check if the work hour is a break start.
     *
     * @return bool
     */
    public function isBreakStart(): bool
    {
        return $this->type === self::TYPE_BREAK_START;
    }

    /**
     * Check if the work hour is a break end.
     *
     * @return bool
     */
    public function isBreakEnd(): bool
    {
        return $this->type === self::TYPE_BREAK_END;
    }

    /**
     * Get the last work hour entry for an employee on a specific date.
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return WorkHour|null
     */
    public static function getLastEntryForEmployee(int $employeeId, ?Carbon $date = null): ?WorkHour
    {
        $date = $date ?? Carbon::today();
        
        return static::forEmployee($employeeId)
            ->forDate($date)
            ->orderBy('timestamp', 'desc')
            ->first();
    }

    /**
     * Get the next expected action for an employee based on their last entry.
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
     */
    public static function getNextAction(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (!$lastEntry) {
            return self::TYPE_CLOCK_IN;
        }

        return match ($lastEntry->type) {
            self::TYPE_CLOCK_IN => self::TYPE_BREAK_START,
            self::TYPE_BREAK_START => self::TYPE_BREAK_END,
            self::TYPE_BREAK_END => self::TYPE_CLOCK_OUT,
            self::TYPE_CLOCK_OUT => self::TYPE_CLOCK_IN,
            default => self::TYPE_CLOCK_IN,
        };
    }

    /**
     * Validate if a new entry is allowed based on the last entry.
     *
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
     * Get all work hours for an employee on a specific date.
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return \Illuminate\Database\Eloquent\Collection<int, WorkHour>
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
     * Calculate total worked hours for an employee on a specific date.
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return float Hours worked
     */
    public static function calculateWorkedHours(int $employeeId, ?Carbon $date = null): float
    {
        $entries = static::getTodayEntries($employeeId, $date);
        
        if ($entries->isEmpty()) {
            return 0.0;
        }

        $totalMinutes = 0;
        $clockInTime = null;
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
     *
     * @param int $employeeId
     * @param Carbon|null $date
     * @return string
     */
    public static function getCurrentStatus(int $employeeId, ?Carbon $date = null): string
    {
        $lastEntry = static::getLastEntryForEmployee($employeeId, $date);

        if (!$lastEntry) {
            return 'not_clocked_in';
        }

        return match ($lastEntry->type) {
            self::TYPE_CLOCK_IN => 'clocked_in',
            self::TYPE_BREAK_START => 'on_break',
            self::TYPE_BREAK_END => 'clocked_in',
            self::TYPE_CLOCK_OUT => 'clocked_out',
            default => 'not_clocked_in',
        };
    }
}
