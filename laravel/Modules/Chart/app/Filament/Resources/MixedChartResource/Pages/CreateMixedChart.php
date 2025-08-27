<?php

declare(strict_types=1);

namespace Modules\Chart\Filament\Resources\MixedChartResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Chart\Filament\Resources\MixedChartResource;

class CreateMixedChart extends XotBaseCreateRecord
{
    protected static string $resource = MixedChartResource::class;
}
