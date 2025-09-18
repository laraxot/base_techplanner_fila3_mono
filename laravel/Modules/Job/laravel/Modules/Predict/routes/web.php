<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Predict\Http\Controllers\PredictController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::prefix('predict')->group(function() {
//     Route::get('/', 'PredictController@index');
// });

Route::middleware(['web', 'auth'])
    ->name('predict.')
    ->prefix('predict')
    ->group(function (): void {
        Route::resource('predicts', PredictController::class);
    });
