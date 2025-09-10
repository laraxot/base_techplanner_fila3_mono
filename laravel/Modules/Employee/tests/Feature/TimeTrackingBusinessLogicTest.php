<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Feature;

use Carbon\Carbon;
<<<<<<< HEAD
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
=======
>>>>>>> cda86dd (.)
use Modules\Employee\Models\WorkHour;

beforeEach(function () {
    $this->employee = createEmployee();
    $this->today = Carbon::today();
});

describe('Time Tracking Business Logic', function () {

    test('calculates accurate worked hours with multiple breaks', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(8, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(10, 30),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(10, 45),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 30),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(13, 30),
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

        expect($workedHours)->toBe(6.0);
    });

    test('handles incomplete work day correctly', function () {
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

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(3.0);
    });

    test('handles missing clock out after break end', function () {
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

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(3.0);
    });

    test('calculates partial hours correctly', function () {
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
            'timestamp' => $this->today->copy()->setTime(13, 30),
        ]);

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(4.5);
    });

    test('handles work across midnight boundary', function () {
        $today = Carbon::create(2024, 1, 15, 0, 0, 0);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $today->copy()->setTime(22, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $today->copy()->addDay()->setTime(6, 0),
        ]);

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $today);

        expect($workedHours)->toBe(2.0);
    });

    test('validates work hour sequence rules', function () {
<<<<<<< HEAD
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::CLOCK_IN))->toBeTrue();

        createWorkHour([
            'employee_id' => $this->employee->id,
            'type' => WorkHourTypeEnum::CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::BREAK_START))->toBeTrue();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::BREAK_END))->toBeFalse();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHourTypeEnum::CLOCK_OUT))->toBeFalse();
=======
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_IN))->toBeTrue();

        createWorkHour([
            'employee_id' => $this->employee->id,
            'type' => WorkHour::TYPE_CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_BREAK_START))->toBeTrue();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_BREAK_END))->toBeFalse();
        expect(WorkHour::isValidNextEntry($this->employee->id, WorkHour::TYPE_CLOCK_OUT))->toBeFalse();
>>>>>>> cda86dd (.)
    });

    test('handles overtime calculation', function () {
        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(8, 0),
        ]);

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(20, 0),
        ]);

        $workedHours = WorkHour::calculateWorkedHours($this->employee->id, $this->today);

        expect($workedHours)->toBe(12.0);
    });

    test('gets last entry for employee on specific date', function () {
        $early = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        $late = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(17, 0),
        ]);

        $lastEntry = WorkHour::getLastEntryForEmployee($this->employee->id, $this->today);

        expect($lastEntry->id)->toBe($late->id);
<<<<<<< HEAD
        expect($lastEntry->type)->toBe(WorkHourTypeEnum::CLOCK_OUT);
=======
        expect($lastEntry->type)->toBe(WorkHour::TYPE_CLOCK_OUT);
>>>>>>> cda86dd (.)
    });

    test('determines current employee status correctly', function () {
        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('not_clocked_in');

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
        ]);

        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_in');

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_START,
=======
            'type' => WorkHour::TYPE_BREAK_START,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(12, 0),
        ]);

        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('on_break');

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::BREAK_END,
=======
            'type' => WorkHour::TYPE_BREAK_END,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(13, 0),
        ]);

        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_in');

        createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_OUT,
=======
            'type' => WorkHour::TYPE_CLOCK_OUT,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(17, 0),
        ]);

        expect(WorkHour::getCurrentStatus($this->employee->id))->toBe('clocked_out');
    });

    test('handles work hours with geographic location data', function () {
        $workHour = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
            'location_lat' => 45.4642,
            'location_lng' => 9.1900,
            'location_name' => 'Milan Office',
        ]);

        expect($workHour->location_lat)->toBe(45.4642);
        expect($workHour->location_lng)->toBe(9.1900);
        expect($workHour->location_name)->toBe('Milan Office');
    });

    test('handles work hours with device information', function () {
        $deviceInfo = [
            'browser' => 'Chrome',
            'version' => '91.0',
            'platform' => 'Windows',
            'ip_address' => '192.168.1.1',
        ];

        $workHour = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
>>>>>>> cda86dd (.)
            'timestamp' => $this->today->copy()->setTime(9, 0),
            'device_info' => $deviceInfo,
        ]);

        expect($workHour->device_info)->toBe($deviceInfo);
        expect($workHour->device_info['browser'])->toBe('Chrome');
    });

    test('handles work hour approval workflow', function () {
        $workHour = createWorkHour([
            'employee_id' => $this->employee->id,
<<<<<<< HEAD
            'type' => WorkHourTypeEnum::CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
            'status' => WorkHourStatusEnum::PENDING,
        ]);

        expect($workHour->status)->toBe(WorkHourStatusEnum::PENDING);

        $workHour->status = WorkHourStatusEnum::APPROVED;
        $workHour->approved_at = now();
        $workHour->save();

        expect($workHour->fresh()->status)->toBe(WorkHourStatusEnum::APPROVED);
=======
            'type' => WorkHour::TYPE_CLOCK_IN,
            'timestamp' => $this->today->copy()->setTime(9, 0),
            'status' => WorkHour::STATUS_PENDING,
        ]);

        expect($workHour->status)->toBe(WorkHour::STATUS_PENDING);

        $workHour->status = WorkHour::STATUS_APPROVED;
        $workHour->approved_at = now();
        $workHour->save();

        expect($workHour->fresh()->status)->toBe(WorkHour::STATUS_APPROVED);
>>>>>>> cda86dd (.)
        expect($workHour->fresh()->approved_at)->not->toBeNull();
    });
});
