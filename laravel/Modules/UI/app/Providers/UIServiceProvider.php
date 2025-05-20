<?php

declare(strict_types=1);

namespace Modules\UI\Providers;

<<<<<<< HEAD
use function Safe\realpath;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Modules\UI\Services\UIService;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;

/**
 * Service Provider per il modulo UI.
 *
 * Nota: la registrazione dei Blade components modulari avviene tramite GetModulePathByGeneratorAction
 * per garantire la corretta risoluzione dei path secondo la struttura dei moduli.
 *
 * @phpstan-type ModuleConfig array{name: string, alias: string, description: string, keywords: array<int, string>, priority: int, providers: array<int, class-string>}
 */
class UIServiceProvider extends XotBaseServiceProvider
{
    /**
     * Nome del modulo.
     *
     * @var string
     */
    public string $name = 'UI';

    /**
     * Directory del modulo.
     *
     * @var string
     */
=======
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Modules\UI\Services\UIService;
use Modules\Xot\Providers\XotBaseServiceProvider;

use function Safe\realpath;

/**
 * ---.
 */
class UIServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'UI';

>>>>>>> 77f8368 (.)
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    /**
<<<<<<< HEAD
     * Boot del service provider.
     *
     * Configura i componenti Blade e altre funzionalità del modulo UI.
     *
     * @return void
=======
     * Undocumented function.
>>>>>>> 77f8368 (.)
     */
    public function boot(): void
    {
        parent::boot();
<<<<<<< HEAD
        
        // La registrazione dei Blade components modulari avviene tramite GetModulePathByGeneratorAction
        // per garantire la corretta risoluzione dei path secondo la struttura dei moduli
        // $componentViewPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-view');
        // Blade::anonymousComponentPath($componentViewPath);
    }

    /**
     * Registra i servizi del provider.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
        // AliasLoader e BladeIcons sono gestiti a livello di XotBaseServiceProvider
    }
    
    /**
     * Restituisce il percorso delle viste dei componenti UI.
     *
     * @return string
     */
    public function getComponentViewPath(): string
    {
        return app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-view');
=======

        $relativePath = config('modules.paths.generator.component-view.path');
        $components_path = module_path($this->name, $relativePath);

        // $components_path = realpath(__DIR__.'/../resources/views/components');
        Blade::anonymousComponentPath($components_path);
    }

    public function register(): void
    {
        parent::register();
        // $loader = AliasLoader::getInstance();
        // $loader->alias('ui', UIService::class);
        // $this->registerBladeIcons(); //moved to XotBaseServiceProvider
>>>>>>> 77f8368 (.)
    }
}
