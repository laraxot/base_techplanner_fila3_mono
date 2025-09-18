<?php

declare(strict_types=1);

namespace Modules\UI\Services;

class UIService
{
    public static function asset(string $asset): null|string
    {
        return app(\Modules\Xot\Actions\File\AssetAction::class)->execute($asset);
    }
}
