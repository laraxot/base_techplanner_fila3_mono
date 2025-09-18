<?php

declare(strict_types=1);

namespace Modules\Predict\Providers\Filament;

use Filament\Panel;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Modules\Predict\Enums\Front\TopBarEnum;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Predict';

    public function panel(Panel $panel): Panel
    {
        $panel->plugins([
            // FilamentPeekPlugin::make(),
            SpatieLaravelTranslatablePlugin::make(),
        ]);

        FilamentView::registerRenderHook(
            TopBarEnum::USER_MENU_BEFORE->value,
            fn (): string => Blade::render('predict::layouts.headernav.credits'),
        );

        FilamentView::registerRenderHook(
            TopBarEnum::TOPBAR_CENTER->value,
            fn (): string => Blade::render('pub_theme::layouts.headernav.search'),
        );

        return parent::panel($panel);
    }
}
