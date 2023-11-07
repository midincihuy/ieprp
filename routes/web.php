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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('admin/home');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('ticket', App\Http\Controllers\Admin\TicketController::class);
    Route::resource('configuration', App\Http\Controllers\Admin\ConfigurationController::class);

    Route::get('maps', function(){
        return view('admin.maps.index');
    })->name('maps');
});