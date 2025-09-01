<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;



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

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Device $device): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Device $device): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Device $device): bool
    {

               $user->hasRole('super-admin');
    }
}
