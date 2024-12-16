<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionRoomController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ActivityTypeController;

Route::resource('users', UserController::class);
Route::resource('company_profiles', CompanyProfileController::class);
Route::resource('roles', RoleController::class);
Route::resource('section-rooms', SectionRoomController::class);
Route::resource('task-status', TaskStatusController::class);
Route::resource('tasks', TaskController::class);
Route::resource('activity-type', ActivityTypeController::class);