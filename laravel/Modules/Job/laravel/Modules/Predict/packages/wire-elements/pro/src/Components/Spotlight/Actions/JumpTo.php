<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight\Actions;

use WireElements\Pro\Components\Spotlight\Spotlight;
use WireElements\Pro\Components\Spotlight\SpotlightAction;

class JumpTo extends SpotlightAction
{
    public string $path;

    public string $description;

    public function __construct(string $path, string $description = 'Jump to')
    {
        $this->path = $path;
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function execute(Spotlight $spotlight)
    {
        $spotlight->redirect($this->path);
    }
}
