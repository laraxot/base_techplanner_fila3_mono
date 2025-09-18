<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PhoneCallEnum: string implements HasColor, HasIcon, HasLabel
{
    case INBOUND = 'inbound';
    case OUTBOUND = 'outbound';

    public function getLabel(): string
    {
        return trans('techplanner::phone_call.enums.' . $this->value . '.label');
    }

    public function getColor(): string
    {
        return trans('techplanner::phone_call.enums.' . $this->value . '.color');
    }

    public function getIcon(): string
    {
        return trans('techplanner::phone_call.enums.' . $this->value . '.icon');
    }
}
