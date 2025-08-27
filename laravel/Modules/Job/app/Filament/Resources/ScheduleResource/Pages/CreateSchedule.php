<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\ScheduleResource\Pages;

use Filament\Forms\Form;
use Webmozart\Assert\Assert;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Modules\Job\Filament\Resources\ScheduleResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateSchedule extends XotBaseCreateRecord
{

    public Collection $commands;

    protected static string $resource = ScheduleResource::class;

    public function getformSchema(): array
    {
        Assert::isArray($res = $this->getResource()::getFormSchema());

        return $res;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema());
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

   
}
