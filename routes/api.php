<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoterController;
use App\Http\Controllers\ReferralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('json')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::apiResource('contact-forms', ContactFormController::class)->only(['store']);
    Route::apiResource('links', LinkController::class)->only(['index', 'show']);
    Route::post('/login', [AuthController::class, 'store']);
    Route::post('/register', [AuthController::class, 'create']);

    Route::get('/referrals/{code}', [ReferralController::class, 'store']);
    Route::post('/referrals', [ReferralController::class, 'update']);
    
    Route::middleware(['auth:sanctum', 'admin'])->group(function(){
        Route::apiResource('promoters', PromoterController::class)->only(['index', 'show', 'destroy']);
        Route::patch('/promoters/{id}/disable', [PromoterController::class, 'disable']);
        Route::delete('/referrals/{id}', [ReferralController::class, 'destroy']);
        Route::apiResource('links', LinkController::class)->only(['update']);
    });
    
    Route::middleware(['auth:sanctum', 'promoter'])->group(function(){
        Route::get('/check', function(){
            return response()->json([
                'message' => 'Account Checked.'
            ], 200);
        });

        Route::apiResource('contact-forms', ContactFormController::class)->only(['index', 'destroy']);
        Route::get('clicks', [ReferralController::class, 'fetchAllClicks']);
        Route::get('completions', [ReferralController::class, 'fetchAllCompletions']);

        Route::get('/dashboard-summary', [DashboardController::class, 'index']);

        Route::patch('profile', [ProfileController::class, 'update']);
        Route::patch('change-password', [ProfileController::class, 'changePassword']);
    });
});