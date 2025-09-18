<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * @property int $id
 * @property int $client_id
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $duration
 * @property string|null $notes
 * @property string $call_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereCallType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhoneCall whereUpdatedBy($value)
 * @mixin \Eloquent
 */
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
    #[\Override]
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'date' => 'datetime',
        ]);
    }
}
