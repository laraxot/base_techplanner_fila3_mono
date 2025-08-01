<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Models\User;

/**
 * Class Timbratura.
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon $data_timbratura
 * @property string $tipo
 * @property string $metodo
 * @property string|null $latitudine
 * @property string|null $longitudine
 * @property string|null $indirizzo
 * @property string|null $note
 * @property string $stato
 * @property bool $is_manuale
=======
use Modules\User\Models\User;

/**
 * Class TimeRecord.
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon $timestamp
 * @property string $type
 * @property string $method
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $address
 * @property string|null $notes
 * @property string $status
 * @property bool $is_manual
>>>>>>> origin/dev
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read User|null $createdBy
 * @property-read User|null $updatedBy
 */
<<<<<<< HEAD
class Timbratura extends BaseModel
=======
class TimeRecord extends BaseModel
>>>>>>> origin/dev
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
<<<<<<< HEAD
        'data_timbratura',
        'tipo',
        'metodo',
        'latitudine',
        'longitudine',
        'indirizzo',
        'note',
        'stato',
        'is_manuale',
=======
        'timestamp',
        'type',
        'method',
        'latitude',
        'longitude',
        'address',
        'notes',
        'status',
        'is_manual',
>>>>>>> origin/dev
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
<<<<<<< HEAD
            'data_timbratura' => 'datetime',
            'is_manuale' => 'boolean',
=======
            'timestamp' => 'datetime',
            'is_manual' => 'boolean',
>>>>>>> origin/dev
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the timbratura.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
=======
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
>>>>>>> origin/dev
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that created the timbratura.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
=======
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
>>>>>>> origin/dev
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that updated the timbratura.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
=======
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
>>>>>>> origin/dev
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
<<<<<<< HEAD
     * Scope a query to only include timbrature for a specific user.
=======
     * Scope a query to only include time records for a specific user.
>>>>>>> origin/dev
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
<<<<<<< HEAD
     * Scope a query to only include timbrature of a specific type.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param string $tipo
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeOfType($query, string $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope a query to only include timbrature for a specific date.
=======
     * Scope a query to only include time records of a specific type.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include time records for a specific date.
>>>>>>> origin/dev
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForDate($query, Carbon $date)
    {
<<<<<<< HEAD
        return $query->whereDate('data_timbratura', $date);
    }

    /**
     * Scope a query to only include valid timbrature.
=======
        return $query->whereDate('timestamp', $date);
    }

    /**
     * Scope a query to only include valid time records.
>>>>>>> origin/dev
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeValid($query)
    {
<<<<<<< HEAD
        return $query->where('stato', 'valida');
    }

    /**
     * Get the formatted data timbratura.
     *
     * @return string
     */
    public function getFormattedDataTimbraturaAttribute(): string
    {
        return $this->data_timbratura->format('d/m/Y H:i:s');
=======
        return $query->where('status', 'valid');
    }

    /**
     * Get the formatted timestamp.
     *
     * @return string
     */
    public function getFormattedTimestampAttribute(): string
    {
        return $this->timestamp->format('d/m/Y H:i:s');
>>>>>>> origin/dev
    }

    /**
     * Get the formatted time only.
     *
     * @return string
     */
    public function getFormattedTimeAttribute(): string
    {
<<<<<<< HEAD
        return $this->data_timbratura->format('H:i:s');
=======
        return $this->timestamp->format('H:i:s');
>>>>>>> origin/dev
    }

    /**
     * Get the formatted date only.
     *
     * @return string
     */
    public function getFormattedDateAttribute(): string
    {
<<<<<<< HEAD
        return $this->data_timbratura->format('d/m/Y');
    }

    /**
     * Check if the timbratura is an entry.
=======
        return $this->timestamp->format('d/m/Y');
    }

    /**
     * Check if the time record is an entry.
>>>>>>> origin/dev
     *
     * @return bool
     */
    public function isEntry(): bool
    {
<<<<<<< HEAD
        return $this->tipo === 'entrata';
    }

    /**
     * Check if the timbratura is an exit.
=======
        return $this->type === 'entry';
    }

    /**
     * Check if the time record is an exit.
>>>>>>> origin/dev
     *
     * @return bool
     */
    public function isExit(): bool
    {
<<<<<<< HEAD
        return $this->tipo === 'uscita';
    }

    /**
     * Check if the timbratura is manual.
=======
        return $this->type === 'exit';
    }

    /**
     * Check if the time record is manual.
>>>>>>> origin/dev
     *
     * @return bool
     */
    public function isManual(): bool
    {
<<<<<<< HEAD
        return $this->is_manuale;
    }

    /**
     * Check if the timbratura has location data.
=======
        return $this->is_manual;
    }

    /**
     * Check if the time record has location data.
>>>>>>> origin/dev
     *
     * @return bool
     */
    public function hasLocation(): bool
    {
<<<<<<< HEAD
        return !empty($this->latitudine) && !empty($this->longitudine);
=======
        return !empty($this->latitude) && !empty($this->longitude);
>>>>>>> origin/dev
    }
} 