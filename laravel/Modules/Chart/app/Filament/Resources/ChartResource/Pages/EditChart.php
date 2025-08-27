<?php

declare(strict_types=1);

namespace Modules\Chart\Filament\Resources\ChartResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Chart\Filament\Resources\ChartResource;

class EditChart extends XotBaseEditRecord
{
    protected static string $resource = ChartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
