<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
class TeamPermissionPolicy extends UserBasePolicy {}
=======
use Modules\User\Models\TeamPermission;
use Modules\Xot\Contracts\UserContract;

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
        return $user->hasPermissionTo('team-permission.view') ||
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
        return $user->hasPermissionTo('team-permission.update') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TeamPermission $teamPermission): bool
    {
        return $user->hasPermissionTo('team-permission.delete') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TeamPermission $teamPermission): bool
    {
        return $user->hasPermissionTo('team-permission.restore') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TeamPermission $teamPermission): bool
    {
        return $user->hasPermissionTo('team-permission.force-delete') ||
               $user->hasRole('super-admin');
    }
}
>>>>>>> 9831a351 (.)
