<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return response()->json([
        'message' => 'PJ_LIMITADA'
    ]);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('marcas', MarcaController::class);
    Route::apiResource('modelos', ModeloController::class);
    Route::get('/perfil', function (Request $request) {
        return $request->user();
    });
});