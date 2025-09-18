<?php

declare(strict_types=1);

namespace Modules\Predict\Providers;

use Illuminate\Routing\Router;
use Modules\Predict\Projectors;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

class PredictServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Predict';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    // public function boot(): void
    // {
    //     parent::boot();
    //     $router = app('router');
    //     $this->registerMyMiddleware($router);
    //     $this->registerRoutes($router);

    //     $this->registerEventListener();

    //     Projectionist::addProjectors([
    //         Projectors\ArticleProjector::class,
    //     ]);
    // }

    // protected function registerEventListener(): void
    // {
    //     $this->app->register(EventServiceProvider::class);
    // }

    // public function registerMyMiddleware(Router $router): void
    // {
    // }

    // public function registerRoutes(Router $router): void
    // {
    // }
}
