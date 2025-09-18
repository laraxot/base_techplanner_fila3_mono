<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\Conditionable;

class InsertQueryResult implements Arrayable
{
    use Conditionable;

    protected mixed $id;

    protected mixed $headline;

    protected mixed $subheadline;

    protected mixed $insert;

    /**
     * @deprecated
     */
    protected array $emit;

    protected array $dispatch;

    protected mixed $photo;

    protected array $customAttributes = [];

    protected string $view;

    public static function make(
        mixed $id,
        mixed $headline,
        mixed $insert = null,
        array $emit = [],
        array $dispatch = [],
        mixed $subheadline = null,
        mixed $photo = null,
        mixed $customAttributes = [],
        string $view = 'wire-elements-pro::insert.item',
    ): self {
        return tap(new static())
            ->setId($id)
            ->setHeadline($headline)
            ->setSubheadline($subheadline)
            ->setPhoto($photo)
            ->setInsert($insert)
            ->setEmit($emit)
            ->setDispatch($dispatch)
            ->setCustomAttributes($customAttributes)
            ->setView($view);
    }

    public function setId(mixed $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setHeadline(mixed $headline): self
    {
        $this->headline = $headline;

        return $this;
    }

    public function setSubheadline(mixed $subheadline): self
    {
        $this->subheadline = $subheadline;

        return $this;
    }

    public function setPhoto(mixed $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function setInsert(mixed $insert): self
    {
        $this->insert = $insert;

        return $this;
    }

    /**
     * @deprecated
     */
    public function setEmit(array $emit): self
    {
        $this->emit = $emit;

        return $this;
    }

    public function setDispatch(array $dispatch): self
    {
        $this->dispatch = $dispatch;

        return $this;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function setCustomAttributes(array $customAttributes): self
    {
        $this->customAttributes = $customAttributes;

        return $this;
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function getHeadline(): mixed
    {
        return $this->headline;
    }

    public function getSubheadline(): mixed
    {
        return $this->subheadline;
    }

    public function getPhoto(): mixed
    {
        return $this->photo;
    }

    public function getInsert(): mixed
    {
        return $this->insert;
    }

    /**
     * @deprecated
     */
    public function getEmit(): array
    {
        return $this->emit;
    }

    public function getDispatch(): array
    {
        return $this->dispatch;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getCustomAttributes(): array
    {
        return $this->customAttributes;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'headline' => $this->getHeadline(),
            'subheadline' => $this->getSubheadline(),
            'photo' => $this->getPhoto(),
            'dispatch' => array_merge($this->getEmit(), $this->getDispatch()),
            'insert' => $this->getInsert(),
            'custom_attributes' => $this->getCustomAttributes(),
            'view' => $this->getView(),
        ];
    }
}
