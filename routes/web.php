<?php

use App\Http\Controllers\Auth\LoginRegisterController;
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
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
});



Route::middleware(['guest'])->group(function () {

    Route::controller(LoginRegisterController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');

    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});


