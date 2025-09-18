<?php

declare(strict_types=1);

namespace Modules\Media\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;

abstract class MediaBasePolicy
{
    use HandlesAuthorization;

    public function before(UserContract $user, string $_ability): null|bool
    {
        $xotData = XotData::make();
        if ($user->hasRole('super-admin')) {
            return true;
        }

        return null;
    }
}
