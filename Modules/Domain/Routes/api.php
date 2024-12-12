<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Domain\Http\Controllers\AuthController;
use Modules\Domain\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/domain', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'role' => 'RoleController',
        'user' => 'UserController',
        'customer' => 'CustomerController',
    ]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
});
Route::PUT('/users/password/{user}', [UserController::class, 'changepassword'])->middleware('auth:sanctum');
