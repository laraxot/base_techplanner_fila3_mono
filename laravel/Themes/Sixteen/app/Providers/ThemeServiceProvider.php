<?php

declare(strict_types=1);

namespace Themes\Sixteen\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Service Provider per il tema Sixteen.
 * 
 * Questo provider gestisce la registrazione e configurazione
 * del tema Sixteen nell'applicazione Laravel.
 * 
 * IMPORTANTE: Il tema Sixteen usa il namespace 'pub_theme' per le viste,
 * non 'sixteen', per essere compatibile con il sistema di temi.
 */
class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrazione dei servizi del tema
        $this->app->singleton('sixteen.theme', function ($app) {
            return new \Themes\Sixteen\Services\ThemeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Caricamento delle viste del tema con namespace pub_theme
        // IMPORTANTE: pub_theme è il namespace standard per i temi
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'pub_theme');
        
        // Caricamento delle traduzioni del tema con namespace pub_theme
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