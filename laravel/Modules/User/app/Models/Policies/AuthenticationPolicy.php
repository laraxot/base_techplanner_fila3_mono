<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Authentication;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\Authentication;
>>>>>>> 8055579 (.)

class AuthenticationPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('authentication.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Authentication $authentication): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('authentication.view') ||
=======
        return $user->hasPermissionTo('authentication.view') || 
>>>>>>> 8055579 (.)
               $user->id === $authentication->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('authentication.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Authentication $authentication): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('authentication.update') ||
=======
        return $user->hasPermissionTo('authentication.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Authentication $authentication): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('authentication.delete') ||
=======
        return $user->hasPermissionTo('authentication.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Authentication $authentication): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('authentication.restore') ||
=======
        return $user->hasPermissionTo('authentication.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Authentication $authentication): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('authentication.force-delete') ||
=======
        return $user->hasPermissionTo('authentication.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
