<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\JobController;
use App\Http\Controllers\User\UserJobController;
use Illuminate\Support\Facades\Route;

require base_path('routes/admin.php');
require base_path('routes/recruiter.php');

Route::get('MaintenanceMode', [HomeController::class, 'maintenanceMode'])->name('User.MaintenanceMode');
Route::middleware('maintenance')->group(function (){
Route::get('/', [HomeController::class, 'Home'])->name('User.Home');

Route::get('Register', [AuthController::class, 'register'])->name('User.register');
Route::post('RegisterUser', [AuthController::class, 'RegisterUser'])->name('User.RegisterUser');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('User.verifyOtp');
Route::get('login', [AuthController::class, 'login'])->name('User.login');
Route::post('loginInsert', [AuthController::class, 'loginInsert'])->name('User.loginInsert');

Route::get('JobList', [JobController::class, 'JobList'])->name('User.JobList');
Route::get('JobDetails/{id}', [JobController::class, 'JobDetails'])->name('User.JobDetails');
Route::get('/About', [HomeController::class, 'about'])->name('User.About');
Route::get('/Contact', [HomeController::class, 'contact'])->name('User.Contact');

Route::get('/{slug}', [HomeController::class, 'ViewPage'])->name('User.ViewPage');


// Candidate Dashboard
Route::prefix('User')->group(function () {
    Route::middleware('user')->group(function () {
        Route::get('Dashboard', [DashboardController::class, 'Dashboard'])->name('User.Dashboard');
        Route::get('Profile', [DashboardController::class, 'Profile'])->name('User.Profile');
        Route::post('/updateProfileImage', [DashboardController::class, 'updateProfileImage'])->name('User.UpdateProfileImage');
        Route::post('/UpdateProfile', [DashboardController::class, 'updateProfile'])->name('User.UpdateProfile');

        // web.php
        Route::post('/send-otp-email', [DashboardController::class, 'sendOtp'])->name('send.otp.email');
        Route::post('/verify-otp-email', [DashboardController::class, 'verifyOtp'])->name('verify.otp.email');


        Route::get('/Resume', [DashboardController::class, 'resume'])->name('User.Resume');
        Route::post('/UploadResume', [DashboardController::class, 'UploadResume'])->name('User.UploadResume');
        Route::post('/UploadCoverLetter', [DashboardController::class, 'UploadCoverLetter'])->name('User.UploadCoverLetter');
        Route::post('/uploadDesignation', [DashboardController::class, 'uploadDesignation'])->name('User.UploadDesignation');
        Route::post('/addSkill', [DashboardController::class, 'addSkill'])->name('User.AddSkill');
        Route::post('/removeSkill', [DashboardController::class, 'removeSkill'])->name('User.RemoveSkill');
        Route::post('/candidateExp', [DashboardController::class, 'candidateExp'])->name('User.CandidateExp');
        Route::post('/UpdateExperience', [DashboardController::class, 'updateExperience'])->name('User.UpdateExperience');
        Route::delete('/DeleteExperience/{id}', [DashboardController::class, 'deleteExperience'])->name('User.DeleteExperience');
        Route::post('/CandidateEducation', [DashboardController::class, 'CandidateEducation'])->name('User.CandidateEducation');
        Route::post('/UpdateEducation', [DashboardController::class, 'updateEducation'])->name('User.UpdateEducation');
        Route::delete('/DeleteEducation/{id}', [DashboardController::class, 'deleteEducation'])->name('User.DeleteEducation');
        Route::post('/CandidateAward', [DashboardController::class, 'CandidateAward'])->name('User.CandidateAward');
        Route::post('/UpdateAward', [DashboardController::class, 'updateAward'])->name('User.UpdateAward');
        Route::delete('/DeleteAward/{id}', [DashboardController::class, 'deleteAward'])->name('User.DeleteAward');

        Route::get('ChangePassword', [DashboardController::class, 'ChangePassword'])->name('User.ChangePassword');
        Route::post('UpdatePassword', [DashboardController::class, 'UpdatePassword'])->name('User.UpdatePassword');

       Route::delete('/notifications/{id}', [DashboardController::class, 'destroy'])->name('notifications.delete');


        Route::post('/ApplyForJOb', [UserJobController::class, 'applyjob'])->name('User.ApplyForJOb');
        Route::get('/AppliedJob', [UserJobController::class, 'appliedjob'])->name('User.AplliedJob');
        Route::get('/ShortList', [UserJobController::class, 'ShortList'])->name('User.ShortList');

        Route::get('/SavedJob', [UserJobController::class, 'SavedJob'])->name('User.SavedJob');
        Route::get('/GetSavedJob', [UserJobController::class, 'GetSavedJob'])->name('User.GetSavedJob');
        Route::get('/UnsaveJob', [UserJobController::class, 'UnsaveJob'])->name('User.UnsaveJob');

        Route::post('/SaveJob', [JobController::class, 'saveJob'])->name('User.SaveJob');
        Route::post('/removeSavedJob', [JobController::class, 'removeSavedJob'])->name('User.RemoveSavedJob');

        Route::post('/logout', [AuthController::class, 'logout'])->name('User.logout');


    });


});

});
