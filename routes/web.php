<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Traps\Overview;
use Illuminate\Support\Facades\Route;

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

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('templates/base');
    })->name('dashboard');

    Route::get('/traps', [Overview::class, 'run'])->name('traps');
});

// Unauthenticated routes
Route::get('/login', [AuthController::class, 'showPage'])->name('view.login');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
