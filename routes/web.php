<?php

use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'appName' => config('app.name'),
    ]);
});

Route::get('/leads', fn () => Inertia::render('Leads'));
Route::get('/messaging', fn () => Inertia::render('Messaging'));
Route::get('/campaigns', fn () => Inertia::render('Campaigns'));
Route::get('/crm', fn () => Inertia::render('CRM'));
Route::get('/deals', fn () => Inertia::render('Deals'));
Route::get('/tasks', fn () => Inertia::render('Tasks'));
Route::get('/reports', fn () => Inertia::render('Reports'));
Route::get('/settings', fn () => Inertia::render('Settings'));

Route::middleware(['auth'])->group(function (): void {
    Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
    Route::post('/onboarding/workspace', [OnboardingController::class, 'storeWorkspace'])->name('onboarding.workspace');
    Route::post('/onboarding/invite', [OnboardingController::class, 'invite'])->name('onboarding.invite');
    Route::post('/onboarding/linkedin', [OnboardingController::class, 'connectLinkedIn'])->name('onboarding.linkedin');
});
