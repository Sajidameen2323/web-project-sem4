<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProjectController;
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


    // Below routes manage projects
    Route::get('/projects', [ProjectController::class, 'projects'])->name("projects");
    Route::get('/projects/view/{id?}', [ProjectController::class, 'viewProject'])->name("project.view");

    Route::get('/projects/add', [ProjectController::class, 'form'])->name("projects.addform");
    Route::post('/projects/add', [ProjectController::class, 'store'])->name("projects.add");

    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name("projects.edit");
    Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name("projects.update");

    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name("projects.delete");


    // Below routes manage employees

    Route::get('/employees', [EmployeeController::class, 'list'])->name("employees.list");
    Route::get('/employees/add', [EmployeeController::class, 'form'])->name("employees.form");

    Route::post('/employees/add', [EmployeeController::class, 'store'])->name("employees.add");
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name("employees.edit");
    Route::put('/employees/update/{id}', [EmployeeController::class, 'update'])->name("employees.update");
    
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name("employees.delete");
});
