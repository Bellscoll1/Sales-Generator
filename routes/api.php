<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\WebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('throttle:api')->group(function (): void {
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::post('/webhooks/stripe', [WebhookController::class, 'stripe']);
    Route::post('/webhooks/paddle', [WebhookController::class, 'paddle']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::middleware('tenant')->group(function (): void {
            Route::get('/organizations/current', [OrganizationController::class, 'current']);
            Route::get('/reports/overview', [ReportController::class, 'index']);
            Route::get('/billing/overview', [BillingController::class, 'index']);

            Route::apiResource('leads', LeadController::class);
            Route::apiResource('campaigns', CampaignController::class)->only(['index', 'store', 'show', 'update']);
            Route::apiResource('messages', MessageController::class)->only(['index', 'store']);
            Route::apiResource('deals', DealController::class);
            Route::apiResource('tasks', TaskController::class);
        });
    });
});
