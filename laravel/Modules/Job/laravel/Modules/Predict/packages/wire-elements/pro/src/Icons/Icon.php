<?php

declare(strict_types=1);

namespace WireElements\Pro\Icons;

abstract class Icon
{
    abstract public function svg();

    public function toArray()
    {
        return [
            'svg' => $this->svg(),
        ];
    }
}
