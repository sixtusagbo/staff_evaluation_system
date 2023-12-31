<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

Route::resource('attendances', AttendanceController::class)->only(['store']);
Route::resource('tasks', TaskController::class)
    ->only(['index', 'store', 'update', 'destroy']);
Route::resource('leaves', LeaveController::class)
    ->only(['index', 'create', 'store', 'update', 'destroy'])
    ->parameters(['leaves' => 'leave']);
Route::resource('staff', StaffController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->parameters(['staff' => 'user']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::put('/tasks/{task}/done', [TaskController::class, 'done'])->name('tasks.done');
