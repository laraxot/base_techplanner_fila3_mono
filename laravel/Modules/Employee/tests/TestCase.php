<?php

declare(strict_types=1);

namespace Modules\Employee\Tests;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
=======
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> cda86dd (.)
use Modules\Xot\Tests\CreatesApplication;

/**
 * Base test case per il modulo Employee.
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD

        // ✅ NO migrate manuale - DatabaseTransactions gestisce tutto
        // ✅ NO seeding manuale - Factories gestiscono i dati

=======
        
        // ✅ NO migrate manuale - DatabaseTransactions gestisce tutto
        // ✅ NO seeding manuale - Factories gestiscono i dati
        
>>>>>>> cda86dd (.)
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
