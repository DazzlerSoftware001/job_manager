<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\JobController;
use App\Http\Controllers\Recruiter\AuthController;

Route::prefix('Recruiter')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('Recruiter.login');
    Route::post('/loginInsert', [AuthController::class, 'loginInsert'])->name('Recruiter.loginInsert');

    // Protected Routes with Middleware
    Route::middleware('recruiter')->group(function () {
        Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Recruiter.dashboard');
        Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData'])->name('Recruiter.dashboardData');
        Route::post('/updateProfileImage', [DashboardController::class, 'updateProfileImage'])->name('Recruiter.UpdateProfileImage');
        Route::post('/updateProfileName', [DashboardController::class, 'updateProfileName'])->name('Recruiter.UpdateProfileName');

        // Job Post
        Route::get('/jobpost', [JobController::class, 'jobpost'])->name('Recruiter.jobpost');
        Route::get('/getDepartment', [JobController::class, 'getDepartment'])->name('Recruiter.getDepartment');
        Route::get('/getRole', [JobController::class, 'getRole'])->name('Recruiter.getRole');
        Route::post('/PostJobData', [JobController::class, 'PostJobData'])->name('Recruiter.PostJobData');
        
        Route::get('/JobList', [JobController::class, 'JobList'])->name('Recruiter.JobList');
        Route::post('/GetJobPost', [JobController::class, 'getJobPost'])->name('Recruiter.GetJobPost');
        Route::post('/ChangeJobPostStatus', [JobController::class, 'changeJobPostStatus'])->name('Recruiter.ChangeJobPostStatus');
        Route::post('/DeleteJobPost', [JobController::class, 'deleteJobPost'])->name('Recruiter.DeleteJobPost');
        Route::get('/ViewJobPost/{id}', [JobController::class, 'viewJobPost'])->name('Recruiter.ViewJobPost');
        Route::get('/EditJobPost/{id}', [JobController::class, 'editJobPost'])->name('Recruiter.EditJobPost');
        Route::post('/UpdateJobPost', [JobController::class, 'updateJobPost'])->name('Recruiter.UpdateJobPost');
        
        Route::get('/getEducation', [JobController::class, 'getEducation'])->name('Recruiter.getEducation');
        Route::get('/getBranch', [JobController::class, 'getBranch'])->name('Recruiter.getBranch');

        Route::post('/logout', [AuthController::class, 'logout'])->name('Recruiter.logout');

    });
});