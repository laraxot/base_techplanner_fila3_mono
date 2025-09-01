<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\SocialiteUser;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\SocialiteUser;
>>>>>>> 8055579 (.)

class SocialiteUserPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('socialite-user.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, SocialiteUser $socialiteUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('socialite-user.view') ||
=======
        return $user->hasPermissionTo('socialite-user.view') || 
>>>>>>> 8055579 (.)
               $user->id === $socialiteUser->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('socialite-user.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, SocialiteUser $socialiteUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('socialite-user.update') ||
=======
        return $user->hasPermissionTo('socialite-user.update') || 
>>>>>>> 8055579 (.)
               $user->id === $socialiteUser->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, SocialiteUser $socialiteUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('socialite-user.delete') ||
=======
        return $user->hasPermissionTo('socialite-user.delete') || 
>>>>>>> 8055579 (.)
               $user->id === $socialiteUser->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, SocialiteUser $socialiteUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('socialite-user.restore') ||
=======
        return $user->hasPermissionTo('socialite-user.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, SocialiteUser $socialiteUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('socialite-user.force-delete') ||
=======
        return $user->hasPermissionTo('socialite-user.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
