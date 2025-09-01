<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Notification;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\Notification;
>>>>>>> 8055579 (.)

class NotificationPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('notification.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Notification $notification): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('notification.view') ||
=======
        return $user->hasPermissionTo('notification.view') || 
>>>>>>> 8055579 (.)
               $user->id === $notification->notifiable_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('notification.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Notification $notification): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('notification.update') ||
=======
        return $user->hasPermissionTo('notification.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Notification $notification): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('notification.delete') ||
=======
        return $user->hasPermissionTo('notification.delete') || 
>>>>>>> 8055579 (.)
               $user->id === $notification->notifiable_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Notification $notification): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('notification.restore') ||
=======
        return $user->hasPermissionTo('notification.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Notification $notification): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('notification.force-delete') ||
=======
        return $user->hasPermissionTo('notification.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
