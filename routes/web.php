<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FiltersController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

Route::get('/', function () {
    return view('auth.register');
});

Route::prefix('admin-panel')->name('admin.')->middleware('auth', 'checkAdmin')->group(function () {
    //dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/task-active{taskId}', [AdminDashboardController::class, 'active'])->name('task-active');
    Route::get('/task-deactivate{taskId}', [AdminDashboardController::class, 'deactivate'])->name('task-deactivate');

    //filters
    Route::post('/filter-date', [FiltersController::class, 'filterDate'])->name('filter-date');
    Route::post('/filter-tag', [FiltersController::class, 'filterTag'])->name('filter-tag');


});

Route::prefix('user-panel')->name('user.')->middleware('auth', 'checkUser')->group(function () {

    //dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');

    //task add
    Route::get('/task-add', [UserDashboardController::class, 'taskAdd'])->name('task-add');
    Route::post('/task-add-post', [UserDashboardController::class, 'taskAddPost'])->name('task-add-post');

    //task edit
    Route::get('/task-edit{taskId}', [UserDashboardController::class, 'taskEdit'])->name('task-edit');
    Route::post('/task-edit-post{taskId}', [UserDashboardController::class, 'taskEditPost'])->name('task-edit-post');

    //task delete
    Route::get('/task-delete{taskId}', [UserDashboardController::class, 'taskDelete'])->name('task-delete');

    //task done
    Route::get('/task-done{taskId}', [UserDashboardController::class, 'taskDone'])->name('task-done');

    //task failed
    Route::get('/task-failed{taskId}', [UserDashboardController::class, 'taskFailed'])->name('task-failed');

});


require __DIR__ . '/auth.php';
