<?php

declare(strict_types=1);

namespace Modules\Employee\Providers\Filament;

use Filament\Navigation\MenuItem;
use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Employee';

    #[\Override]
    public function panel(Panel $panel): Panel
    {
        $panel = parent::panel($panel);

        // Configurazioni specifiche del modulo Employee
        $panel->pages([
            \Modules\Employee\Filament\Pages\Dashboard::class,
        ]);
        $panel
            ->login()
            ->pages([
                \Modules\Employee\Filament\Pages\Dashboard::class,
            ])
            ->resources([
                \Modules\Employee\Filament\Resources\WorkHourResource::class,
            ]);
        $panel->pages([
            \Modules\Employee\Filament\Pages\Dashboard::class,
        ]);

        // Menu items specifici
        $panel->userMenuItems([
            MenuItem::make()
                ->label('Gestione Dipendenti')
                ->url(\Modules\Employee\Filament\Pages\Dashboard::getUrl(...))
                ->icon('heroicon-m-users'),
        ]);

        return $panel;
    }
}
