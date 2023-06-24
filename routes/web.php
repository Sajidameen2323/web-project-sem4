<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
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
use App\Charts\exampleChart;
use App\Http\Controllers\ReportsController;
use App\Models\Project;
use App\Models\User;

// ...


Route::get('/', function (Request $request) {

    $today_users = User::whereDate('created_at', today())->count();
    $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
    $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

    $chart = new exampleChart;
    $chart->labels(['2 days ago', 'Yesterday', 'Today']);
    $chart->dataset('Users', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);

    $chart->options([
        'tooltip' => [
            'show' => true // or false, depending on what you want.
        ]
    ]);

    return view('welcome', [
        'Remembered' => false,
        'session' => $request->session()->all(),
        'chart' => $chart,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/settings', function (Request $request) {

    return view('User.settings', [
        'Remembered' => false,
        'session' => $request->session()->all(),

    ]);
})->middleware(['auth'])->name('settings');

Route::get('/projects/chart', [ReportsController::class, 'chart']);


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

    Route::get('/projects/{id}/reports', [ProjectController::class, 'viewReports'])->name("projects.reports");

    // Reports ---------------
    Route::get('/project/{id}/reports/gantt', [ReportsController::class, 'gantt'])->name("project.report.gantt");

    Route::get('/project/{id}/reports/status', [ReportsController::class, 'projectStatus'])->name("project.report.status");

    // Below routes manage employees

    Route::get('/employees', [EmployeeController::class, 'list'])->name("employees.list");
    Route::get('/employees/add', [EmployeeController::class, 'form'])->name("employees.form");

    Route::post('/employees/add', [EmployeeController::class, 'store'])->name("employees.add");
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name("employees.edit");
    Route::put('/employees/update/{id}', [EmployeeController::class, 'update'])->name("employees.update");

    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name("employees.delete");


    // Below routes manage project members
    Route::get('/project/{id}/members', [TeamController::class, 'list'])->name("members.list");


    Route::get('/project/{id}/members/add', [TeamController::class, 'form'])->name("members.form");
    Route::post('/project/{id}/members/add', [TeamController::class, 'store'])->name("members.add");
    Route::get('/project/{id}/members/{m_id}/edit', [TeamController::class, 'edit'])->name("members.edit");
    Route::put('/project/{id}/members/{m_id}/update', [TeamController::class, 'update'])->name("members.update");
    Route::delete('/members/{id}', [TeamController::class, 'destroy'])->name("members.delete");


    // Below routes manage project tasks

    Route::get('/project/{id}/tasks', [TaskController::class, 'list'])->name("tasks.list");

    Route::get('/project/{id}/tasks/add', [TaskController::class, 'form'])->name("tasks.form");
    Route::post('/project/{id}/tasks/add', [TaskController::class, 'store'])->name("tasks.add");
    Route::get('/project/{id}/tasks/{t_id}/edit', [TaskController::class, 'edit'])->name("tasks.edit");
    Route::post('/project/{id}/tasks/{t_id}/update', [TaskController::class, 'update'])->name("tasks.update");
    Route::get('/project/{id}/tasks/{t_id}/view', [TaskController::class, 'viewTask'])->name("tasks.view");

    Route::post('/project/{id}/tasks/{t_id}/discussion/add', [TaskController::class, 'addDiscussion'])->name("tasks.addDiscussion");
    Route::delete('/discussions/{id}/delete', [TaskController::class, 'removeDiscussion'])->name("discussion.delete");

    Route::post('/project/{id}/tasks/{t_id}/commit', [TaskController::class, 'commitTask'])->name("tasks.commit");

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name("tasks.delete");

    Route::get('/mytasks', [TaskController::class, 'getMyTasks'])->name("tasks.my");
});
