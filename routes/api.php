<?php

use App\Http\Controllers\Api\TaskManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// authentication using sanctum
Route::post('/user-register', [AuthController::class, 'user_register_api']);
Route::post('/user-login', [AuthController::class, 'user_login_api']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user-tasks', TaskManage::class); //index,create,edit,update,delete,filter route is here
    Route::post('/user-logout', [AuthController::class, 'user_logout']);
});
