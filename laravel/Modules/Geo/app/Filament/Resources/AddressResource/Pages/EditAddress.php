<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

use Filament\Actions;
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditAddress extends XotBaseEditRecord
{
    protected static string $resource = AddressResource::class;

    /**
     * @return array<\Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
