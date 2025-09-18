<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends BaseDashboard
{
    protected static null|string $navigationIcon = 'heroicon-o-home';

    protected static null|string $navigationGroup = 'TechPlanner';

    protected static null|int $navigationSort = -2;

    protected function getHeaderWidgets(): array
    {
        return [
            //         AccountWidget::class,
            //         FilamentInfoWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            // ..
        ];
    }

    // public function getTitle(): string
    // {
    //     return __('TechPlanner Dashboard');
    // }
}
