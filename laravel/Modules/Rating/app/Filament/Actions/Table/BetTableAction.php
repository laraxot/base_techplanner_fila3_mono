<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Rating\Filament\Actions\Table;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;

class BetTableAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel();
        $this->label('')
            ->tooltip(trans('rating:txt.bet'))
            ->modalWidth('xl')
            ->form(fn (Action $action): array => [
                TextInput::make('aa'),
            ]);
    }

    public static function getDefaultName(): ?string
    {
        return 'bet_action';
    }
}
