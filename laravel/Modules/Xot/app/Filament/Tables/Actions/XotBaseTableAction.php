<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Closure|\Illuminate\Database\Eloquent\Model|null $record
 */
abstract class XotBaseTableAction extends Action
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getRecord(): ?Model
    {
        $record = $this->record;

        // Handle Closure case (lazy loading)
        if ($record instanceof \Closure) {
            $record = $record();
        }

        return $record instanceof Model ? $record : null;
    }

    protected function requireRecord(): Model
    {
        $record = $this->getRecord();
        if ($record === null) {
            throw new \RuntimeException('Record is required for this action');
        }

        return $record;
    }
}
