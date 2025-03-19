<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\JobController;

Route::prefix('Recruiter')->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('Recruiter.login');
    Route::post('/loginInsert', [DashboardController::class, 'loginInsert'])->name('Recruiter.loginInsert');

    // Protected Routes with Middleware
    Route::middleware('recruiter')->group(function () {
        Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Recruiter.dashboard');

        // Job Post
        Route::get('/jobpost', [JobController::class, 'jobpost'])->name('Recruiter.jobpost');
        Route::get('/getDepartment', [JobController::class, 'getDepartment'])->name('Recruiter.getDepartment');
        Route::get('/getRole', [JobController::class, 'getRole'])->name('Recruiter.getRole');
        Route::post('/PostJobData', [JobController::class, 'PostJobData'])->name('Recruiter.PostJobData');

        Route::get('/JobList', [JobController::class, 'JobList'])->name('Recruiter.JobList');
        Route::post('/GetJobPost', [JobController::class, 'getJobPost'])->name('Recruiter.GetJobPost');
        Route::post('/ChangeJobPostStatus', [JobController::class, 'changeJobPostStatus'])->name('Recruiter.ChangeJobPostStatus');
        Route::post('/DeleteJobPost', [JobController::class, 'deleteJobPost'])->name('Recruiter.DeleteJobPost');
        Route::post('/EditJobPost', [JobController::class, 'editJobPost'])->name('Recruiter.EditJobPost');
        Route::post('/UpdateJobPost', [JobController::class, 'updateJobPost'])->name('Recruiter.UpdateJobPost');


        Route::post('/logout', [DashboardController::class, 'logout'])->name('Recruiter.logout');

    });
});