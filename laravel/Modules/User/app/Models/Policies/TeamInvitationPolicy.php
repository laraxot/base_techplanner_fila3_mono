<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

use Modules\User\Contracts\UserContract;
use Modules\User\Models\TeamInvitation;

class TeamInvitationPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-invitation.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, TeamInvitation $teamInvitation): bool
    {
        return $user->teams->contains($teamInvitation->team_id) ||
            $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('team-invitation.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, TeamInvitation $teamInvitation): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TeamInvitation $teamInvitation): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TeamInvitation $teamInvitation): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TeamInvitation $teamInvitation): bool
    {
        return $user->hasRole('super-admin');
    }
}
