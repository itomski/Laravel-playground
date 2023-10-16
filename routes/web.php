<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

// Ohne Middleware
Route::resource('/order', OrderController::class);

//Route::resource('/order', OrderController::class)->middleware('auth'); // Erfordert eine Anmeldung

// Aktiviert die Authentifizierung nur für die store Methode
//Route::resource('/order', [OrderController::class, 'store'])->middleware('auth');

// Middleware wird selektiv an Routes gehängt
Route::resource('/vehicle', VehicleController::class)->middleware(['postlog', 'prelog:vehicle']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::get('/test1', function() {
    return 'TEST1';
})->middleware('auth');

Route::get('/test2', function() {
    return 'TEST2';
})->middleware('auth');

Route::get('/test3', function() {
    return 'TEST3';
})->middleware('auth');
*/

// Deklariert eine Gruppe von Rauts, die eine bestimme
// Middleware Konfiguration brauchen
Route::middleware('auth')->group(function() {

    Route::get('/test1', function() {
        return 'TEST1';
    });

    Route::get('/test2', function() {
        return 'TEST2';
    });
});

Route::middleware('auth.basic')->group(function() {

    Route::get('/test3', function() {
        return 'TEST3';
    });
});