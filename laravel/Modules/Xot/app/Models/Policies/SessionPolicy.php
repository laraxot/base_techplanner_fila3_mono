<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

use Modules\Xot\Models\Session;
use Modules\Xot\Contracts\UserContract;

class SessionPolicy extends XotBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('session.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Session $session): bool
    {
        return $user->hasPermissionTo('session.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('session.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Session $session): bool
    {
        return $user->hasPermissionTo('session.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Session $session): bool
    {
        return $user->hasPermissionTo('session.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Session $session): bool
    {
        return $user->hasPermissionTo('session.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Session $session): bool
    {
        return $user->hasPermissionTo('session.forceDelete');
    }
}