<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

use Modules\User\Models\OauthAuthCode;
use Modules\Xot\Contracts\UserContract;

class OauthAuthCodePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.view.any'); /** @phpstan-ignore method.nonObject */
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(ProfileContract $user, OauthAuthCode $oauthAuthCode): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.view') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.create'); /** @phpstan-ignore method.nonObject */
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(ProfileContract $user, OauthAuthCode $oauthAuthCode): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.update') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(ProfileContract $user, OauthAuthCode $oauthAuthCode): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.delete') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(ProfileContract $user, OauthAuthCode $oauthAuthCode): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.restore') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(ProfileContract $user, OauthAuthCode $oauthAuthCode): bool
    {
        return $user->hasPermissionTo('oauth-auth-code.force-delete') ||
               $user->hasRole('super-admin');
    }
}
