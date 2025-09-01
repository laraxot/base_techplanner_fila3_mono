<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\ModelHasRole;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\ModelHasRole;
>>>>>>> 8055579 (.)

class ModelHasRolePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-role.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, ModelHasRole $modelHasRole): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-role.view') ||
=======
        return $user->hasPermissionTo('model-has-role.view') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-role.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, ModelHasRole $modelHasRole): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-role.update') ||
=======
        return $user->hasPermissionTo('model-has-role.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, ModelHasRole $modelHasRole): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-role.delete') ||
=======
        return $user->hasPermissionTo('model-has-role.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, ModelHasRole $modelHasRole): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-role.restore') ||
=======
        return $user->hasPermissionTo('model-has-role.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, ModelHasRole $modelHasRole): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-role.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('model-has-role.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
