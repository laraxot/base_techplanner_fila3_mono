<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;



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

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, TenantUser $tenantUser): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, TenantUser $tenantUser): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, TenantUser $tenantUser): bool
    {

               $user->hasRole('super-admin');
    }
}
