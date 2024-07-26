<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/forget', [AuthController::class, 'viewForget'])->name('view-forget-password');
    Route::Post('/forget', [AuthController::class, 'forgetPost'])->name('forget-post');
    
    Route::get('/changepassword/{token}', [AuthController::class, 'viewChangePassword'])->name('view-change-password');
    Route::Post('/new/password/{token}', [AuthController::class, 'changePasswordPost'])->name('change-password-post');

    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login-post');
  });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'dashboard'])->name('home-page');

    Route::Post('/Add/User', [UserController::class, 'index'])->name('add-user');

    Route::get('/Edit/User/{id}', [UserController::class, 'editUser'])->name('edit-user');
    Route::Post('/Edit/User/{id}', [UserController::class, 'postEditUser'])->name('post-edit-user');


    Route::get('whatsapp/{phone}', [UserController::class, 'whatsappNotification'])->name('whatsapp');



    Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('destroy-user');

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    });  