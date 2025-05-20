<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\DeviceVerificationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRecords extends XotBaseListRecords
{
    protected static string $resource = DeviceVerificationResource::class;

<<<<<<< HEAD
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('device.name'), // Assuming you have a relationship defined
=======
    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('device.name'),
>>>>>>> b32e314 (.)
            Tables\Columns\TextColumn::make('verification_date'),
            Tables\Columns\TextColumn::make('status'),
        ];
    }
}
