<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Actions\Profile;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Modules\Predict\Actions\Profile\UpdateCreditsField;
use Modules\Predict\Aggregates\ProfileAggregate;
use Modules\Predict\Datas\AddedCreditsData;
use Modules\Predict\Datas\RemovedCreditsData;
use Modules\Xot\Contracts\ProfileContract;

class ModifyCredits extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            ->action(
                function (ProfileContract $record, array $data): void {
                    if ('add' == $data['opt']) {
                        $command = AddedCreditsData::from([
                            'profileId' => (string) $record->id,
                            'userId' => $record->user_id,
                            'credit' => $data['credits'],
                        ]);

                        ProfileAggregate::retrieve($command->userId)
                            ->creditAdded($command);

                        Notification::make()->success()->title('Add credit successfully.');
                    } else {
                        $command = RemovedCreditsData::from([
                            'profileId' => (string) $record->id,
                            'userId' => $record->user_id,
                            'credit' => $data['credits'],
                        ]);

                        ProfileAggregate::retrieve($command->userId)
                            ->creditRemoved($command);

                        Notification::make()->success()->title('Remove credit successfully.');
                    }

                    app(UpdateCreditsField::class)->execute($record->user_id);
                }
            )
            ->form([
                TextInput::make('credits')
                    ->numeric()
                    ->required()
                    ->step(0.1), // Allow decimal values
                Radio::make('opt')
                    ->options([
                        'add' => 'Aggiungi',
                        'remove' => 'Sottrai',
                    ])
                    ->required(),
            ])
            ->label('')
            ->icon('heroicon-o-currency-dollar')
            ->tooltip('Modify Credits')
            ->modalDescription('Inserisci la quantità di crediti da aggiungere o sottrarre')
            ->modalHeading('Modifica Crediti')
            // ->requiresConfirmation()
            ->modalSubmitActionLabel('Modifica');
    }

    public static function getDefaultName(): ?string
    {
        return 'addCredits';
    }
}
