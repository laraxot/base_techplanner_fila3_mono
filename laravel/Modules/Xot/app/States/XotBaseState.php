<?php

declare(strict_types=1);

namespace Modules\Xot\States;

use Filament\Forms\Components;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> 68b3eda (.)
use Modules\Xot\Contracts\StateContract;
use Modules\Xot\Filament\Traits\TransTrait;
use Spatie\ModelStates\State;

/**
 * Abstract base class for appointment state management.
 *
 * Defines the state machine configuration and required methods
 * that must be implemented by each concrete state class.
 *
<<<<<<< HEAD
 * @property string $name Il nome dello stato
=======
 * @property string $name  Il nome dello stato
>>>>>>> 68b3eda (.)
 * @property string $value Il valore dello stato nel database
 */
abstract class XotBaseState extends State implements StateContract
{
    use TransTrait;

    public static string $name;

    public static function getName(): string
    {
        /* @phpstan-ignore-next-line */
        return static::$name ?? Str::of(class_basename(static::class))->snake()->toString();
    }

    public function label(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.label');
<<<<<<< HEAD
=======
        // return 'Annullato';
>>>>>>> 68b3eda (.)
    }

    public function color(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.color');
    }

    public function bgColor(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.bg_color');
<<<<<<< HEAD
=======
        // return 'info';
>>>>>>> 68b3eda (.)
    }

    public function icon(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.icon');
<<<<<<< HEAD
=======
        // return 'heroicon-o-x-circle';
>>>>>>> 68b3eda (.)
    }

    public function modalHeading(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.modal_heading');
<<<<<<< HEAD
=======
        // return 'Annulla Appuntamento';
>>>>>>> 68b3eda (.)
    }

    public function modalDescription(): string
    {
<<<<<<< HEAD
        return static::transClass(static::class, 'states.'.static::getName().'.modal_description');
=======
        $appointment = $this->getModel();

        return static::transClass(static::class, 'states.'.static::getName().'.modal_description');
        // return 'Sei sicuro di voler annullare questo appuntamento?';
>>>>>>> 68b3eda (.)
    }

    /**
     * @return array<string, Components\Component>
     */
    public function modalFormSchema(): array
    {
        return [
            'message' => Components\Textarea::make('message')
                ->required()
                ->maxLength(255),
        ];
    }

    /**
     * Fill form data for modal.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function modalFillForm(array $arguments, array $data): array
    {
        return $data;
    }

    /**
     * Fill form data for modal by record.
     *
     * @return array<string, mixed>
     */
    public function modalFillFormByRecord(Model $record): array
    {
        return [];
    }

    /**
     * Execute modal action.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     */
    public function modalAction(array $arguments, array $data): void
    {
        $this->processStateAction($arguments, $data);
    }

    /**
     * Process state action.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     */
    public function processStateAction(array $arguments, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
<<<<<<< HEAD
        
        $record = $this->getModel();
        /** @phpstan-ignore-next-line */
=======
        /*

        $appointmentId = $arguments['appointment'];
        $appointment = Appointment::firstWhere('id',$appointmentId);

        $appointment?->state->transitionTo($stateClass,$message);
        */
        $record = $this->getModel();
        /* @phpstan-ignore-next-line */
>>>>>>> 68b3eda (.)
        $record->state->transitionTo($stateClass, $message);
    }

    /**
     * Execute modal action by record.
     *
     * @param array<string, mixed> $data
     */
    public function modalActionByRecord(Model $record, array $data): void
    {
        $this->processStateActionByRecord($record, $data);
    }

    /**
     * Process state action by record.
     *
     * @param array<string, mixed> $data
     */
    public function processStateActionByRecord(Model $record, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
<<<<<<< HEAD
        
        /** @phpstan-ignore-next-line */
=======
        /*

        $appointmentId = $arguments['appointment'];
        $appointment = Appointment::firstWhere('id',$appointmentId);

        $appointment?->state->transitionTo($stateClass,$message);
        */
        /* @phpstan-ignore-next-line */
>>>>>>> 68b3eda (.)
        $record->state->transitionTo($stateClass, $message);
    }

    public function isMessageRequired(): bool
    {
        return false;
    }

    public static function getOptions(): array
    {
        $states = static::getStateMapping()->toArray();

        $states = Arr::map($states, function ($stateClass, $state) {
            return static::transClass(static::class, 'states.'.$state.'.label');
        });

        return $states;
    }
}
