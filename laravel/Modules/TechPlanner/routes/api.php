<?php

use Illuminate\Support\Facades\Route;

// use Modules\TechPlanner\Http\Controllers\Api\ProjectController;
// use Modules\TechPlanner\Http\Controllers\Api\ContactController;

/*
|--------------------------------------------------------------------------
| TechPlanner API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the TechPlanner module.
| These routes are loaded by the RouteServiceProvider.
|
*/

Route::prefix('techplanner')->name('api.techplanner.')->group(function () {
    // API Base
    Route::get('dashboard/summary', function () {
        return response()->json([
            'projects_count' => 0,
            'contacts_count' => 0,
            'active_projects' => 0,
            'status' => 'TechPlanner API is working',
        ]);
    })->name('dashboard.summary');

    // TODO: Implementare i controller API
    // Route::apiResource('projects', ProjectController::class);
    // Route::apiResource('contacts', ContactController::class);
});
