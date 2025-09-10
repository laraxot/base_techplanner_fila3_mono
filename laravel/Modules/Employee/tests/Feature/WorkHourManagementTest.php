<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Feature;

use Carbon\Carbon;
<<<<<<< HEAD
use Modules\Employee\Enums\WorkHourTypeEnum;
=======
>>>>>>> cda86dd (.)
use Modules\Employee\Models\WorkHour;

beforeEach(function () {
    $this->employee = createEmployee();
    $this->today = Carbon::today();
});

describe('Work Hour Management Business Logic', function () {

    test('employee can clock in at start of day', function () {
        $clockIn = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect($clockIn->isClockIn())->toBeTrue();
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_in');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::BREAK_START);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_BREAK_START);
>>>>>>> cda86dd (.)
    });

    test('employee can take break after clocking in', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        $breakStart = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        expect($breakStart->isBreakStart())->toBeTrue();
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('on_break');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::BREAK_END);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_BREAK_END);
>>>>>>> cda86dd (.)
    });

    test('employee can end break and resume work', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        $breakEnd = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(13, 0),
        ]);

        expect($breakEnd->isBreakEnd())->toBeTrue();
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_in');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::CLOCK_OUT);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_CLOCK_OUT);
>>>>>>> cda86dd (.)
    });

    test('employee can clock out at end of day', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(13, 0),
        ]);

        $clockOut = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(17, 0),
        ]);

        expect($clockOut->isClockOut())->toBeTrue();
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_out');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::CLOCK_IN);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_CLOCK_IN);
>>>>>>> cda86dd (.)
    });

    test('calculates correct worked hours with break', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(13, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(17, 0),
        ]);

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(7.0);
    });

    test('calculates correct worked hours without break', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(17, 0),
        ]);

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(8.0);
    });

    test('validates correct entry sequence', function () {
<<<<<<< HEAD
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::CLOCK_IN))->toBeTrue();

        createWorkHour([
            'employee_id' => $this->employee->id,
            'type' => WorkHourTypeEnum::CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::BREAK_START))->toBeTrue();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::CLOCK_OUT))->toBeFalse();
    });

    test('prevents invalid entry sequences', function () {
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::BREAK_START))->toBeFalse();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::CLOCK_OUT))->toBeFalse();
=======
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_IN))->toBeTrue();

        createWorkHour([
            'employee_id' => $this->employee->id,
            'type' => WorkHour::TYPE_CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_BREAK_START))->toBeTrue();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT))->toBeFalse();
    });

    test('prevents invalid entry sequences', function () {
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_BREAK_START))->toBeFalse();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT))->toBeFalse();
>>>>>>> cda86dd (.)
    });

    test('gets today entries in chronological order', function () {
        $clockIn = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        $breakStart = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        $todayEntries = WorkHour::getTodayEntries($this->employee->id, $this->today);

        expect($todayEntries)->toHaveCount(2);
        expect($todayEntries->first()->id)->toBe($clockIn->id);
        expect($todayEntries->last()->id)->toBe($breakStart->id);
    });

    test('multiple employees can have independent work hours', function () {
        $employee2 = createEmployee();

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $employee2->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(10, 0),
        ]);

        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_in');
        expect(WorkHour::getCurrentStatus($employee2->id))->toBe('clocked_in');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::BREAK_START);
        expect(WorkHour::getNextAction($employee2->id))->toBe(WorkHourTypeEnum::BREAK_START);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_BREAK_START);
        expect(WorkHour::getNextAction($employee2->id))->toBe(WorkHour::TYPE_BREAK_START);
>>>>>>> cda86dd (.)
    });

    test('handles empty work hour records', function () {
        expect(WorkHour::calculateWorkedHours($this->employee->id, $this->today))->toBe(0.0);
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('not_clocked_in');
<<<<<<< HEAD
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHourTypeEnum::CLOCK_IN);
=======
        expect(WorkHour::getNextAction($this->employee->id))->toBe(WorkHour::TYPE_CLOCK_IN);
>>>>>>> cda86dd (.)
    });

    test('filters work hours by date correctly', function () {
        $yesterday = $this->today->copy()->subDay();

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $yesterday->setTime(9, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        $todayEntries = WorkHour::getTodayEntries($this->employee->id, $this->today);
        $yesterdayEntries = WorkHour::getTodayEntries($this->employee->id, $yesterday);

        expect($todayEntries)->toHaveCount(1);
        expect($yesterdayEntries)->toHaveCount(1);
    });
});
