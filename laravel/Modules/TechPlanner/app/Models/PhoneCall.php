<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

class PhoneCall extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'client_id',
        'date',
        'duration',
        'notes',
        'call_type',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
