<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Pages;

use Modules\Xot\Filament\Pages\XotBaseDashboard;
use Modules\Employee\Filament\Widgets\TimeClockWidget;

/**
 * Dashboard per il modulo Employee.
 * Estende XotBaseDashboard che gestisce automaticamente:
 * - Navigazione (icon, title, label, sort)
 * - Filtri del dashboard
 * - Struttura base del dashboard
 * REGOLA CRITICA: NON ridefinire proprietà di navigazione
 * che sono già gestite centralmente da XotBaseDashboard.
 */
class Dashboard extends XotBaseDashboard
{
    // ❌ NON ridefinire queste proprietà (gestite da XotBaseDashboard):
    // protected static ?string $navigationIcon
    // protected static ?string $title
    // protected static ?string $navigationLabel
    // protected static ?int $navigationSort

    public function getWidgets(): array
    {
        return [
            TimeClockWidget::class,
        ];
    }
}
