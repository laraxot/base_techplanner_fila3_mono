<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\ModelHasPermission;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\ModelHasPermission;
>>>>>>> 8055579 (.)

class ModelHasPermissionPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-permission.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.view') ||
=======
        return $user->hasPermissionTo('model-has-permission.view') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-permission.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.update') ||
=======
        return $user->hasPermissionTo('model-has-permission.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.delete') ||
=======
        return $user->hasPermissionTo('model-has-permission.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.restore') ||
=======
        return $user->hasPermissionTo('model-has-permission.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('model-has-permission.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
