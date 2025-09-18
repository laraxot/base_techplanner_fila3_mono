<?php

/**
 * @see https://gitlab.com/amvisor/filament-failed-jobs/-/blob/master/src/resources/FailedJobsResource/Pages/ListFailedJobs.php?ref_type=heads
 */

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\FailedJobResource\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Artisan;
use Modules\Job\Filament\Resources\FailedJobResource;
use Modules\Job\Models\FailedJob;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListFailedJobs extends XotBaseListRecords
{
    protected static string $resource = FailedJobResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function getTableColumns(): array
    {
        /** @var array<string, \Filament\Tables\Columns\Column> */
=======
    public function getListTableColumns(): array
    {
>>>>>>> de0f89b5 (.)
=======
    public function getListTableColumns(): array
    {
>>>>>>> 2e199498 (.)
=======
    public function getListTableColumns(): array
    {
>>>>>>> eaeb6531 (.)
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),
            'uuid' => TextColumn::make('uuid')
                ->searchable()
                ->sortable()
                ->copyable(),
            'connection' => TextColumn::make('connection')
                ->searchable()
                ->sortable(),
            'queue' => TextColumn::make('queue')
                ->searchable()
                ->sortable(),
            'payload' => TextColumn::make('payload')
                ->searchable()
                ->wrap()
                ->limit(50),
            'exception' => TextColumn::make('exception')
                ->searchable()
                ->wrap()
                ->limit(100),
            'failed_at' => TextColumn::make('failed_at')
                ->dateTime()
                ->sortable(),
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * @return array<string, \Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        /** @var array<string, \Filament\Actions\Action> */
        return [
            'retry_all' => Action::make('retry_all')
=======
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
    protected function getHeaderActions(): array
    {
        return [
            Action::make('retry_all')
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
                ->requiresConfirmation()
                ->action(
                    static function (): void {
                        Artisan::call('queue:retry all');
                        Notification::make()
                            ->title('All failed jobs have been pushed back onto the queue.')
                            ->success()
                            ->send();
                    }
                ),

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            'delete_all' => Action::make('delete_all')
=======
            Action::make('delete_all')
>>>>>>> de0f89b5 (.)
=======
            Action::make('delete_all')
>>>>>>> 2e199498 (.)
=======
            Action::make('delete_all')
>>>>>>> eaeb6531 (.)
                ->requiresConfirmation()
                ->color('danger')
                ->action(
                    static function (): void {
                        FailedJob::truncate();
                        Notification::make()
                            ->title('All failed jobs have been removed.')
                            ->success()
                            ->send();
                    }
                ),
        ];
    }
}
