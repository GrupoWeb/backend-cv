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

Route::post('login', [App\Http\Controllers\AuthenticationController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthenticationController::class, 'store']);
Route::get('user', [App\Http\Controllers\AuthenticationController::class, 'user']);
Route::post('logout', [App\Http\Controllers\AuthenticationController::class, 'logout']);
Route::post('menu-customers', [App\Http\Controllers\MenuController::class, 'index']);

Route::post('users/profile',[App\Http\Controllers\UserController::class, 'profile']);
Route::post('users/store',[App\Http\Controllers\UserController::class, 'storeUser']);
Route::post('users/updateAvatar',[App\Http\Controllers\UserController::class, 'updateAvatarById']);
Route::post('users/update',[App\Http\Controllers\UserController::class, 'updateUserById']);
Route::resource('users', 'App\Http\Controllers\UserController', ['except' => ['create','edit']]);
Route::get('accounts/parent',[App\Http\Controllers\CuentasCorrienteController::class, 'CuentasPadres']);
Route::get('accounts/export',[App\Http\Controllers\CuentasCorrienteController::class, 'exportExcel']);
Route::resource('accounts','App\Http\Controllers\CuentasCorrienteController',['except' => ['create','edit']]);

Route::get('familia/childrens/{id}',[App\Http\Controllers\FamiliumController::class, 'showByUserId']);
Route::resource('familia','App\Http\Controllers\FamiliumController',['except' => ['create','edit']])->parameters(['familia' => 'id']);
Route::resource('salario','App\Http\Controllers\SalarioController',['except' => ['create','edit']])->parameters(['salario' => 'id']);
Route::resource('telefono','App\Http\Controllers\TelefonoController',['except' => ['create','edit']])->parameters(['telefono' => 'id']);
Route::resource('tipo-telefono','App\Http\Controllers\TipoTelefonoController',['except' => ['create','edit']])->parameters(['tipo-telefono' => 'tipo']);
