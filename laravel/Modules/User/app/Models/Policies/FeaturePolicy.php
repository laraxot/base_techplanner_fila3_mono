<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Feature;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\Feature;
>>>>>>> 8055579 (.)

class FeaturePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('feature.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.view') ||
=======
        return $user->hasPermissionTo('feature.view') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('feature.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.update') ||
=======
        return $user->hasPermissionTo('feature.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.delete') ||
=======
        return $user->hasPermissionTo('feature.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.restore') ||
=======
        return $user->hasPermissionTo('feature.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.force-delete') ||
=======
        return $user->hasPermissionTo('feature.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
