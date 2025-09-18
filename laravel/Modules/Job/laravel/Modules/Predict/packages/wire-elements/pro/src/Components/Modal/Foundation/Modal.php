<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Modal\Foundation;

use WireElements\Pro\Contracts\BehavesAsModal;

final class Modal extends Base implements BehavesAsModal
{
    public function getListeners(): array
    {
        return [
            'modal.open' => 'registerAndActivateComponent',
        ];
    }
}
