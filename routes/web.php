<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/signup',[AuthController::class, 'showRegister'])->name('signup');
Route::get('/login',[AuthController::class, 'showLogin']);
Route::get('/users',[UserController::class, 'showUsers']);
Route::get('/profile',[ProfileController::class, 'showProfile']);
Route::get('/profile',[ProfileController::class, 'showProfile']);
Route::get('/calendar',[ScheduleController::class, 'showCalendar']);
Route::get('/manageSchedule',[ScheduleController::class, 'showManageSchedule']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::post('/signup', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::post('/addUser', [UserController::class,'addUser']);
Route::post('/editUser', [UserController::class,'editUser']);
Route::post('/archiveUser', [UserController::class,'archiveUser']);
Route::post('/updatePicture', [ProfileController::class,'updatePicture']);
Route::post('/updateProfile', [ProfileController::class,'updateProfile']);
Route::post('/addSchedule', [ScheduleController::class,'addSchedule']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

