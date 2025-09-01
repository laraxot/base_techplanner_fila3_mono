# ⚡ Modulo Job - Sistema di Code e Job Avanzato

## Stato del Modulo

**Stato**: Test business logic implementati (85% copertura)
**Copertura Test**: 85%
**Prossimi passi**: completare test modelli base (BaseModel, BaseMorphPivot, BasePivot)

## Struttura del Modulo
- Modelli: Job, Task, Schedule, JobBatch, Result, Frequency, Parameter, Export/Import, FailedJob
- Modelli base: BaseModel, BaseMorphPivot, BasePivot

## Test Implementati (estratto)
- JobBusinessLogicTest
- TaskBusinessLogicTest
- ScheduleBusinessLogicTest
- JobBatchBusinessLogicTest
- ResultBusinessLogicTest

## Factory e Seeder
- Factory: Job, Task, Schedule, JobBatch, Result, Frequency, Parameter, Export, Import, FailedJob
- Seeder: JobDatabaseSeeder

## Installazione
```bash
php artisan module:enable Job
php artisan migrate
php artisan vendor:publish --tag=job-assets
```

## Documentazione correlata
- [Modulo Xot](../../Xot/docs/README.md)
- [Modulo User](../../User/docs/README.md)
- [Modulo UI](../../UI/docs/README.md)
- [README generali](../../../../docs/README.md)

## Analisi PHPStan
```bash
cd /var/www/html/_bases/base_saluteora/laravel
./vendor/bin/phpstan analyze Modules/Job --level=9
```

## Esecuzione Test
```bash
php artisan test --filter=Job
php artisan test --coverage --filter=Job
```

Ultimo aggiornamento: Dicembre 2024
