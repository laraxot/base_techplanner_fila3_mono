<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;



class RoleHasPermissionPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('role-has-permission.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('role-has-permission.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {

               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {

