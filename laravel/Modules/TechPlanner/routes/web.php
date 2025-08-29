<?php

use Illuminate\Support\Facades\Route;
use Modules\TechPlanner\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| TechPlanner Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the TechPlanner module.
| These routes are loaded by the RouteServiceProvider.
|
*/

Route::prefix('techplanner')->name('techplanner.')->group(function () {
    // Homepage del modulo
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // Progetti
    Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
    Route::get('/projects/{project}', [HomeController::class, 'showProject'])->name('projects.show');
    
    // Contatti
    Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
    
    // API routes (se necessarie)
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/projects', [HomeController::class, 'apiProjects'])->name('projects');
        Route::get('/contacts', [HomeController::class, 'apiContacts'])->name('contacts');
    });
});
