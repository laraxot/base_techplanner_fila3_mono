<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\TechPlanner\Providers\Filament;

use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'TechPlanner';

    public function panel(Panel $panel): Panel
    {
        $panel = parent::panel($panel);

        $panel->widgets([
            \Modules\TechPlanner\Filament\Widgets\ClientMapWidget::class,
            \Modules\TechPlanner\Filament\Widgets\CoordinatesWidget::class,
        ]);

        return $panel;
    }
}
