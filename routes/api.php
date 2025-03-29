<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\WorkController;

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

    Route::get("/portfolios/{portfolioId}/about", [AboutController::class, "show"]);
    Route::post('/portfolios/{portfolioId}/about', [AboutController::class, 'store']);
    Route::put("/portfolios/{portfolioId}/about", [AboutController::class, "update"]);
    Route::delete("/portfolios/{portfolioId}/about", [AboutController::class, "destroy"]);

    Route::get("/portfolios/{portfolioId}/work", [WorkController::class, "index"]);
    Route::post('/portfolios/{portfolioId}/work', [WorkController::class, 'store']);
    Route::put("/portfolios/{portfolioId}/work/{id}", [WorkController::class, "update"]);
    Route::delete("/portfolios/{portfolioId}/work/{id}", [WorkController::class, "destroy"]);



});


// Route::post('/register', [AuthController::class, 'makeUser']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('/logout', [AuthController::class, 'logout']);
// });