<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $appointment_id
 * @property string|null $name
 * @property string|null $status
 * @property string|null $notes
 * @property int|null $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $type
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $headset_serial
 * @property string|null $tube_serial
 * @property string|null $kv
 * @property string|null $ma
 * @property string|null $serial_number
 * @property string|null $inventory_number
 * @property string|null $purchase_date
 * @property \Illuminate\Support\Carbon|null $first_verification_date
 * @property string|null $warranty_expiration
 * @property-read \Modules\TechPlanner\Models\Appointment|null $appointment
 * @property-read \Modules\TechPlanner\Models\Client|null $client
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\DeviceVerification|null $latest_verification
 * @property-read bool $needs_verification
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\TechPlanner\Models\DeviceVerification> $verifications
 * @property-read int|null $verifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereFirstVerificationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereHeadsetSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereKv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereMa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereTubeSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Machine whereWarrantyExpiration($value)
 * @mixin \Eloquent
 */
class Machine extends Device
{
    /**
     * Relazione con l'appuntamento.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
