<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Widget di test per il modulo UI.
 * 
 * Estende XotBaseWidget che gestisce automaticamente:
 * - Configurazioni base del widget
 * - Integrazione con il sistema Xot
 * - Pattern uniformi con altri widget
 */
class TestWidget extends XotBaseWidget
{
    public array $widgets = [];

    protected static string $view = 'ui::filament.widgets.test-widget';

    /**
     * Schema del form per il widget.
     */
    public function getFormSchema(): array
    {
        return [
            // Schema vuoto per widget di test
        ];
    }
}
