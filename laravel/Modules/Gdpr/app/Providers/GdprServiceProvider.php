<?php

declare(strict_types=1);

namespace Modules\Gdpr\Providers;

use Illuminate\Routing\Router;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Gdpr\Datas\GdprData;
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
use Modules\Gdpr\Datas\GdprData;
>>>>>>> faeca70 (.)
use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;

class GdprServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Gdpr';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;

<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
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
    public function boot(): void
    {
        parent::boot();

        $lang_path = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'lang');
        $this->loadTranslationsFrom($lang_path, 'cookie-consent');
        
        $router = app('router');
        $this->registerMyMiddleware($router);
    }

    public function registerMyMiddleware(Router $router): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> faeca70 (.)
        $gdpr=GdprData::make();
        if($gdpr->cookie_banner_enabled){
            $router->pushMiddlewareToGroup('web', \Statikbe\CookieConsent\CookieConsentMiddleware::class);
        }
    }

<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
        $router->pushMiddlewareToGroup('web', \Statikbe\CookieConsent\CookieConsentMiddleware::class);
    }

>>>>>>> cb0fd7e5 (.)
=======
        $router->pushMiddlewareToGroup('web', \Statikbe\CookieConsent\CookieConsentMiddleware::class);
    }

>>>>>>> 6f6abe7c (.)
=======
        $router->pushMiddlewareToGroup('web', \Statikbe\CookieConsent\CookieConsentMiddleware::class);
    }

>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public function register(): void
    {
        parent::register();
    }
}
