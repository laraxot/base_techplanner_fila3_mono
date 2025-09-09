<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\PulseAggregate;

class PulseAggregatePolicy extends XotBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
    {
        return $user->hasPermissionTo('pulse_aggregate.forceDelete');
    }
}
