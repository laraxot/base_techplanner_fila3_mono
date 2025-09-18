<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert;

trait InteractsWithInsertComponent
{
    public ?int $insertInstanceId = null;

    public function mountInteractsWithInsertComponent($insertInstanceId = null)
    {
        $this->insertInstanceId = $insertInstanceId;
    }

    public function insertValue($value)
    {
        $this->dispatch('remoteInsert', instance: $this->insertInstanceId, value: $value);
    }
}
