<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\TeamUser;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\TeamUser;
>>>>>>> 8055579 (.)

class TeamUserPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-user.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, TeamUser $teamUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-user.view') ||
=======
        return $user->hasPermissionTo('team-user.view') || 
>>>>>>> 8055579 (.)
               $user->id === $teamUser->user_id ||
               $user->teams->contains($teamUser->team_id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-user.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, TeamUser $teamUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-user.update') ||
=======
        return $user->hasPermissionTo('team-user.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TeamUser $teamUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-user.delete') ||
=======
        return $user->hasPermissionTo('team-user.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TeamUser $teamUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-user.restore') ||
=======
        return $user->hasPermissionTo('team-user.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TeamUser $teamUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-user.force-delete') ||
=======
        return $user->hasPermissionTo('team-user.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
