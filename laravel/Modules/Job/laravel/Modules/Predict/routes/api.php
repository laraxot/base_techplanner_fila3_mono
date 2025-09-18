<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['api', 'auth:sanctum'])
    ->name('api.predict.')
    ->prefix('api/predict')
    ->group(function (): void {
        // API routes here
    });
