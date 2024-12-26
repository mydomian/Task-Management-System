<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/', fn() => redirect()->route(Auth::check() ? 'tasks.index' : 'login'));
Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('login');
Route::middleware(['user'])->group(function () {
    Route::resource('tasks',TaskController::class); //index,create,edit,update,delete,filter route is here
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
