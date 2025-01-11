<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

// User
Route::post("/user/add", [UserController::class, 'store']);

// Authetication
Route::post("/auth/login", [AuthController::class, 'login']);
Route::get("/auth/me", [AuthController::class, 'me'])->middleware('auth:api');

// TODO
Route::post("/todo/add", [TodoController::class, 'store'])->middleware('auth:api');