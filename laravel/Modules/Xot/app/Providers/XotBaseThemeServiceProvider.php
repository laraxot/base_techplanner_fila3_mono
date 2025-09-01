<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Illuminate\Support\ServiceProvider;

abstract class XotBaseThemeServiceProvider extends ServiceProvider
{
    public string $name = '';

    public string $nameLower = '';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        $this->loadViewsFrom($this->module_dir.'/../resources/views', $this->nameLower);
        $this->loadTranslationsFrom($this->module_dir.'/../resources/lang', $this->nameLower);
        $this->loadJsonTranslationsFrom($this->module_dir.'/../resources/lang');
        $this->registerBladeComponents();
    }

    public function register(): void
    {
        $this->app->register($this->module_ns.'\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns.'\Providers\EventServiceProvider');
    }

    protected function registerBladeComponents(): void
    {
        $componentNamespace = $this->module_ns.'\View\Components';
        \Illuminate\Support\Facades\Blade::componentNamespace($componentNamespace, $this->nameLower);

        app(\Modules\Xot\Actions\Blade\RegisterBladeComponentsAction::class)
            ->execute(
                $this->module_dir.'/../View/Components',
                $this->module_ns
            );
    }
}
