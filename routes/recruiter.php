<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\DashboardController;

Route::prefix('Recruiter')->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Recruiter.dashboard');
});