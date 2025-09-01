# 📊 Activity Module - Sistema di Audit e Logging

[![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![Filament 3.x](https://img.shields.io/badge/Filament-3.x-blue.svg)](https://filamentphp.com/)
[![PHPStan Level 9](https://img.shields.io/badge/PHPStan-Level%209-brightgreen.svg)](https://phpstan.org/)

> Modulo completo per audit trail, event sourcing e logging con dashboard Filament.

## Panoramica
- Audit trail completo
- Event sourcing
- Analytics dashboard
- Filtri avanzati e real-time monitoring

## Esempi (estratto)
```php
use Spatie\Activitylog\Traits\LogsActivity;
class User extends Model {
    use LogsActivity;
    protected static $logAttributes = ['name','email','status'];
}
```

## Stato Qualità (Gennaio 2025)
- PHPStan Level 9: file core conformi
- Translation standards: ok
- Performance: logging < 10ms

## Installazione
```bash
php artisan module:enable Activity
php artisan migrate
php artisan vendor:publish --tag=activity-config
```

## Documentazione
- [Event Sourcing](event-sourcing.md)
- [Structure](structure.md)
- [Filament Integration](filament.md)

## Testing
```bash
php artisan test --testsuite=Activity
./vendor/bin/phpstan analyze Modules/Activity --level=9
```

Ultimo aggiornamento: 27 Gennaio 2025 