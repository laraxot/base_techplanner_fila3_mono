<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Widget per statistiche con icona per il modulo UI.
 * 
 * Estende XotBaseWidget che gestisce automaticamente:
 * - Configurazioni base del widget
 * - Integrazione con il sistema Xot
 * - Pattern uniformi con altri widget
 */
class StatWithIconWidget extends XotBaseWidget
{
    protected static string $view = 'ui::filament.widgets.stat-with-icon';

    protected string|Htmlable $label;

    /**
     * @var scalar|Htmlable|\Closure
     */
    protected $value;

    protected function getData(): array
    {
        dddx($this->label);

        return [];
    }

    /**
     * Schema del form per il widget.
     */
    public function getFormSchema(): array
    {
        return [
            // Schema vuoto per widget di statistiche
        ];
    }
}
