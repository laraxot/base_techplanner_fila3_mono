<?php

declare(strict_types=1);

namespace Modules\Gdpr\Providers;

use Modules\Xot\Providers\XotBaseRouteServiceProvider;

class RouteServiceProvider extends XotBaseRouteServiceProvider
{
    protected string $moduleNamespace = 'Modules\Gdpr\Http\Controllers';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
=======
=======
>>>>>>> ee97d89f (.)

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

<<<<<<< HEAD
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
>>>>>>> faeca70 (.)
    public string $name = 'Gdpr';
}
