<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight\Actions;

use WireElements\Pro\Components\Spotlight\Spotlight;
use WireElements\Pro\Components\Spotlight\SpotlightAction;

class ReplaceQuery extends SpotlightAction
{
    public string $query;

    public string $description;

    public function __construct(string $query, string $description)
    {
        $this->query = $query;
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function execute(Spotlight $spotlight)
    {
        $spotlight->query = $this->query;
        $spotlight->query();
    }
}
