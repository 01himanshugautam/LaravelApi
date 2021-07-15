<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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



Route::post('register', [AuthController::class, 'register']);

Route::post("login", [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user/{email?}', [AuthController::class, 'user']);
    Route::put('update', [AuthController::class, 'update']);
    Route::get('search/{name}', [AuthController::class, 'search']);
});



Route::get('students', [AuthController::class, 'students']);

Route::get('devices/{id?}', [AuthController::class, 'devices']);