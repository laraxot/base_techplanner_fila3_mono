<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read User|null $createdBy
 * @property-read User|null $updatedBy
 */
class Timbratura extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'data_timbratura',
        'tipo',
        'metodo',
        'latitudine',
        'longitudine',
        'indirizzo',
        'note',
        'stato',
        'is_manuale',
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
            'data_timbratura' => 'datetime',
            'is_manuale' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the timbratura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that created the timbratura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that updated the timbratura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Timbratura>
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope a query to only include timbrature for a specific user.
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
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeForDate($query, Carbon $date)
    {
        return $query->whereDate('data_timbratura', $date);
    }

    /**
     * Scope a query to only include valid timbrature.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeValid($query)
    {
        return $query->where('stato', 'valid');
    }

    /**
     * Get the formatted data timbratura.
     *
     * @return string
     */
    public function getFormattedDataTimbraturaAttribute(): string
    {
        return $this->data_timbratura->format('d/m/Y H:i:s');
    }

    /**
     * Get the formatted time only.
     *
     * @return string
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->data_timbratura->format('H:i:s');
    }

    /**
     * Get the formatted date only.
     *
     * @return string
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->data_timbratura->format('d/m/Y');
    }

    /**
     * Check if the timbratura is an entry.
     *
     * @return bool
     */
    public function isEntry(): bool
    {
        return $this->tipo === 'entrata';
    }

    /**
     * Check if the timbratura is an exit.
     *
     * @return bool
     */
    public function isExit(): bool
    {
        return $this->tipo === 'uscita';
    }

    /**
     * Check if the timbratura is manual.
     *
     * @return bool
     */
    public function isManual(): bool
    {
        return $this->is_manuale;
    }

    /**
     * Check if the timbratura has location data.
     *
     * @return bool
     */
    public function hasLocation(): bool
    {
        return !empty($this->latitudine) && !empty($this->longitudine);
    }
} 