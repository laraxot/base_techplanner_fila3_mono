<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;
use Modules\Xot\Datas\XotData;

class FolioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /*
        Folio::path(resource_path('views/pages'))->middleware([
            '*' => [
                //
            ],
        ]);
        */
        // -- forse middleware per lang
        // -- spostato in cmsserviceprovider
        /*
        $path = XotData::make()->getPubThemeViewPath('pages');
        Folio::path($path)
            // ->uri('it')
            ->middleware([
                '*' => [
                ],
            ]);
        */
    }
}
