<?php

declare(strict_types=1);

namespace Modules\Chart\Filament\Resources\ChartResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Chart\Filament\Resources\ChartResource;

class CreateChart extends XotBaseCreateRecord
{
    protected static string $resource = ChartResource::class;
}
