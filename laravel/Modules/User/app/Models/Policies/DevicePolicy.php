<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Device;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\Device;
>>>>>>> 8055579 (.)

class DevicePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('device.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Device $device): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device.view') ||
=======
        return $user->hasPermissionTo('device.view') || 
>>>>>>> 8055579 (.)
               $user->devices->contains($device->id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('device.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Device $device): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device.update') ||
=======
        return $user->hasPermissionTo('device.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Device $device): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device.delete') ||
=======
        return $user->hasPermissionTo('device.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Device $device): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device.restore') ||
=======
        return $user->hasPermissionTo('device.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Device $device): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device.force-delete') ||
=======
        return $user->hasPermissionTo('device.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
