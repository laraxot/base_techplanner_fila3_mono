<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace Themes\One\Providers;

use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;
use Modules\Xot\Providers\XotBaseThemeServiceProvider;

class ThemeServiceProvider extends XotBaseThemeServiceProvider
{
    public string $name = 'One';
    public string $nameLower = 'one';
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;

    public function register(): void
    {
        FilamentIcon::register([
            'logo' => asset('themes/One/svg/logo.svg'),
        ]);
    }

    public function boot(): void
    {
        parent::boot();
        // Aggiungi qui solo logica specifica del tema
    }
} 
=======
namespace Themes\One\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Assets\FilamentAsset;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Registra il tema
        FilamentAsset::register([
            'name' => 'one',
            'path' => 'themes/one',
        ]);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'one');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }

    public function register()
    {
        //
    }
}
>>>>>>> 1b374b6 (.)
