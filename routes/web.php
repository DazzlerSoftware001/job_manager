<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\JobController;
use App\Http\Controllers\User\UserJobController;
use App\Http\Controllers\User\DashboardController;


require base_path('routes/admin.php');
require base_path('routes/recruiter.php');

Route::get('/', [HomeController::class, 'Home'])->name('User.Home');

Route::get('Register', [AuthController::class, 'register'])->name('User.register');
Route::get('login', [AuthController::class, 'login'])->name('User.login');
Route::post('loginInsert', [AuthController::class, 'loginInsert'])->name('User.loginInsert');

Route::get('JobList', [JobController::class, 'JobList'])->name('User.JobList');
Route::get('JobDetails/{id}', [JobController::class, 'JobDetails'])->name('User.JobDetails');

// Candidate Dashboard
Route::prefix('User')->group(function () {
    Route::get('Dashboard', [DashboardController::class, 'Dashboard'])->name('User.Dashboard');
    Route::get('Profile', [DashboardController::class, 'Profile'])->name('User.Profile');
    Route::post('/updateProfileImage', [DashboardController::class, 'updateProfileImage'])->name('User.UpdateProfileImage');
    Route::post('/UpdateProfile', [DashboardController::class, 'updateProfile'])->name('User.UpdateProfile');

    Route::post('/ApplyForJOb/{job_id}', [UserJobController::class, 'applyjob'])->name('User.ApplyForJOb');
    Route::get('/AppliedJob', [UserJobController::class, 'appliedjob'])->name('User.AplliedJob');

    Route::post('/logout', [AuthController::class, 'logout'])->name('User.logout');

});
