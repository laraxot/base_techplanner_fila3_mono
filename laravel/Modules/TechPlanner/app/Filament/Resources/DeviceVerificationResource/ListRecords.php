<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRecords extends XotBaseListRecords
{
    protected static string $resource = DeviceVerificationResource::class;

    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('device.name'),
            Tables\Columns\TextColumn::make('verification_date'),
            Tables\Columns\TextColumn::make('status'),
        ];
    }
}
