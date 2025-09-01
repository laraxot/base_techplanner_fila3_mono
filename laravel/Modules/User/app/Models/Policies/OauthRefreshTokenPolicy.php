<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\OauthRefreshToken;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\OauthRefreshToken;
>>>>>>> 8055579 (.)

class OauthRefreshTokenPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-refresh-token.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, OauthRefreshToken $oauthRefreshToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-refresh-token.view') ||
=======
        return $user->hasPermissionTo('oauth-refresh-token.view') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-refresh-token.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, OauthRefreshToken $oauthRefreshToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-refresh-token.update') ||
=======
        return $user->hasPermissionTo('oauth-refresh-token.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, OauthRefreshToken $oauthRefreshToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-refresh-token.delete') ||
=======
        return $user->hasPermissionTo('oauth-refresh-token.delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, OauthRefreshToken $oauthRefreshToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-refresh-token.restore') ||
=======
        return $user->hasPermissionTo('oauth-refresh-token.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, OauthRefreshToken $oauthRefreshToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-refresh-token.force-delete') ||
               $user->hasRole('super-admin');
    }
}
=======
        return $user->hasPermissionTo('oauth-refresh-token.force-delete') || 
               $user->hasRole('super-admin');
    }
}
>>>>>>> 8055579 (.)
