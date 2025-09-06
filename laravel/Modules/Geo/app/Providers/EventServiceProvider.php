<?php

declare(strict_types=1);

namespace Modules\Geo\Providers;

use Modules\Xot\Providers\XotBaseEventServiceProvider;

class EventServiceProvider extends XotBaseEventServiceProvider
{
    public string $name = 'Geo';
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
    protected function configureEmailVerification(): void
    {
    }
}
