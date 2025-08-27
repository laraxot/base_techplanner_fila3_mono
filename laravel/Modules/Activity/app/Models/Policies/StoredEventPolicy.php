<?php

declare(strict_types=1);

namespace Modules\Activity\Models\Policies;

use Modules\Activity\Models\StoredEvent;
use Modules\Xot\Contracts\UserContract;

class StoredEventPolicy extends ActivityBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('stored_event.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('stored_event.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, StoredEvent $stored_event): bool
    {
        return $user->hasPermissionTo('stored_event.forceDelete');
    }
}