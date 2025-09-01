<?php

namespace Modules\Xot\Filament\Widgets;

use Filament\Widgets\TableWidget as FilamentTableWidget;
use Modules\Xot\Filament\Traits\TransTrait;

abstract class XotBaseTableWidget extends FilamentTableWidget
{
    use TransTrait;
}
