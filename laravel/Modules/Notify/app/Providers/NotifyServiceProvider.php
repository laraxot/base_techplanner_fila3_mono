<?php

declare(strict_types=1);

namespace Modules\Notify\Providers;

// use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Providers\XotBaseServiceProvider;

class NotifyServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Notify';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        parent::boot();
        if (! app()->environment('production')) {
            $mail=TenantService::config('mail');
            $fallback_to=Arr::get($mail,'fallback_to',null);
            if($fallback_to!==null){
                Mail::alwaysTo($fallback_to);
            }
        }
    }
}
