<?php

declare(strict_types=1);

namespace App\Providers\Filament;


use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBaseMainPanelProvider;

class AdminPanelProvider extends XotBaseMainPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        //$panel->default();
        return parent::panel($panel);
    }
}
