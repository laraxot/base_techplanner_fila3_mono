<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\TenantUser;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\TenantUser;
>>>>>>> 8055579 (.)

class TenantUserPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('tenant-user.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, TenantUser $tenantUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant-user.view') ||
=======
        return $user->hasPermissionTo('tenant-user.view') || 
>>>>>>> 8055579 (.)
               $user->id === $tenantUser->user_id ||
               $user->tenants->contains($tenantUser->tenant_id) ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('tenant-user.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, TenantUser $tenantUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant-user.update') ||
=======
        return $user->hasPermissionTo('tenant-user.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TenantUser $tenantUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant-user.delete') ||
=======
        return $user->hasPermissionTo('tenant-user.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TenantUser $tenantUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant-user.restore') ||
=======
        return $user->hasPermissionTo('tenant-user.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TenantUser $tenantUser): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('tenant-user.force-delete') ||
=======
        return $user->hasPermissionTo('tenant-user.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
