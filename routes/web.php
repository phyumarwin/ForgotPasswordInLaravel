<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\UploadManger;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register',  [AuthController::class, 'registerPost'])->name('register.post');

Route::view('/upload', 'welcome');
Route::post('/upload', 
    [UploadManger::class, 'uploadFile'])
    ->name('upload.file.post');

Route::get('/forget_password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget_password', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset_password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset_password', [ForgetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');
