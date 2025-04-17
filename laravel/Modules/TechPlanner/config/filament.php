<?php

declare(strict_types=1);

return [
    'widgets' => [
        'namespace' => 'Modules\\TechPlanner\\Filament\\Widgets',
        'path' => base_path('Modules/TechPlanner/app/Filament/Widgets'),
        'register' => [
            Modules\TechPlanner\Filament\Widgets\ClientMapWidget::class,
            Modules\TechPlanner\Filament\Widgets\CoordinatesWidget::class,
        ],
    ],
];
