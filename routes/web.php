<?php

use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'appName' => config('app.name'),
    ]);
});

Route::middleware(['auth'])->group(function (): void {
    Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
    Route::post('/onboarding/workspace', [OnboardingController::class, 'storeWorkspace'])->name('onboarding.workspace');
    Route::post('/onboarding/invite', [OnboardingController::class, 'invite'])->name('onboarding.invite');
    Route::post('/onboarding/linkedin', [OnboardingController::class, 'connectLinkedIn'])->name('onboarding.linkedin');
});
