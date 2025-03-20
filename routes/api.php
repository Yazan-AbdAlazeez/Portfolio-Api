<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortfolioController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get("/Portfolio", [PortfolioController::class, "index"]);
    Route::get("/Portfolio/{id}", [PortfolioController::class, "show"]);
    Route::post("/Portfolio", [PortfolioController::class, "store"]);
    Route::put("/Portfolio/{id}", [PortfolioController::class, "update"]);
    Route::delete("/Portfolio/{id}", [PortfolioController::class, "destroy"]);
});


// Route::post('/register', [AuthController::class, 'makeUser']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('/logout', [AuthController::class, 'logout']);
// });