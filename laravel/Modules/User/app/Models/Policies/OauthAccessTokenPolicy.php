<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\OauthAccessToken;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\User\Models\OauthAccessToken;
>>>>>>> 8055579 (.)

class OauthAccessTokenPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-access-token.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.view') ||
=======
        return $user->hasPermissionTo('oauth-access-token.view') || 
>>>>>>> 8055579 (.)
               $user->id === $oauthAccessToken->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-access-token.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.update') ||
=======
        return $user->hasPermissionTo('oauth-access-token.update') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.delete') ||
=======
        return $user->hasPermissionTo('oauth-access-token.delete') || 
>>>>>>> 8055579 (.)
               $user->id === $oauthAccessToken->user_id ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.restore') ||
=======
        return $user->hasPermissionTo('oauth-access-token.restore') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.force-delete') ||
=======
        return $user->hasPermissionTo('oauth-access-token.force-delete') || 
>>>>>>> 8055579 (.)
               $user->hasRole('super-admin');
    }
}
