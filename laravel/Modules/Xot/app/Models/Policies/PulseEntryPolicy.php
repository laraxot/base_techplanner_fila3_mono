<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\PulseEntry;
=======
use Modules\Xot\Models\PulseEntry;
use Modules\Xot\Contracts\UserContract;
>>>>>>> e697a77b (.)

class PulseEntryPolicy extends XotBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('pulse_entry.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, PulseEntry $pulse_entry): bool
    {
        return $user->hasPermissionTo('pulse_entry.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('pulse_entry.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, PulseEntry $pulse_entry): bool
    {
        return $user->hasPermissionTo('pulse_entry.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, PulseEntry $pulse_entry): bool
    {
        return $user->hasPermissionTo('pulse_entry.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, PulseEntry $pulse_entry): bool
    {
        return $user->hasPermissionTo('pulse_entry.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, PulseEntry $pulse_entry): bool
    {
        return $user->hasPermissionTo('pulse_entry.forceDelete');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> e697a77b (.)
