<?php

use Illuminate\Support\Facades\Route;

/* 
use Illuminate\Support\Facades\Hash;

dd(Hash::make('lozinka'));
*/

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
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;

Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('auth.do_login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('register', [AuthController::class, 'postRegister'])->name('auth.do_register');
});

Route::group(['middleware' => Authenticate::class], function (){
    Route::resource('users', UserController::class);
    Route::resource('company_profiles', CompanyProfileController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('section-rooms', SectionRoomController::class);
    Route::resource('task-status', TaskStatusController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('activity-type', ActivityTypeController::class);               
});

Route::post('/tasks/{task}/assign-user', [TaskController::class, 'assignUser'])->name('tasks.assignUser');
Route::delete('/tasks/{task}/remove-user/{user}', [TaskController::class, 'removeUser'])->name('tasks.removeUser');
