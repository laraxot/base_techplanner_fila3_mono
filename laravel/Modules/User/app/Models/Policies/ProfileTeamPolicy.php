<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

use Modules\User\Contracts\UserContract;
use Modules\User\Models\ProfileTeam;

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
        return $user->id === $profileTeam->user_id ||
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
        return $user->id === $profileTeam->user_id ||
            $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, ProfileTeam $profileTeam): bool
    {
        return $user->id === $profileTeam->user_id ||
            $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, ProfileTeam $profileTeam): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, ProfileTeam $profileTeam): bool
    {
        return $user->hasRole('super-admin');
    }
}
