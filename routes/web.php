<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Route::get('/', fn() => Auth::check() ? redirect('tasks/index') : redirect('login'));
Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('login');
