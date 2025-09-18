<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Collection;

class SpotlightGroup
{
    protected string $id;

    protected string $title;

    protected int $priority;

    protected Collection $items;

    public function __construct(string $id, string $title, int $priority = 10)
    {
        $this->id = $id;
        $this->title = $title;
        $this->priority = $priority;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function priority(): int
    {
        return $this->priority;
    }

    public function items(): Collection
    {
        return $this->items ??= collect();
    }

    public static function make(string $id, string $title, int $priority = 10): self
    {
        return new static($id, $title, $priority);
    }

    public function setItems(Collection $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function isDefault(): bool
    {
        return 'results' === $this->id;
    }

    public function toArray()
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'priority' => $this->priority(),
        ];
    }
}
