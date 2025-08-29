<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage reindirizza al tema Folio (rimuovi Laravel welcome template conflittuale)  
Route::get('/', function () {
    return redirect()->to('/' . app()->getLocale());
})->name('home');

// Caricamento automatico rotte moduli
Route::middleware('web')->group(function () {
    // Carica rotte del modulo TechPlanner
    if (file_exists(base_path('Modules/TechPlanner/routes/web.php'))) {
        require base_path('Modules/TechPlanner/routes/web.php');
    }
    
    // Carica rotte del modulo Xot
    if (file_exists(base_path('Modules/Xot/routes/web.php'))) {
        require base_path('Modules/Xot/routes/web.php');
    }
});

// Rotte di autenticazione (se necessarie)
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/register', function () {
    return view('auth.register');
})->name('register');

