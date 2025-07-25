<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RegistrosController;

// Rotas de login (públicas)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas privadas
Route::middleware('auth:sanctum')->group(function () {

    // User private routes
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Register routes
    Route::get('/registers', [RegistrosController::class, 'listAllRegisters']);
    Route::post('/register', [RegistrosController::class, 'createRegister']);
    Route::patch('/register/{id}', [RegistrosController::class, 'patchRegister']);
    Route::delete('/register/{id}', [RegistrosController::class, 'deleteRegister']);
});