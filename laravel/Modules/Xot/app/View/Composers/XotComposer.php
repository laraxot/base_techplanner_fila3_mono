<?php

declare(strict_types=1);

namespace Modules\Xot\View\Composers;

<<<<<<< HEAD
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Datas\MetatagData;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Modules\Xot\Actions\File\AssetPathAction;
use Nwidart\Modules\Laravel\Module as LaravelModule;
=======
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\Xot\Datas\MetatagData;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Laravel\Module as LaravelModule;
use Webmozart\Assert\Assert;
>>>>>>> 9d6070e (.)

/**
 * Class XotComposer.
 */
class XotComposer
{
    /**
     * Undocumented function.
     *
     * @param array<mixed|void> $arguments
     */
    public function __call(string $name, array $arguments): mixed
    {
        $modules = Module::getOrdered();

        $module = Arr::first(
            $modules,
            static function ($module) use ($name): bool {
                // Ensure the module is an instance of LaravelModule
                if (! $module instanceof LaravelModule) {
                    return false;
                }

                Assert::string($moduleName = $module->getName());
                $class = '\Modules\\'.$moduleName.'\View\Composers\ThemeComposer';

                return method_exists($class, $name);
            }
        );

        if (! \is_object($module)) {
            throw new \Exception('Create a View\Composers\ThemeComposer.php inside a module with ['.$name.'] method');
        }

        Assert::isInstanceOf($module, LaravelModule::class, '['.__LINE__.']['.class_basename($this).']');
        $class = '\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';

        $app = app($class);
        $callback = [$app, $name];
        Assert::isCallable($callback);

        return call_user_func_array($callback, $arguments);
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $lang = app()->getLocale();
        $view->with('lang', $lang);
        $view->with('_theme', $this);

        if (Auth::check()) {
            $profile = XotData::make()->getProfileModel();
            $view->with('_profile', $profile);
            $view->with('_user', auth()->user());
        }
    }

    public function asset(string $str): string
    {
        return asset(app(\Modules\Xot\Actions\File\AssetAction::class)->execute($str));
    }

<<<<<<< HEAD
    public function path(string $str): string
    {
        return (app(AssetPathAction::class)->execute($str));
    }

=======
>>>>>>> 9d6070e (.)
    public function metatag(string $str): string|bool|null
    {
        $metatag = MetatagData::make();
        $fun = 'get'.Str::studly($str);
        if (method_exists($metatag, $fun)) {
            // @phpstan-ignore return.type
            return $metatag->{$fun}();
        }

        // @phpstan-ignore return.type
        return $metatag->{$str};
    }
}
