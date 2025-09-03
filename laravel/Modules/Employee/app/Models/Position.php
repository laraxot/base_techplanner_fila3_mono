<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Position.
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $level
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Employee\Models\Employee> $employees
 */
class Position extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'level',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the employees for this position.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\Modules\Employee\Models\Employee>
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Scope a query to only include active positions.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'attivo');
    }

    /**
     * Check if the position is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === 'attivo';
    }

    /**
     * Get the position level as a human-readable string.
     *
     * @return string
     */
    public function getLevelLabelAttribute(): string
    {
        return match ($this->level) {
            'entry' => 'Entry Level',
            'junior' => 'Junior',
            'senior' => 'Senior',
            'lead' => 'Lead',
            'manager' => 'Manager',
            'director' => 'Director',
            'executive' => 'Executive',
            default => ucfirst($this->level),
        };
    }
}
