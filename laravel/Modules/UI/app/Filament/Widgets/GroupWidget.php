<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

class GroupWidget extends XotBaseWidget
{
    public array $widgets = [];

    protected static ?string $pollingInterval = null;

    protected static string $view = 'ui::filament.widgets.group';

    public function getFormSchema(): array
    {
        return [];
    }

}
