<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Tenant;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\Tenant;
>>>>>>> 8055579 (.)

class TenantPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('tenant.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, Tenant $tenant): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant.view') ||
=======
        return $user->hasPermissionTo('tenant.view') || 
>>>>>>> 8055579 (.)
               $user->tenants->contains($tenant->id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('tenant.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, Tenant $tenant): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant.update') ||
=======
        return $user->hasPermissionTo('tenant.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Tenant $tenant): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant.delete') ||
=======
        return $user->hasPermissionTo('tenant.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, Tenant $tenant): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant.restore') ||
=======
        return $user->hasPermissionTo('tenant.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Tenant $tenant): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant.force-delete') ||
=======
        return $user->hasPermissionTo('tenant.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
