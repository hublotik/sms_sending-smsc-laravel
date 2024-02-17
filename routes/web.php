<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleSmsController;
use App\Http\Controllers\StatController;
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
Route::get('login_page', function () {
    return view('login_page')->name('login_page');
});
Route::middleware('auth.basic')->group(function () {
    Route::any('/', [UserController::class, 'create'])->name('welcome');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
   
    Route::any('/schedule', [ScheduleSmsController::class, 'schedule'])->name('schedule');
    Route::post('/schedule/create', [ScheduleSmsController::class, 'schedule_create'])->name('schedule.create');

    Route::get('/stat', [StatController::class, 'output'])->name('stat');
});
