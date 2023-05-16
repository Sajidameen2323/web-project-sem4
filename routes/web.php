<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    return view('welcome', ['Remembered' => false, 'session' => $request->session()->all()]);
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->middleware(['auth', 'isAdmin'])->name("test");

Route::get('/projects', function () {
    return view('Project.index');
})->middleware(['auth'])->name("projects");

Route::get('/projects/add', function () {
    return view('Project.add');
})->middleware(['auth'])->name("projects.add");

Route::middleware(['guest'])->group(function () {

    Route::controller(LoginRegisterController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
    });
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});


