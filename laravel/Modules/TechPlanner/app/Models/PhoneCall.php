<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

class PhoneCall extends BaseModel
{
    protected $fillable = [
        'client_id',
        'date',
        'duration',
        'notes',
        'call_type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'date' => 'datetime',
        ]);
    }
}
