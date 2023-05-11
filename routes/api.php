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
Route::post('users/labor',[App\Http\Controllers\UserController::class, 'setLabor']);
Route::resource('users', 'App\Http\Controllers\UserController', ['except' => ['create','edit']]);
Route::get('accounts/parent',[App\Http\Controllers\CuentasCorrienteController::class, 'CuentasPadres']);
Route::get('accounts/export',[App\Http\Controllers\CuentasCorrienteController::class, 'exportExcel']);
Route::resource('accounts','App\Http\Controllers\CuentasCorrienteController',['except' => ['create','edit']]);

Route::get('familia/childrens/{id}',[App\Http\Controllers\FamiliumController::class, 'showByUserId']);
Route::resource('familia','App\Http\Controllers\FamiliumController',['except' => ['create','edit']])->parameters(['familia' => 'id']);
Route::resource('salario','App\Http\Controllers\SalarioController',['except' => ['create','edit']])->parameters(['salario' => 'id']);
Route::get('salario/usuario/{id}',[App\Http\Controllers\SalarioController::class, 'showByUserId']);
Route::get('telefono/usuario/{id}',[App\Http\Controllers\TelefonoController::class, 'showByUserId']);
Route::resource('telefono','App\Http\Controllers\TelefonoController',['except' => ['create','edit']])->parameters(['telefono' => 'id']);
Route::resource('tipo-telefono','App\Http\Controllers\TipoTelefonoController',['except' => ['create','edit']])->parameters(['tipo-telefono' => 'tipo']);
Route::resource('contacto','App\Http\Controllers\ContactController',['except' => ['create','edit']])->parameters(['contacto' => 'id']);
Route::get('contacto/usuario/{id}',[App\Http\Controllers\ContactController::class, 'showByUserId']);

Route::resource('area','App\Http\Controllers\AreaController',['except' => ['create','edit']])->parameters(['area' => 'id']);
Route::resource('falta-laboral','App\Http\Controllers\FaltaController',['except' => ['create','edit']])->parameters(['falta-laboral' => 'id']);
Route::resource('sancion','App\Http\Controllers\SancioneController',['except' => ['create','edit']])->parameters(['sancion' => 'id']);
Route::resource('puesto','App\Http\Controllers\PositionController',['except' => ['create','edit']])->parameters(['puesto' => 'id']);
Route::resource('prestamo','App\Http\Controllers\MoneyLoanController',['except' => ['create','edit']])->parameters(['prestamo' => 'id']);
Route::resource('falta','App\Http\Controllers\WorkAbsenceController',['except' => ['create','edit']])->parameters(['falta' => 'id']);
Route::get('prestamo/usuario/{id}',[App\Http\Controllers\MoneyLoanController::class, 'showByUserId']);
Route::get('falta/usuario/{id}',[App\Http\Controllers\WorkAbsenceController::class, 'showByUserId']);
