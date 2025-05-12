<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return response()->json([
        'message' => 'PJ_LIMITADA'
    ]);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/perfil', function (Request $request) {
        return $request->user();
    });
});