<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Traps\TrapActivityController;
use App\Http\Controllers\Traps\TrapController;

//API Routes
Route::prefix('trap')->group(function () {
    Route::post('/connect', [TrapController::class, 'connect']);
    Route::post('/sync', [TrapActivityController::class, 'sync']);
});
