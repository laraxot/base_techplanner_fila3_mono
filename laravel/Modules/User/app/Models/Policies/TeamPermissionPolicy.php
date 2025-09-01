<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\TeamPermission;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\TeamPermission;
>>>>>>> 8055579 (.)

class TeamPermissionPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-permission.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, TeamPermission $teamPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-permission.view') ||
=======
        return $user->hasPermissionTo('team-permission.view') || 
>>>>>>> 8055579 (.)
               $user->teams->contains($teamPermission->team_id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-permission.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, TeamPermission $teamPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-permission.update') ||
=======
        return $user->hasPermissionTo('team-permission.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TeamPermission $teamPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-permission.delete') ||
=======
        return $user->hasPermissionTo('team-permission.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TeamPermission $teamPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-permission.restore') ||
=======
        return $user->hasPermissionTo('team-permission.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TeamPermission $teamPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('team-permission.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('team-permission.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
