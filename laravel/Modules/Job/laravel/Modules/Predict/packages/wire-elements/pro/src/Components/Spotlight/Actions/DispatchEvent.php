<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight\Actions;

use WireElements\Pro\Components\Spotlight\Spotlight;
use WireElements\Pro\Components\Spotlight\SpotlightAction;

class DispatchEvent extends SpotlightAction
{
    public string $name;

    public array $data;

    public string $description;

    public bool $close;

    public bool $clearScope;

    public bool $popScope;

    public function __construct(string $name, array $data, $description = 'Run', bool $close = true, $clearScope = false, $popScope = false)
    {
        $this->name = $name;
        $this->description = $description;
        $this->data = $data;
        $this->close = $close;
        $this->clearScope = $clearScope;
        $this->popScope = $popScope;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function execute(Spotlight $spotlight)
    {
        $spotlight->dispatch($this->name, ...$this->data);
        $spotlight->when($this->close, fn ($spotlight) => $spotlight->close(andClearScope: $this->clearScope, andPopScope: $this->popScope));
    }
}
