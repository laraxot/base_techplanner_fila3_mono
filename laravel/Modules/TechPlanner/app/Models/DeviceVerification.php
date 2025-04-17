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
 */
class DeviceVerification extends BaseModel
{
    protected $fillable = [
        'device_id',
        'verification_date',
        'status',
    ];
}
