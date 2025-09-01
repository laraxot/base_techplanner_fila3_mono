<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\ProfileTeam;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\ProfileTeam;
>>>>>>> 8055579 (.)

class ProfileTeamPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('profile-team.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, ProfileTeam $profileTeam): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('profile-team.view') ||
=======
        return $user->hasPermissionTo('profile-team.view') || 
>>>>>>> 8055579 (.)
               $user->id === $profileTeam->user_id ||
               $user->teams->contains($profileTeam->team_id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('profile-team.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, ProfileTeam $profileTeam): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('profile-team.update') ||
=======
        return $user->hasPermissionTo('profile-team.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, ProfileTeam $profileTeam): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('profile-team.delete') ||
=======
        return $user->hasPermissionTo('profile-team.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, ProfileTeam $profileTeam): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('profile-team.restore') ||
=======
        return $user->hasPermissionTo('profile-team.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, ProfileTeam $profileTeam): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('profile-team.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('profile-team.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
