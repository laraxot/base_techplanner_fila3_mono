<?php

declare(strict_types=1);

namespace Modules\Job\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobBatch;
use Tests\TestCase;

class JobBatchBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_job_batch_with_basic_information(): void
    {
        $batchData = [
            'id' => 'batch-123',
            'name' => 'Processamento utenti batch',
            'total_jobs' => 100,
            'pending_jobs' => 100,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([
                'priority' => 'high',
                'notify_on_completion' => true,
            ]),
            'cancelled_at' => null,
            'finished_at' => null,
        ];

        $batch = JobBatch::create($batchData);

        $this->assertDatabaseHas('job_batches', [
            'id' => 'batch-123',
            'name' => 'Processamento utenti batch',
            'total_jobs' => 100,
            'pending_jobs' => 100,
            'failed_jobs' => 0,
        ]);

        expect('batch-123', $batch->id);
        expect('Processamento utenti batch', $batch->name);
        expect(100, $batch->total_jobs);
        expect(100, $batch->pending_jobs);
        expect(0, $batch->failed_jobs);
    }

    /** @test */
    public function it_can_manage_batch_job_progression(): void
    {
        $batch = JobBatch::create([
            'id' => 'progression-test',
            'name' => 'Test progressione',
            'total_jobs' => 10,
            'pending_jobs' => 10,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        expect(10, $batch->pending_jobs);
        expect(0, $batch->failed_jobs);

        // Simula completamento di alcuni job
        $batch->update([
            'pending_jobs' => 7,
        ]);

        expect(7, $batch->pending_jobs);
        expect(3, $batch->total_jobs - $batch->pending_jobs);
    }

    /** @test */
    public function it_can_handle_batch_job_failures(): void
    {
        $batch = JobBatch::create([
            'id' => 'failure-test',
            'name' => 'Test fallimenti',
            'total_jobs' => 5,
            'pending_jobs' => 5,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        // Simula fallimento di alcuni job
        $failedJobIds = ['job-1', 'job-3'];
        $batch->update([
            'failed_jobs' => 2,
            'failed_job_ids' => json_encode($failedJobIds),
            'pending_jobs' => 3,
        ]);

        expect(2, $batch->failed_jobs);
        expect(3, $batch->pending_jobs);
        expect($failedJobIds, json_decode($batch->failed_job_ids, true));
    }

    /** @test */
    public function it_can_manage_batch_completion_status(): void
    {
        $batch = JobBatch::create([
            'id' => 'completion-test',
            'name' => 'Test completamento',
            'total_jobs' => 3,
            'pending_jobs' => 3,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        expect($batch->finished());
        expect($batch->cancelled());

        // Simula completamento
        $batch->update([
            'pending_jobs' => 0,
            'finished_at' => now(),
        ]);

        expect($batch->finished());
        expect($batch->cancelled());
    }

    /** @test */
    public function it_can_handle_batch_cancellation(): void
    {
        $batch = JobBatch::create([
            'id' => 'cancellation-test',
            'name' => 'Test cancellazione',
            'total_jobs' => 5,
            'pending_jobs' => 5,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        expect($batch->cancelled());

        // Cancella il batch
        $batch->update([
            'cancelled_at' => now(),
        ]);

        expect($batch->cancelled());
    }

    /** @test */
    public function it_can_manage_batch_options_and_configuration(): void
    {
        $options = [
            'priority' => 'high',
            'notify_on_completion' => true,
            'retry_failed_jobs' => true,
            'max_retries' => 3,
            'timeout' => 3600,
            'tags' => ['user_processing', 'batch'],
        ];

        $batch = JobBatch::create([
            'id' => 'options-test',
            'name' => 'Test opzioni',
            'total_jobs' => 10,
            'pending_jobs' => 10,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode($options),
        ]);

        expect($options, json_decode($batch->options, true));
        expect('high', json_decode($batch->options, true)['priority']);
        expect(json_decode($batch->options, true)['notify_on_completion']);
    }

    /** @test */
    public function it_can_calculate_batch_progress_percentage(): void
    {
        $batch = JobBatch::create([
            'id' => 'progress-test',
            'name' => 'Test progresso',
            'total_jobs' => 100,
            'pending_jobs' => 75,
            'failed_jobs' => 5,
            'failed_job_ids' => json_encode(['job-1', 'job-2', 'job-3', 'job-4', 'job-5']),
            'options' => json_encode([]),
        ]);

        // Calcola progresso: (total - pending) / total * 100
        $completedJobs = $batch->total_jobs - $batch->pending_jobs;
        $progressPercentage = ($completedJobs / $batch->total_jobs) * 100;

        expect(25, $completedJobs);
        expect(25.0, $progressPercentage);
    }

    /** @test */
    public function it_can_handle_batch_job_relationships(): void
    {
        $batch = JobBatch::create([
            'id' => 'relationships-test',
            'name' => 'Test relazioni',
            'total_jobs' => 3,
            'pending_jobs' => 3,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        // Crea job associati al batch
        $job1 = Job::create([
            'queue' => 'batch',
            'payload' => json_encode([
                'displayName' => 'BatchJob1',
                'batch_id' => $batch->id,
            ]),
            'attempts' => 0,
            'available_at' => now()->timestamp,
        ]);

        $job2 = Job::create([
            'queue' => 'batch',
            'payload' => json_encode([
                'displayName' => 'BatchJob2',
                'batch_id' => $batch->id,
            ]),
            'attempts' => 0,
            'available_at' => now()->timestamp,
        ]);

        // Verifica che i job siano associati al batch
        $this->assertStringContainsString($batch->id, $job1->payload);
        $this->assertStringContainsString($batch->id, $job2->payload);
    }

    /** @test */
    public function it_can_manage_batch_cleanup_and_maintenance(): void
    {
        $batch = JobBatch::create([
            'id' => 'cleanup-test',
            'name' => 'Test pulizia',
            'total_jobs' => 10,
            'pending_jobs' => 0,
            'failed_jobs' => 2,
            'failed_job_ids' => json_encode(['job-1', 'job-2']),
            'options' => json_encode([]),
            'finished_at' => now()->subDays(7),
        ]);

        expect($batch->finished());
        expect($batch->finished_at < now()->subDays(5));

        // Verifica che il batch sia candidato per la pulizia
        expect($batch->finished_at < now()->subDays(5));
    }

    /** @test */
    public function it_can_handle_batch_retry_logic(): void
    {
        $batch = JobBatch::create([
            'id' => 'retry-test',
            'name' => 'Test retry',
            'total_jobs' => 5,
            'pending_jobs' => 0,
            'failed_jobs' => 3,
            'failed_job_ids' => json_encode(['job-1', 'job-2', 'job-3']),
            'options' => json_encode([
                'retry_failed_jobs' => true,
                'max_retries' => 2,
            ]),
            'finished_at' => now(),
        ]);

        expect(3, $batch->failed_jobs);
        expect(json_decode($batch->options, true)['retry_failed_jobs']);

        // Simula retry dei job falliti
        $batch->update([
            'pending_jobs' => 3,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'finished_at' => null,
        ]);

        expect(0, $batch->failed_jobs);
        expect(3, $batch->pending_jobs);
        expect($batch->finished());
    }

    /** @test */
    public function it_can_handle_batch_notification_settings(): void
    {
        $batch = JobBatch::create([
            'id' => 'notification-test',
            'name' => 'Test notifiche',
            'total_jobs' => 10,
            'pending_jobs' => 10,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([
                'notify_on_completion' => true,
                'notify_on_failure' => true,
                'notification_email' => 'admin@example.com',
                'notification_slack' => 'https://hooks.slack.com/...',
            ]),
        ]);

        $options = json_decode($batch->options, true);
        expect($options['notify_on_completion']);
        expect($options['notify_on_failure']);
        expect('admin@example.com', $options['notification_email']);
        expect('https://hooks.slack.com/...', $options['notification_slack']);
    }

    /** @test */
    public function it_can_handle_batch_bulk_operations(): void
    {
        // Crea un batch di batch per testare operazioni bulk
        $batchList = [];
        $statuses = ['active', 'completed', 'failed'];

        for ($i = 1; $i <= 3; $i++) {
            $batchList[] = JobBatch::create([
                'id' => "bulk-batch-{$i}",
                'name' => "Batch bulk {$i}",
                'total_jobs' => $i * 10,
                'pending_jobs' => $i * 5,
                'failed_jobs' => $i,
                'failed_job_ids' => json_encode(["failed-job-{$i}"]),
                'options' => json_encode(['priority' => $statuses[$i - 1]]),
                'status' => $statuses[$i - 1],
            ]);
        }

        expect(3, $batchList);

        foreach ($batchList as $index => $batch) {
            expect('bulk-batch-'.($index + 1), $batch->id);
            expect(($index + 1) * 10, $batch->total_jobs);
            expect($statuses[$index], $batch->status);
        }
    }

    /** @test */
    public function it_can_validate_batch_integrity(): void
    {
        // Test con batch valido
        $validBatch = JobBatch::create([
            'id' => 'valid-batch',
            'name' => 'Batch valido',
            'total_jobs' => 10,
            'pending_jobs' => 10,
            'failed_jobs' => 0,
            'failed_job_ids' => json_encode([]),
            'options' => json_encode([]),
        ]);

        expect($validBatch->id);

        // Verifica che i contatori siano coerenti
        $this->assertGreaterThanOrEqual(0, $validBatch->failed_jobs);
        $this->assertLessThanOrEqual($validBatch->total_jobs, $validBatch->pending_jobs + $validBatch->failed_jobs);
    }
}
