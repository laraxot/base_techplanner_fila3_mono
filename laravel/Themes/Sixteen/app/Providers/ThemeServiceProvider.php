<?php

declare(strict_types=1);

namespace Themes\Sixteen\Providers;

use Modules\Xot\Providers\XotBaseThemeServiceProvider;

/**
 * Service Provider per il tema Sixteen.
 * 
 * Questo provider gestisce la registrazione e configurazione
 * del tema Sixteen nell'applicazione Laravel.
 * 
 * IMPORTANTE: Il tema Sixteen usa il namespace 'pub_theme' per le viste,
 * non 'sixteen', per essere compatibile con il sistema di temi.
 */
class ThemeServiceProvider extends XotBaseThemeServiceProvider
{
    public string $name = 'Sixteen';
    public string $nameLower = 'sixteen';
    protected string $module_dir = __DIR__ . '/../../';
    protected string $module_ns = __NAMESPACE__;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
        
        // Caricamento specifico per pub_theme namespace
        // IMPORTANTE: pub_theme è il namespace standard per i temi
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'pub_theme');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'pub_theme');
        
        // Caricamento delle configurazioni del tema
        $this->loadConfigFrom(__DIR__ . '/../../config', 'sixteen');
        
        // Pubblicazione degli assets del tema
        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('themes/sixteen/assets'),
        ], 'sixteen-assets');
        
        // Pubblicazione delle configurazioni del tema
        $this->publishes([
            __DIR__ . '/../../config' => config_path('themes/sixteen'),
        ], 'sixteen-config');
        
        // Registrazione Layout Shortcuts AGID
        $this->registerLayoutShortcuts();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();
        
        // Registrazione dei servizi del tema
        $this->app->singleton('sixteen.theme', function ($app) {
            return new \Themes\Sixteen\Services\ThemeService();
        });
    }

    /**
     * Registra i layout shortcuts AGID per il tema.
     */
    protected function registerLayoutShortcuts(): void
    {
        // Registrazione dei layout shortcuts per facilitare l'uso
        $this->app['view']->addNamespace('layouts', __DIR__ . '/../../resources/views/layouts');
        
        // Alias per layout AGID-compliant
        $this->app['view']->composer('layouts.guest-agid', function ($view) {
            $view->with([
                'theme_name' => 'Sixteen',
                'agid_compliant' => true,
                'accessibility_level' => 'WCAG 2.1 AA'
            ]);
        });
    }
    
    /**
     * Carica le configurazioni del tema.
     */
    protected function loadConfigFrom(string $path, string $namespace): void
    {
        if (is_dir($path)) {
            foreach (glob($path . '/*.php') as $file) {
                $name = basename($file, '.php');
                $this->mergeConfigFrom($file, $namespace . '.' . $name);
            }
        }
    }
}