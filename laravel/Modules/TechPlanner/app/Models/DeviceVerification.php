<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * Class DeviceVerification.
 *
 * @property int $id
 * @property int $device_id
 * @property string|null $verification_date
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceVerification whereVerificationDate($value)
 * @mixin \Eloquent
 */
class DeviceVerification extends BaseModel
{
    protected $fillable = [
        'device_id',
        'verification_date',
        'status',
    ];
}
