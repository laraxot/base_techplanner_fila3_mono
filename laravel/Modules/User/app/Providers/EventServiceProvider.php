<?php

declare(strict_types=1);

namespace Modules\User\Providers;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\OtherDeviceLogout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\User\Listeners\FailedLoginListener;
use Modules\User\Listeners\LoginListener;
use Modules\User\Listeners\LogoutListener;
use Modules\User\Listeners\OtherDeviceLogoutListener;
use SocialiteProviders\Auth0\Auth0ExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
<<<<<<< HEAD
use Modules\Xot\Providers\XotBaseEventServiceProvider;

class EventServiceProvider extends XotBaseEventServiceProvider
{
    public string $name = 'User';
    public string $nameLower = 'user';
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;

=======

class EventServiceProvider extends ServiceProvider
{
>>>>>>> 0b525d2 (.)
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        SocialiteWasCalled::class => [
            Auth0ExtendSocialite::class,
        ],
        Login::class => [
            LoginListener::class,
        ],
        Logout::class => [
            LogoutListener::class,
        ],
        Failed::class => [
            FailedLoginListener::class,
        ],
        OtherDeviceLogout::class => [
            OtherDeviceLogoutListener::class,
        ],
    ];
<<<<<<< HEAD

    protected $subscribe = [
        // Aggiungi qui i subscriber specifici del modulo
    ];
=======
>>>>>>> 0b525d2 (.)
}
