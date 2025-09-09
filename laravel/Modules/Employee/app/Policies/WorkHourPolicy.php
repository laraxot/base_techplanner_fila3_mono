<?php

declare(strict_types=1);

namespace Modules\Employee\Policies;

use Modules\User\Models\User;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\Policies\UserBasePolicy;

class WorkHourPolicy extends UserBasePolicy
{
    

}
