<?php

declare(strict_types=1);

/**
 * ----------------------------------------------------------------.
 * EX XotBasePolicy.
 */

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Modules\User\Models\Permission;
use Modules\Xot\Contracts\UserContract;
=======
use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use Modules\User\Models\Permission;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;
>>>>>>> 8055579 (.)

// use Modules\Xot\Datas\XotData;

abstract class UserPermissionBasePolicy
{
    use HandlesAuthorization;

    public function before(UserContract $user, string $ability): ?bool
    {
<<<<<<< HEAD

        if ($user->hasRole('super-admin')) {
            return true;
        }

        $class_name = class_basename(static::class);
        $permission_name = Str::of($class_name)
            ->before('Policy')
            ->lower()
            ->append('.'.$ability)
            ->toString();

        try {
            Permission::firstOrCreate(['name' => $permission_name]);
        } catch (\Exception $e) {
            // dddx($e);
        }
        if ($user->hasPermissionTo($permission_name)) {
            return true;
        }
=======
        
        if ($user->hasRole('super-admin')) {
            return true;
        }
       
        $class_name=class_basename(static::class);
        $permission_name=Str::of($class_name)
        ->before('Policy')
        ->lower()
        ->append('.'.$ability)
        ->toString();
        
        try {
            Permission::firstOrCreate(['name' => $permission_name]);
        } catch (\Exception $e) {
            //dddx($e);
        }
        if($user->hasPermissionTo($permission_name)){
            return true;
        }
        
>>>>>>> 8055579 (.)

        return null;
    }
}
