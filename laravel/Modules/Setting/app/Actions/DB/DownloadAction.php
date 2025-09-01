<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Setting\Actions\DB;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Process as LaravelProcess;
use Illuminate\Support\Facades\Storage;
use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $connectionName): BinaryFileResponse
    {
        /**
         * @var array
         */
        $db = config('database.connections.'.$connectionName);
        $filename = 'backup-'.$connectionName.'-'.Carbon::now()->format('Y-m-d').'.gz';
        $backup_path = Storage::disk('cache')->path('backup/'.$filename);
        $backup_path = app(\Modules\Xot\Actions\File\FixPathAction::class)->execute($backup_path);
        app(\Modules\Xot\Actions\File\CreateDirectoryForFilenameAction::class)->execute($backup_path);
        $command = sprintf('mysqldump --user=%s --password=%s %s | gzip > %s', $db['username'], $db['password'], $db['database'], $backup_path);
        LaravelProcess::run($command);

        return response()->download($backup_path);
    }
}
