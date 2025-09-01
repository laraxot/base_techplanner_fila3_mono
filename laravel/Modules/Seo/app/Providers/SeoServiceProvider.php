<?php

declare(strict_types=1);

namespace Modules\Seo\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Seo\Services\MetatagService;

class SeoServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Seo';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();

        $this->app->singleton(MetatagService::class, function ($app) {
            return new MetatagService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<string>
     */
    public function provides(): array
    {
        return [
            MetatagService::class,
        ];
    }
}
