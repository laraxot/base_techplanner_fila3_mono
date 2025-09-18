<?php

declare(strict_types=1);

namespace Modules\Gdpr\Providers;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> faeca70 (.)
use Modules\Xot\Providers\XotBaseEventServiceProvider;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends XotBaseEventServiceProvider
<<<<<<< HEAD
=======
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
>>>>>>> 6f6abe7c (.)
=======
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    protected function configureEmailVerification(): void
    {
    }
}
