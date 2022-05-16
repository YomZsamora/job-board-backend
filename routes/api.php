<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FileUploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/signout', [SignOutController::class, 'logout']);
Route::post('/reset_password', [PasswordResetController::class, 'userResetPassword']);
Route::post('/upload_file', [FileUploadController::class, 'fileUpload']);



Route::get('/get_user', [UserController::class, 'getUserDetails']);

