<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

Route::name('api.')->group(function () {
	//Rutas de autenticación
	Route::prefix('auth')->group(function () {
		Route::post('login', [AuthController::class, 'login'])->name('login');
		Route::get('password_recovery', [AuthController::class, 'passwordRecovery'])->name('password_recovery');
		
		Route::middleware('auth:api')->group(function () {
			Route::get('logout', [AuthController::class, 'logout'])->name('logout');
		});
	});
	
	Route::middleware('auth:api')->group(function () {
		Route::apiResource('users', UserController::class);
	});
});

