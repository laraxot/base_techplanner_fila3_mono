<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Media\Filament\Actions\Table;

// Header actions must be an instance of Filament\Actions\Action, or Filament\Actions\ActionGroup.
// use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Tables\Actions\Action;

class ConvertAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel()
            ->tooltip('convert')
            ->openUrlInNewTab()
            ->icon('media-convert')
            ->form([
                Radio::make('format')
                    ->options([
                        'webm01' => 'webm01',
                        'webm02' => 'webm02',
                    ])
                    ->inline()
                    ->inlineLabel(false),
            ])
            ->action(dddx(...));

        // ->requiresConfirmation()
    }
}
