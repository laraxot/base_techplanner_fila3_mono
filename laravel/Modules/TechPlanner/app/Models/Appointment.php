<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $client_id
 * @property string $date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\TechPlanner\Models\Machine> $machines
 * @property-read int|null $machines_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereUpdatedBy($value)
 * @mixin \Eloquent
 */
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
