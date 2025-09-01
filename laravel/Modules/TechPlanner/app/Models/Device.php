<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Device.
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $device_type
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $headset_serial
 * @property string|null $tube_serial
 * @property string|null $power_kv
 * @property string|null $current_ma
 * @property \Carbon\Carbon|null $first_verification_date
 * @property string|null $notes
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property Client $client
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\DeviceVerification[] $verifications
 */
class Device extends BaseModel
{
    protected $table = 'machines';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'first_verification_date' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected $fillable = [
        'id', // IDApparecchio
        'client_id', // IDCliente
        'type', // TipoApparecchio
        'brand', // Marca
        'model', // Modello
        'headset_serial', // Matricola Cuffia
        'tube_serial', // Matricola Tubo
        'kv', // KV
        'ma', // ma
        'first_verification_date', // DataPrimaVerifica
        'notes', // Commenti
    ];

    /**
     * Get the client that owns the device.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get all verifications for this device.
     */
    public function verifications(): HasMany
    {
        return $this->hasMany(DeviceVerification::class);
    }

    /**
     * Get the latest verification for this device.
     */
    public function getLatestVerificationAttribute(): ?DeviceVerification
    {
        return $this->verifications()->latest()->first() instanceof DeviceVerification
            ? $this->verifications()->latest()->first()
            : null;
    }

    /**
     * Check if the device needs verification.
     */
    public function getNeedsVerificationAttribute(): bool
    {
        if (! $this->latest_verification) {
            return true;
        }

        // Verifica se la data di prossima verifica è passata
        $nextVerificationDate = $this->latest_verification->getAttribute('next_verification_date');
        if (! $nextVerificationDate) {
            return true;
        }

        return $nextVerificationDate <= now();
    }
}
