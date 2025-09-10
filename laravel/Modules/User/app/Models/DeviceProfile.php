<?php

declare(strict_types=1);

namespace Modules\User\Models;

/**
 * DeviceProfile Model
<<<<<<< HEAD
 * 
=======
 *
>>>>>>> 9831a351 (.)
 * Represents the relationship between a device and a user profile.
 * Extends the base DeviceUser model to add specific functionality.
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property Device|null $device
 * @property \Modules\Xot\Contracts\ProfileContract|null $profile
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 * @property User|null $user
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile query()
=======
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceProfile query()
 *
>>>>>>> 9831a351 (.)
 * @mixin IdeHelperDeviceProfile
 * @mixin \Eloquent
 */
class DeviceProfile extends DeviceUser
{
    /**
     * Create a new model instance.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $attributes
=======
     * @param  array<string, mixed>  $attributes
>>>>>>> 9831a351 (.)
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
