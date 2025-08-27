<?php

declare(strict_types=1);

/**
 * @see https://github.com/awcodes/overlook/blob/2.x/src/Widgets/OverlookWidget.php
 */

namespace Modules\UI\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

class RowWidget extends XotBaseWidget
{
    public array $grid = [];

    public array $widgets = [];

    protected static string $view = 'ui::filament.widgets.row';

    protected int|string|array $columnSpan = 'full';

    /**
     * Get the form schema for the widget.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
