<?php

declare(strict_types=1);



namespace Modules\Employee\Tests;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\Xot\Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);
        $this->artisan('module:seed', ['module' => 'Employee']);
    }

    protected function getPackageProviders($app): array
    {
        return [
            \Modules\Employee\Providers\EmployeeServiceProvider::class,
        ];
    }
}