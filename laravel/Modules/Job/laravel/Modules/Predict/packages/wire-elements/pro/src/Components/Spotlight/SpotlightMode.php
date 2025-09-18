<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

class SpotlightMode
{
    public string $id;

    public string $character;

    public string $placeholder;

    public array $scopes = [];

    public function __construct(string $id, string $placeholder, int $priority = 10)
    {
        $this->id = $id;
        $this->placeholder = $placeholder;

        Spotlight::$groups[] = SpotlightGroup::make($id, $placeholder, $priority);
    }

    public static function make(string $id, string $placeholder): self
    {
        return new self($id, $placeholder);
    }

    public function setCharacter(string $character): SpotlightMode
    {
        $this->character = $character;

        return $this;
    }

    public function setPlaceholder(string $placeholder): SpotlightMode
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
