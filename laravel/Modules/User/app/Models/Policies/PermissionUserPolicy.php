<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\PermissionUser;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\PermissionUser;
>>>>>>> 8055579 (.)

class PermissionUserPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('permission-user.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, PermissionUser $permissionUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('permission-user.view') ||
=======
        return $user->hasPermissionTo('permission-user.view') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('permission-user.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, PermissionUser $permissionUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('permission-user.update') ||
=======
        return $user->hasPermissionTo('permission-user.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, PermissionUser $permissionUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('permission-user.delete') ||
=======
        return $user->hasPermissionTo('permission-user.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, PermissionUser $permissionUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('permission-user.restore') ||
=======
        return $user->hasPermissionTo('permission-user.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, PermissionUser $permissionUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('permission-user.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('permission-user.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
