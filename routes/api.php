<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\TrackerUserController;
use App\Http\Controllers\API\DeviceController;

/*
|-----------------------------------------------------------
| API Routes
|-----------------------------------------------------------
| Aquí se definen las rutas de la API. Todas las rutas aquí
| tienen el prefijo '/api' y usan el middleware 'api' por
| defecto, que incluye rate limiting.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tracker-users', TrackerUserController::class);
Route::apiResource('devices', DeviceController::class);
Route::post('/location', [LocationController::class, 'store']);