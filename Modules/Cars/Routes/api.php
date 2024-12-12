<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Modules\Cars\Http\Controllers\RouteController;
use Modules\Cars\Http\Controllers\VehicleController;
use Modules\Cars\Http\Controllers\RoutePriceController;
use Modules\Cars\Http\Controllers\VehicleTypeController;
use Modules\Cars\Http\Controllers\VehicleModelController;


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

Route::middleware('auth:api')->get('/cars', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'vehicle' => 'VehicleController',
        'vehicle-type' => 'VehicleTypeController',
        'vehicle-model' => 'VehicleModelController',
        'route' => 'RouteController',
        'route-price' => 'RoutePriceController',
        'trip' => 'TripController',

    ]);
});