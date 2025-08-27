<?php

/**
 * @see https://gitlab.com/amvisor/filament-failed-jobs/-/blob/master/src/resources/JobBatchesResource/Pages/ListJobBatches.php?ref_type=heads
 */

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\JobBatchResource\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Artisan;
use Modules\Job\Filament\Resources\JobBatchResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

class ListJobBatches extends XotBaseListRecords
{
    protected static string $resource = JobBatchResource::class;


    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [];
    }

    /**
     * @return array<string, Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('prune_batches')
                ->requiresConfirmation()
                ->color('danger')
                ->action(
                    static function (): void {
                        Artisan::call('queue:prune-batches');
                        Notification::make()
                            ->title('All batches have been pruned.')
                            ->success()
                            ->send();
                    }
                ),
        ];
    }
}
