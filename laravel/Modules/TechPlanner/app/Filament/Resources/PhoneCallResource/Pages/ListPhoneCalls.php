<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;

use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListPhoneCalls extends XotBaseListRecords
{
    protected static string $resource = PhoneCallResource::class;

    public function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('date')
                ->sortable(),
            Tables\Columns\TextColumn::make('duration')
                ->sortable(),
            Tables\Columns\TextColumn::make('notes')
                ->limit(50),
            Tables\Columns\TextColumn::make('call_type')
                ->sortable(),
        ];
    }
}
