<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Pages;

use Carbon\Carbon;
use Filament\Notifications\Notification;
<<<<<<< HEAD
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
=======
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

>>>>>>> cda86dd (.)
class CreateWorkHour extends XotBaseCreateRecord
{
    protected static string $resource = WorkHourResource::class;

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
        /** @var string */
=======
>>>>>>> cda86dd (.)
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default status if not provided
<<<<<<< HEAD
        if (!isset($data['status'])) {
            $data['status'] = WorkHourStatusEnum::PENDING->value;
=======
        if (! isset($data['status'])) {
            $data['status'] = WorkHour::STATUS_PENDING;
>>>>>>> cda86dd (.)
        }

        return $data;
    }

    protected function beforeCreate(): void
    {
        $data = $this->form->getState();
<<<<<<< HEAD
        
        $timestamp = Carbon::parse((string) ($data['timestamp'] ?? ''));
        $employeeId = (int) ($data['employee_id'] ?? 0);
        
        $existingEntry = WorkHour::query()
            ->where('employee_id', $employeeId)
=======

        // Validate if this entry is allowed based on the last entry
        $timestamp = Carbon::parse($data['timestamp']);
        $lastEntry = WorkHour::getLastEntryForEmployee($data['employee_id'], $timestamp);
        $expectedAction = WorkHour::getNextAction($data['employee_id'], $timestamp);

        if ($data['type'] !== $expectedAction) {
            $lastEntryType = $lastEntry ? match ($lastEntry->type) {
                WorkHour::TYPE_CLOCK_IN => 'Clock In',
                WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
                WorkHour::TYPE_BREAK_START => 'Break Start',
                WorkHour::TYPE_BREAK_END => 'Break End',
                default => $lastEntry->type,
            } : 'None';

            $expectedActionLabel = match ($expectedAction) {
                WorkHour::TYPE_CLOCK_IN => 'Clock In',
                WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
                WorkHour::TYPE_BREAK_START => 'Break Start',
                WorkHour::TYPE_BREAK_END => 'Break End',
                default => $expectedAction,
            };

            Notification::make()
                ->title('Invalid Entry Sequence')
                ->body("Last entry was: {$lastEntryType}. Expected next action: {$expectedActionLabel}")
                ->danger()
                ->send();

            $this->halt();
        }

        // Check for duplicate entries within the same minute
        $existingEntry = WorkHour::where('employee_id', $data['employee_id'])
>>>>>>> cda86dd (.)
            ->where('timestamp', $timestamp)
            ->where('type', $data['type'])
            ->first();

        if ($existingEntry) {
            Notification::make()
                ->title('Duplicate Entry')
                ->body('An entry with the same timestamp and type already exists for this employee.')
                ->danger()
                ->send();

            $this->halt();
        }
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Work hour entry created successfully';
    }
}
