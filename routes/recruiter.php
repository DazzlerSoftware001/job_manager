<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\JobController;

Route::prefix('Recruiter')->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Recruiter.dashboard');
    Route::get('/jobpost', [JobController::class, 'jobpost'])->name('Recruiter.jobpost');
});