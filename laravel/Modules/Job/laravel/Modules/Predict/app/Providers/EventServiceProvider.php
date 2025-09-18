<?php

declare(strict_types=1);

namespace Modules\Predict\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Modules\Predict\Listeners\CheckLoginListener;
use Modules\Predict\Listeners\LoginListener;
use Modules\Predict\Listeners\ProfileRegisteredListener;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        Registered::class => [
            ProfileRegisteredListener::class,
        ],

        Login::class => [
            // CheckLoginListener::class,
            LoginListener::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void
    {
    }
}
