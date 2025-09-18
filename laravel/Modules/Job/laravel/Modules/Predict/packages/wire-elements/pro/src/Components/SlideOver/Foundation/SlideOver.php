<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\SlideOver\Foundation;

use WireElements\Pro\Components\Modal\Foundation\Base;
use WireElements\Pro\Contracts\BehavesAsSlideOver;

final class SlideOver extends Base implements BehavesAsSlideOver
{
    public function getListeners(): array
    {
        return [
            'slide-over.open' => 'registerAndActivateComponent',
        ];
    }
}
