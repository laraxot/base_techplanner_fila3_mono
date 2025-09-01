<?php

declare(strict_types=1);

namespace Modules\Employee\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Xot\Tests\CreatesApplication;

/**
 * Base test case per il modulo Employee.
 * 
 * ✅ USA DatabaseTransactions (NON RefreshDatabase)
 * ✅ Configurato per Pest
 * ✅ Performance ottimizzate
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions; // ✅ SEMPRE - Performance 100x migliori

    protected function setUp(): void
    {
        parent::setUp();
        
        // ✅ NO migrate manuale - DatabaseTransactions gestisce tutto
        // ✅ NO seeding manuale - Factories gestiscono i dati
        
        // Setup specifico del modulo se necessario
        $this->withoutExceptionHandling();
    }

    protected function getPackageProviders($app): array
    {
        return [
            \Modules\Employee\Providers\EmployeeServiceProvider::class,
        ];
    }
}
