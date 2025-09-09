<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;
class CreatePhoneCall extends XotBaseCreateRecord
{
    protected static string $resource = PhoneCallResource::class;
}
