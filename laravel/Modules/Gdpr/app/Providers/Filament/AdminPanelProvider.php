<?php

declare(strict_types=1);

namespace Modules\Gdpr\Providers\Filament;

use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Gdpr';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    #[\Override]
>>>>>>> 97a11f9 (.)
=======
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    public function panel(Panel $panel): Panel
    {
        $panel = parent::panel($panel);
        FilamentAsset::register([
            Css::make('gdpr-styles', asset('/vendor/cookie-consent/css/cookie-consent.css')),
            // Js::make('gdpr-scripts', __DIR__.'/../../resources/dist/assets/app2.js'),
        ], 'gdpr');

        return $panel;
    }
}
