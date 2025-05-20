<?php

declare(strict_types=1);

/**
 * ----------------------------------------------------------------.
 */

namespace Modules\Xot\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Xot\Contracts\UserContract;

// use Modules\Xot\Datas\XotData;

abstract class XotBasePolicy
{
    use HandlesAuthorization;

    public function before(UserContract $user, string $ability): ?bool
    {
<<<<<<< HEAD
        return once(function () use ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }

            return null;
        });
=======
        if ($user->hasRole('super-admin')) {
            return true;
        }

        return null;
>>>>>>> 9d6070e (.)
    }

    public function viewAny(UserContract $userContract): bool
    {
        return false;
    }
}
