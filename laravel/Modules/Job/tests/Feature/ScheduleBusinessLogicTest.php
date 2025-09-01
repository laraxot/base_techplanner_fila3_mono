<?php

declare(strict_types=1);

namespace Modules\Job\Tests\Feature;

use Modules\Job\Models\Schedule;
use Modules\Job\Models\ScheduleHistory;

beforeEach(function () {
    // Setup per ogni test se necessario
});

describe('Schedule Business Logic', function () {

    test('can create schedule with basic information', function () {
        $scheduleData = [
            'name' => 'Backup giornaliero',
            'description' => 'Backup automatico del database ogni giorno alle 2:00',
            'cron_expression' => '0 2 * * *',
            'timezone' => 'Europe/Rome',
            'is_active' => 1,
            'max_executions' => 1000,
            'retry_attempts' => 3,
            'retry_delay' => 300,
            'priority' => 'medium',
            'status' => 'active',
        ];

        $schedule = Schedule::create($scheduleData);

        expect($schedule)->toBeInstanceOf(Schedule::class);
        expect($schedule->name)->toBe('Backup giornaliero');
        expect($schedule->cron_expression)->toBe('0 2 * * *');
        expect($schedule->timezone)->toBe('Europe/Rome');
        expect($schedule->is_active)->toBeTrue();

        expect($schedule)->toBeInDatabase('schedules', [
            'id' => $schedule->id,
            'name' => 'Backup giornaliero',
            'description' => 'Backup automatico del database ogni giorno alle 2:00',
            'cron_expression' => '0 2 * * *',
            'timezone' => 'Europe/Rome',
            'is_active' => 1,
        ]);
    });

    test('can manage schedule activation and deactivation', function () {
        $schedule = Schedule::create([
            'name' => 'Test Schedule',
            'description' => 'Test Description',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($schedule->is_active)->toBeTrue();
        expect($schedule->status)->toBe('active');

        // Disattiva lo schedule
        $schedule->update([
            'is_active' => 0,
            'status' => 'inactive',
        ]);

        expect($schedule->is_active)->toBeFalse();
        expect($schedule->status)->toBe('inactive');
    });

    test('can handle schedule cron expressions', function () {
        $dailySchedule = Schedule::create([
            'name' => 'Daily Schedule',
            'description' => 'Eseguito ogni giorno',
            'cron_expression' => '0 9 * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $weeklySchedule = Schedule::create([
            'name' => 'Weekly Schedule',
            'description' => 'Eseguito ogni lunedì',
            'cron_expression' => '0 10 * * 1',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $monthlySchedule = Schedule::create([
            'name' => 'Monthly Schedule',
            'description' => 'Eseguito il primo del mese',
            'cron_expression' => '0 8 1 * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($dailySchedule->cron_expression)->toBe('0 9 * * *');
        expect($weeklySchedule->cron_expression)->toBe('0 10 * * 1');
        expect($monthlySchedule->cron_expression)->toBe('0 8 1 * *');
    });

    test('can manage schedule execution limits', function () {
        $schedule = Schedule::create([
            'name' => 'Limited Schedule',
            'description' => 'Schedule con limiti di esecuzione',
            'cron_expression' => '*/15 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'max_executions' => 100,
            'retry_attempts' => 5,
            'retry_delay' => 600,
        ]);

        expect($schedule->max_executions)->toBe(100);
        expect($schedule->retry_attempts)->toBe(5);
        expect($schedule->retry_delay)->toBe(600);
    });

    test('can handle schedule priority management', function () {
        $highPrioritySchedule = Schedule::create([
            'name' => 'High Priority',
            'description' => 'Schedule alta priorità',
            'cron_expression' => '*/5 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'priority' => 'high',
        ]);

        $mediumPrioritySchedule = Schedule::create([
            'name' => 'Medium Priority',
            'description' => 'Schedule media priorità',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'priority' => 'medium',
        ]);

        $lowPrioritySchedule = Schedule::create([
            'name' => 'Low Priority',
            'description' => 'Schedule bassa priorità',
            'cron_expression' => '0 2 * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'priority' => 'low',
        ]);

        expect($highPrioritySchedule->priority)->toBe('high');
        expect($mediumPrioritySchedule->priority)->toBe('medium');
        expect($lowPrioritySchedule->priority)->toBe('low');
    });

    test('can manage schedule timezone handling', function () {
        $romeSchedule = Schedule::create([
            'name' => 'Rome Schedule',
            'description' => 'Schedule fuso orario Roma',
            'cron_expression' => '0 9 * * 1',
            'timezone' => 'Europe/Rome',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $utcSchedule = Schedule::create([
            'name' => 'UTC Schedule',
            'description' => 'Schedule UTC',
            'cron_expression' => '0 9 * * 1',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $tokyoSchedule = Schedule::create([
            'name' => 'Tokyo Schedule',
            'description' => 'Schedule fuso orario Tokyo',
            'cron_expression' => '0 9 * * 1',
            'timezone' => 'Asia/Tokyo',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($romeSchedule->timezone)->toBe('Europe/Rome');
        expect($utcSchedule->timezone)->toBe('UTC');
        expect($tokyoSchedule->timezone)->toBe('Asia/Tokyo');
    });

    test('can handle schedule status transitions', function () {
        $schedule = Schedule::create([
            'name' => 'Status Test Schedule',
            'description' => 'Test transizioni stato',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($schedule->status)->toBe('active');

        // Cambia stato a pausa
        $schedule->update(['status' => 'paused']);
        expect($schedule->status)->toBe('paused');

        // Cambia stato a errore
        $schedule->update(['status' => 'error']);
        expect($schedule->status)->toBe('error');

        // Cambia stato a manutenzione
        $schedule->update(['status' => 'maintenance']);
        expect($schedule->status)->toBe('maintenance');

        // Ripristina stato attivo
        $schedule->update(['status' => 'active']);
        expect($schedule->status)->toBe('active');
    });

    test('can manage schedule history and logging', function () {
        $schedule = Schedule::create([
            'name' => 'History Test Schedule',
            'description' => 'Test cronologia esecuzioni',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Crea cronologia esecuzioni
        $history1 = ScheduleHistory::create([
            'schedule_id' => $schedule->id,
            'executed_at' => now()->subHour(),
            'status' => 'success',
            'output' => 'Esecuzione completata con successo',
            'execution_time' => 5.2,
        ]);

        $history2 = ScheduleHistory::create([
            'schedule_id' => $schedule->id,
            'executed_at' => now(),
            'status' => 'running',
            'output' => 'Esecuzione in corso',
            'execution_time' => null,
        ]);

        expect($schedule->scheduleHistories)->toHaveCount(2);
        expect($schedule->scheduleHistories->contains($history1))->toBeTrue();
        expect($schedule->scheduleHistories->contains($history2))->toBeTrue();
    });

    test('can handle schedule retry logic', function () {
        $schedule = Schedule::create([
            'name' => 'Retry Test Schedule',
            'description' => 'Test logica retry',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'retry_attempts' => 3,
            'retry_delay' => 300,
        ]);

        expect($schedule->retry_attempts)->toBe(3);
        expect($schedule->retry_delay)->toBe(300);

        // Simula fallimento e retry
        $schedule->update(['status' => 'failed']);
        expect($schedule->status)->toBe('failed');

        // Simula retry
        $schedule->update(['status' => 'retrying']);
        expect($schedule->status)->toBe('retrying');
    });

    test('can handle schedule execution tracking', function () {
        $schedule = Schedule::create([
            'name' => 'Execution Test Schedule',
            'description' => 'Test tracking esecuzioni',
            'cron_expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
            'max_executions' => 1000,
        ]);

        expect($schedule->max_executions)->toBe(1000);

        // Simula esecuzioni multiple
        for ($i = 1; $i <= 5; $i++) {
            ScheduleHistory::create([
                'schedule_id' => $schedule->id,
                'executed_at' => now()->subMinutes($i * 10),
                'status' => 'success',
                'output' => "Esecuzione {$i} completata",
                'execution_time' => rand(1, 10),
            ]);
        }

        expect($schedule->scheduleHistories)->toHaveCount(5);
    });

    test('can handle schedule validation and constraints', function () {
        // Schedule con espressione cron valida
        $validSchedule = Schedule::create([
            'name' => 'Valid Schedule',
            'description' => 'Schedule valido',
            'cron_expression' => '0 9 * * 1-5',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($validSchedule->id)->not->toBeNull();

        // Schedule con espressione cron complessa
        $complexSchedule = Schedule::create([
            'name' => 'Complex Schedule',
            'description' => 'Schedule con espressione complessa',
            'cron_expression' => '0 9-17 * * 1-5',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        expect($complexSchedule->id)->not->toBeNull();
    });

    test('can handle schedule batch operations', function () {
        // Crea un batch di schedule
        $batchSchedules = [];
        $priorities = ['high', 'medium', 'low'];

        for ($i = 1; $i <= 3; $i++) {
            $batchSchedules[] = Schedule::create([
                'name' => "Batch Schedule {$i}",
                'description' => "Schedule batch numero {$i}",
                'cron_expression' => "0 {$i} * * *",
                'timezone' => 'UTC',
                'is_active' => 1,
                'status' => 'active',
                'priority' => $priorities[$i - 1],
            ]);
        }

        expect($batchSchedules)->toHaveCount(3);

        foreach ($batchSchedules as $index => $schedule) {
            expect($schedule->name)->toBe('Batch Schedule '.($index + 1));
            expect($schedule->cron_expression)->toBe('0 '.($index + 1).' * * *');
            expect($schedule->priority)->toBe($priorities[$index]);
        }
    });

});
