<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Employee\Models\BaseModel;

/**
 * Class Position.
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $department
 * @property int|null $level
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Employee\Models\Employee> $employees
 * @property-read int|null $employees_count
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
        'department',
        'level',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the employees for the position.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}



