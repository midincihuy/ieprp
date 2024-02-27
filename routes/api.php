<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TicketController;

use App\Http\Controllers\API\HelpwaController;
use App\Http\Controllers\API\ConfigurationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('tickets', TicketController::class);
    Route::post('helpwa', [HelpwaController::class, 'index']);
    Route::post('helpwaresp', [HelpwaController::class, 'response']);
    Route::post('helpwarate', [HelpwaController::class, 'rate']);
});

Route::post('saveConfig', [ConfigurationController::class, 'saveConfig']);
Route::post('saveConfigValue', [ConfigurationController::class, 'saveConfigValue']);
