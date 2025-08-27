<?php

declare(strict_types=1);

/**
 * ----------------------------------------------------------------.
 * EX XotBasePolicy.
 */

namespace Modules\User\Models\Policies;

use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use Modules\User\Models\Permission;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

// use Modules\Xot\Datas\XotData;

abstract class UserBasePolicy
{
    use HandlesAuthorization;

    public function before(UserContract $user, string $ability): ?bool
    {
        $xotData = XotData::make();
        if ($user->hasRole('super-admin')) {
            return true;
        }
        /*
        $class_name=class_basename(static::class);
        $permission_name=Str::of($class_name)
        ->before('Policy')
        ->lower()
        ->append('.'.$ability)
        ->toString();
        */
        //dddx($permission_name);
        //if($user->hasPermissionTo($permission_name)){
        //    return true;
        //}
        //try {
        //    Permission::firstOrCreate(['name' => $permission_name]);
        //} catch (\Exception $e) {
        //    //dddx($e);
        //}

        return null;
    }
}
