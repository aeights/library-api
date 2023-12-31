<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('user','user');
        Route::delete('logout','logout');
    });
    
    Route::controller(BookController::class)->group(function () {
        Route::get('books','index');
        Route::get('books/{id}','read');
        Route::post('books/add','store');
        Route::put('books/edit/{id}','update');
        Route::delete('books/delete/{id}','delete');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::post('login','login');
    });
    
    Route::controller(RegisterController::class)->group(function () {
        Route::post('register','register');
    });
});
