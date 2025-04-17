<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = [
        'client_id',
        'date',
        'notes',
    ];

    /**
     * Relazione con il cliente.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relazione con le macchine controllate.
     */
    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class);
    }
}
