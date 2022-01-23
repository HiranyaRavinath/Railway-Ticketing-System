<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\TrainTicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/home/logout', [HomeController::class, 'logout'])->name('home.logout');
Route::get('/import/locations', [LocationController::class, 'importLocations']);

Route::get('/auth/google', [LoginController::class, 'googleSignin']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::group(['prefix' => 'trains'], function () {
    Route::get('/', [TrainController::class, 'index'])->name('trains.index')->middleware(['auth']);
    Route::post('/enroll', [TrainController::class, 'enroll'])->name('trains.enroll');
    Route::post('/get', [TrainController::class, 'get'])->name('trains.get');
    Route::post('/delete', [TrainController::class, 'delete'])->name('trains.delete');
});

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/', [TrainTicketController::class, 'index'])->name('tickets.index');
    Route::post('/enroll', [TrainTicketController::class, 'enroll'])->name('tickets.enroll');
    Route::post('/get', [TrainTicketController::class, 'get'])->name('tickets.get');
    Route::post('/delete', [TrainTicketController::class, 'delete'])->name('tickets.delete');
});

Route::group(['prefix' => 'schedules'], function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index')->middleware(['auth']);
    Route::post('/enroll', [ScheduleController::class, 'enroll'])->name('schedules.enroll');
    Route::post('/get', [ScheduleController::class, 'get'])->name('schedules.get');
    Route::post('/delete', [ScheduleController::class, 'delete'])->name('schedules.delete');
});
