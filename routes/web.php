<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboards\Overview as DashboardOverview;
use App\Http\Controllers\Settings\Notifications as NotificationSettings;
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
    Route::get('/', [DashboardOverview::class, 'showPage'])->name('dashboard');
    Route::get('/notifications', [NotificationSettings::class, 'showPage'])->name('notifications');
    Route::put('/notifications', [NotificationSettings::class, 'update'])->name('notifications.update');

    Route::resource('traps', \App\Http\Controllers\Traps\TrapController::class);

    Route::resource('locations', \App\Http\Controllers\Locations\LocationController::class);
});

// Unauthenticated routes
Route::get('/login', [AuthController::class, 'showPage'])->name('view.login');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
