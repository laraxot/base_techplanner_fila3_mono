<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TimeEntry.
 *
 * @property int $id
 * @property int $employee_id
 * @property Carbon $clock_in
 * @property Carbon|null $clock_out
 * @property Carbon|null $break_start
 * @property Carbon|null $break_end
 * @property int $break_duration
 * @property float|null $total_hours
 * @property float|null $regular_hours
 * @property float|null $overtime_hours
 * @property array<string, mixed>|null $location_in
 * @property array<string, mixed>|null $location_out
 * @property array<string, mixed>|null $device_info
 * @property string|null $notes
 * @property string|null $employee_notes
 * @property string|null $supervisor_notes
 * @property string $status
 * @property int|null $approved_by
 * @property Carbon|null $approved_at
 * @property string|null $rejection_reason
 * @property array<string, mixed>|null $anomalies
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Employee $employee
 * @property-read Employee|null $approvedBy
 */
class TimeEntry extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'employee_id', 'clock_in', 'clock_out', 'break_start', 'break_end',
        'break_duration', 'total_hours', 'regular_hours', 'overtime_hours',
        'location_in', 'location_out', 'device_info', 'notes', 'employee_notes',
        'supervisor_notes', 'status', 'approved_by', 'approved_at',
        'rejection_reason', 'anomalies',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'clock_in' => 'datetime',
            'clock_out' => 'datetime',
            'break_start' => 'datetime',
            'break_end' => 'datetime',
            'break_duration' => 'integer',
            'total_hours' => 'decimal:2',
            'regular_hours' => 'decimal:2',
            'overtime_hours' => 'decimal:2',
            'location_in' => 'array',
            'location_out' => 'array',
            'device_info' => 'array',
            'approved_at' => 'datetime',
            'anomalies' => 'array',
        ];
    }

    /**
     * Get the employee that owns this time entry.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the employee who approved this time entry.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    /**
     * Scope to get pending entries.
     *
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     * @return \Illuminate\Database\Eloquent\Builder<self>
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get entries for a specific employee.
     *
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     * @return \Illuminate\Database\Eloquent\Builder<self>
     */
    public function scopeForEmployee($query, int $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope to get entries with anomalies.
     *
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     * @return \Illuminate\Database\Eloquent\Builder<self>
     */
    public function scopeWithAnomalies($query)
    {
        return $query->whereNotNull('anomalies');
    }

    /**
     * Calculate total hours worked.
     */
    public function calculateTotalHours(): float
    {
        if (!$this->clock_out) {
            return 0.0;
        }

        $totalMinutes = $this->clock_in->diffInMinutes($this->clock_out);
        $totalMinutes -= $this->break_duration;

        return round($totalMinutes / 60, 2);
    }

    /**
     * Check if entry has anomalies.
     */
    public function hasAnomalies(): bool
    {
        return !empty($this->anomalies);
    }

    /**
     * Check if entry is approved.
     */
    public function isApproved(): bool
    {
        return in_array($this->status, ['approved', 'auto_approved']);
    }

    /**
     * Check if entry is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if entry is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
