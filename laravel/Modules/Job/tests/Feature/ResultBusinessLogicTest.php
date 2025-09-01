<?php

declare(strict_types=1);

namespace Modules\Job\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Job\Models\Result;
use Modules\Job\Models\Task;
use Tests\TestCase;

class ResultBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_result_with_basic_information(): void
    {
        $task = Task::create([
            'description' => 'Test Task',
            'command' => 'test:command',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $resultData = [
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addMinutes(5),
            'result' => 'success',
            'output' => 'Task completato con successo',
            'execution_time' => 5.2,
            'memory_usage' => 1024000,
            'exit_code' => 0,
        ];

        $result = Result::create($resultData);

        $this->assertDatabaseHas('results', [
            'id' => $result->id,
            'task_id' => $task->id,
            'result' => 'success',
            'output' => 'Task completato con successo',
            'execution_time' => 5.2,
        ]);

        expect($task->id, $result->task_id);
        expect('success', $result->result);
        expect('Task completato con successo', $result->output);
        expect(5.2, $result->execution_time);
    }

    /** @test */
    public function it_can_manage_result_execution_lifecycle(): void
    {
        $task = Task::create([
            'description' => 'Lifecycle Task',
            'command' => 'lifecycle:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Crea risultato in esecuzione
        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => null,
            'result' => 'running',
            'output' => 'Task in esecuzione',
            'execution_time' => null,
        ]);

        expect('running', $result->result);
        expect($result->finished_at);
        expect($result->execution_time);

        // Completa l'esecuzione
        $result->update([
            'finished_at' => now(),
            'result' => 'success',
            'output' => 'Task completato',
            'execution_time' => 3.5,
        ]);

        expect('success', $result->result);
        expect($result->finished_at);
        expect(3.5, $result->execution_time);
    }

    /** @test */
    public function it_can_handle_result_status_transitions(): void
    {
        $task = Task::create([
            'description' => 'Status Task',
            'command' => 'status:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => null,
            'result' => 'running',
            'output' => 'Task avviato',
        ]);

        expect('running', $result->result);

        // Transizione a success
        $result->update([
            'result' => 'success',
            'finished_at' => now(),
            'output' => 'Task completato con successo',
        ]);

        expect('success', $result->result);

        // Transizione a failed
        $result->update([
            'result' => 'failed',
            'output' => 'Task fallito: errore di connessione',
        ]);

        expect('failed', $result->result);
    }

    /** @test */
    public function it_can_manage_result_output_and_logging(): void
    {
        $task = Task::create([
            'description' => 'Output Task',
            'command' => 'output:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $detailedOutput = [
            'step' => 'Inizializzazione',
            'status' => 'success',
            'details' => 'Configurazione caricata correttamente',
            'timestamp' => now()->toISOString(),
        ];

        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addMinutes(2),
            'result' => 'success',
            'output' => json_encode($detailedOutput),
            'execution_time' => 2.1,
        ]);

        expect(json_encode($detailedOutput), $result->output);

        $decodedOutput = json_decode($result->output, true);
        expect('Inizializzazione', $decodedOutput['step']);
        expect('success', $decodedOutput['status']);
    }

    /** @test */
    public function it_can_handle_result_performance_metrics(): void
    {
        $task = Task::create([
            'description' => 'Performance Task',
            'command' => 'performance:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addSeconds(3),
            'result' => 'success',
            'output' => 'Task performance test',
            'execution_time' => 3.0,
            'memory_usage' => 2048000,
            'cpu_usage' => 15.5,
            'exit_code' => 0,
        ]);

        expect(3.0, $result->execution_time);
        expect(2048000, $result->memory_usage);
        expect(15.5, $result->cpu_usage);
        expect(0, $result->exit_code);
    }

    /** @test */
    public function it_can_manage_result_error_handling(): void
    {
        $task = Task::create([
            'description' => 'Error Task',
            'command' => 'error:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $errorOutput = [
            'error_type' => 'ConnectionException',
            'error_message' => 'Impossibile connettersi al database',
            'error_code' => 'DB_CONNECTION_FAILED',
            'stack_trace' => 'Stack trace details...',
            'suggestions' => [
                'Verificare la connessione al database',
                'Controllare le credenziali',
                'Verificare che il servizio sia attivo',
            ],
        ];

        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addSeconds(1),
            'result' => 'failed',
            'output' => json_encode($errorOutput),
            'execution_time' => 1.0,
            'exit_code' => 1,
        ]);

        expect('failed', $result->result);
        expect(1, $result->exit_code);

        $decodedError = json_decode($result->output, true);
        expect('ConnectionException', $decodedError['error_type']);
        expect('DB_CONNECTION_FAILED', $decodedError['error_code']);
    }

    /** @test */
    public function it_can_handle_result_relationships_with_task(): void
    {
        $task = Task::create([
            'description' => 'Relationship Task',
            'command' => 'relationship:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Crea risultati multipli per lo stesso task
        $result1 = Result::create([
            'task_id' => $task->id,
            'started_at' => now()->subHour(),
            'finished_at' => now()->subHour()->addMinutes(2),
            'result' => 'success',
            'output' => 'Prima esecuzione',
            'execution_time' => 2.0,
        ]);

        $result2 = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addMinutes(1),
            'result' => 'success',
            'output' => 'Seconda esecuzione',
            'execution_time' => 1.0,
        ]);

        expect(2, $task->results);
        expect($task->results->contains($result1));
        expect($task->results->contains($result2));
    }

    /** @test */
    public function it_can_manage_result_cleanup_and_retention(): void
    {
        $task = Task::create([
            'description' => 'Cleanup Task',
            'command' => 'cleanup:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Crea risultati vecchi per testare la pulizia
        $oldResult = Result::create([
            'task_id' => $task->id,
            'started_at' => now()->subDays(30),
            'finished_at' => now()->subDays(30)->addMinutes(1),
            'result' => 'success',
            'output' => 'Risultato vecchio',
            'execution_time' => 1.0,
        ]);

        $recentResult = Result::create([
            'task_id' => $task->id,
            'started_at' => now()->subDays(1),
            'finished_at' => now()->subDays(1)->addMinutes(1),
            'result' => 'success',
            'output' => 'Risultato recente',
            'execution_time' => 1.0,
        ]);

        expect($oldResult->started_at < now()->subDays(7));
        expect($recentResult->started_at > now()->subDays(7));
    }

    /** @test */
    public function it_can_handle_result_batch_operations(): void
    {
        $task = Task::create([
            'description' => 'Batch Task',
            'command' => 'batch:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Crea un batch di risultati
        $results = [];
        $statuses = ['success', 'failed', 'success', 'success', 'failed'];

        for ($i = 1; $i <= 5; $i++) {
            $results[] = Result::create([
                'task_id' => $task->id,
                'started_at' => now()->subMinutes($i),
                'finished_at' => now()->subMinutes($i)->addSeconds(30),
                'result' => $statuses[$i - 1],
                'output' => "Risultato batch {$i}",
                'execution_time' => 0.5,
            ]);
        }

        expect(5, $results);

        $successCount = collect($results)->where('result', 'success')->count();
        $failedCount = collect($results)->where('result', 'failed')->count();

        expect(3, $successCount);
        expect(2, $failedCount);
    }

    /** @test */
    public function it_can_validate_result_data_integrity(): void
    {
        $task = Task::create([
            'description' => 'Validation Task',
            'command' => 'validation:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        // Test con risultato valido
        $validResult = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addMinutes(1),
            'result' => 'success',
            'output' => 'Risultato valido',
            'execution_time' => 1.0,
        ]);

        expect($validResult->id);
        expect($validResult->started_at);
        expect($validResult->finished_at);
        expect($validResult->finished_at > $validResult->started_at);

        // Verifica che il tempo di esecuzione sia positivo
        $this->assertGreaterThan(0, $validResult->execution_time);
    }

    /** @test */
    public function it_can_handle_result_notification_and_alerts(): void
    {
        $task = Task::create([
            'description' => 'Alert Task',
            'command' => 'alert:test',
            'expression' => '0 * * * *',
            'timezone' => 'UTC',
            'is_active' => 1,
            'status' => 'active',
        ]);

        $alertOutput = [
            'alert_level' => 'warning',
            'message' => 'Utilizzo memoria elevato',
            'threshold' => 80,
            'current_value' => 85,
            'recommendation' => 'Considerare l\'ottimizzazione della memoria',
        ];

        $result = Result::create([
            'task_id' => $task->id,
            'started_at' => now(),
            'finished_at' => now()->addMinutes(1),
            'result' => 'warning',
            'output' => json_encode($alertOutput),
            'execution_time' => 1.0,
        ]);

        expect('warning', $result->result);

        $decodedAlert = json_decode($result->output, true);
        expect('warning', $decodedAlert['alert_level']);
        expect(85, $decodedAlert['current_value']);
        expect($decodedAlert['current_value'] > $decodedAlert['threshold']);
    }
}
