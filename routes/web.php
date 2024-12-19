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

use App\Http\Controllers\TaskUserController;

Route::post('/tasks/{task}/assign-user', [TaskController::class, 'assignUser'])->name('tasks.assignUser');
Route::delete('/tasks/{task}/remove-user/{user}', [TaskController::class, 'removeUser'])->name('tasks.removeUser');

use App\Http\Controllers\AuthController;

// Autentifikacija
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');