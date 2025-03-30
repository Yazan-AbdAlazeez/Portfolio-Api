<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SocialLinkController;
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


    Route::prefix('portfolios/{portfolioId}')->group(function () {
        Route::get("/about", [AboutController::class, "show"]);
        Route::post('/about', [AboutController::class, 'store']);
        Route::delete("/about", [AboutController::class, "destroy"]);
    

        Route::get('/work', [WorkController::class, 'show']);
        Route::post('/work', [WorkController::class, 'store']);
        Route::put('/work/{workId}', [WorkController::class, 'update']);
        Route::delete('/work/{workId}', [WorkController::class, 'destroy']);

        Route::get('/service', [ServiceController::class, 'show']);
        Route::post('/service', [ServiceController::class, 'store']);
        Route::put('/service/{serviceId}', [ServiceController::class, 'update']);
        Route::delete('/service/{serviceId}', [ServiceController::class, 'destroy']);
        
        Route::get('/contact', [ContactController::class, 'show']);
        Route::post('/contact', [ContactController::class, 'store']);
        Route::delete('/contact', [ContactController::class, 'destroy']);

        Route::get('/sociallink', [SocialLinkController::class, 'show']);
        Route::post('/sociallink', [SocialLinkController::class, 'store']);
        Route::put('/sociallink/{sociallinkId}', [SocialLinkController::class, 'update']);
        Route::delete('/sociallink/{sociallinkId}', [SocialLinkController::class, 'destroy']);


    });


});

