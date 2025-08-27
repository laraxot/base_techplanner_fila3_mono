<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Widgets\TableWidget as FilamentTableWidget;

abstract class XotBaseTableWidget extends FilamentTableWidget
{
    use TransTrait;
}
