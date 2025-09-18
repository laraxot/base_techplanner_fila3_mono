<?php

declare(strict_types=1);

namespace Modules\Predict\Enums\Front;

use Filament\Support\Contracts\HasLabel;

// https://github.com/filamentphp/filament/blob/884f25694a86ca9ddd28da8b0e2c12275adc3feb/packages/panels/src/View/PanelsRenderHook.php

enum TopBarEnum: string implements HasLabel
{
    case TOPBAR_END = 'TOPBAR_END';
    case TOPBAR_START = 'TOPBAR_START';
    case TOPBAR_CENTER = 'TOPBAR_CENTER';
    case USER_MENU_BEFORE = 'USER_MENU_BEFORE';

    public function getLabel(): string
    {
        return match ($this) {
            self::TOPBAR_END => 'TOPBAR_END',
            self::TOPBAR_START => 'TOPBAR_START',
            self::TOPBAR_CENTER => 'TOPBAR_CENTER',
            self::USER_MENU_BEFORE => 'USER_MENU_BEFORE',
        };
    }
}
