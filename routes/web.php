<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\JobController;

require base_path('routes/admin.php');
require base_path('routes/recruiter.php');

Route::get('/', [HomeController::class, 'Home'])->name('User.Home');
Route::get('JobList', [JobController::class, 'JobList'])->name('User.JobList');
Route::get('/getJobs', [JobController::class, 'getJobs'])->name('User.GetJobs');