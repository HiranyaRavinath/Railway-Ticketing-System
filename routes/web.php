<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [LoginController::class, 'googleSignin']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::group(['prefix'=>'trains'], function(){
    Route::get('/', [TrainController::class,'index'])->name('trains.index');
});
