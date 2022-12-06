<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [App\Http\Controllers\AuthenticationController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthenticationController::class, 'store']);
Route::get('/user', [App\Http\Controllers\AuthenticationController::class, 'user']);
Route::post('logout', [App\Http\Controllers\AuthenticationController::class, 'logout']);
Route::post('/menu-customers', [App\Http\Controllers\MenuController::class, 'index']);

Route::group(['prefix' => 'users'], function () {
    Route::get('all', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('profile',[App\Http\Controllers\UserController::class, 'profile']);
});
