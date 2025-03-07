<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\RecruiterController;

Route::prefix('Admin')->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Admin.dashboard');

    Route::get('/JobSkill', [JobController::class, 'JobSkill'])->name('Admin.JobSkill');
    Route::post('/GetJobSkill', [JobController::class, 'getJobSkill'])->name('Admin.GetJobSkill');
    Route::post('/AddJobSkill', [JobController::class, 'addJobSkill'])->name('Admin.AddJobSkill');
    Route::post('/ChangeJobSkillStatus',[JobController::class,'changeJobSkillStatus'])->name('Admin.ChangeJobSkillStatus');
    Route::post('/DeleteJobSkill',[JobController::class,'deleteJobSkill'])->name('Admin.DeleteJobSkill');
    Route::post('/EditJobSkill',[JobController::class,'editJobSkill'])->name('Admin.EditJobSkill');
    Route::post('/UpdateJobSkill',[JobController::class,'updateJobSkill'])->name('Admin.UpdateJobSkill');


    // Department

    //Role
    Route::get('/JobRole', [JobController::class, 'JobRole'])->name('Admin.JobRole');
    Route::post('/GetJobRole', [JobController::class, 'getJobRole'])->name('Admin.GetJobRole');
    Route::post('/AddJobRole', [JobController::class, 'addJobRole'])->name('Admin.AddJobRole');
    Route::post('/ChangeJobRoleStatus',[JobController::class,'changeJobRoleStatus'])->name('Admin.ChangeJobRoleStatus');
    Route::post('/DeleteJobRole',[JobController::class,'deleteJobRole'])->name('Admin.DeleteJobRole');
    Route::post('/EditJobRole',[JobController::class,'editJobRole'])->name('Admin.EditJobRole');
    Route::post('/UpdateJobRole',[JobController::class,'updateJobRole'])->name('Admin.UpdateJobRole');



    // Location
    Route::get('/JobLocation', [JobController::class, 'JobLocation'])->name('Admin.JobLocation');
    Route::post('/GetJobLocation', [JobController::class, 'getJobLocation'])->name('Admin.GetJobLocation');
    Route::post('/AddJobLocation', [JobController::class, 'addJobLocation'])->name('Admin.AddJobLocation');
    Route::post('/ChangeJobLocationStatus',[JobController::class,'changeJobLocationStatus'])->name('Admin.ChangeJobLocationStatus');
    Route::post('/DeleteJobLocation',[JobController::class,'deleteJobLocation'])->name('Admin.DeleteJobLocation');
    Route::post('/EditJobLocation',[JobController::class,'editJobLocation'])->name('Admin.EditJobLocation');
    Route::post('/UpdateJobLocation',[JobController::class,'updateJobLocation'])->name('Admin.UpdateJobLocation');

    Route::get('/JobCategory', [JobController::class, 'jobCategory'])->name('Admin.JobCategory');
    Route::post('/GetJobCategory', [JobController::class, 'getJobCategory'])->name('Admin.GetJobCategory');
    Route::post('/AddJobCategory', [JobController::class, 'addJobCategory'])->name('Admin.AddJobCategory');
    Route::post('/ChangeJobCategoryStatus',[JobController::class,'changeJobCategoryStatus'])->name('Admin.ChangeJobCategoryStatus');
    Route::post('/DeleteJobCategory',[JobController::class,'deleteJobCategory'])->name('Admin.DeleteJobCategory');
    Route::post('/EditJobCategory',[JobController::class,'editJobCategory'])->name('Admin.EditJobCategory');
    Route::post('/UpdateJobCategory',[JobController::class,'updateJobCategory'])->name('Admin.UpdateJobCategory');

    // Types
    Route::get('/JobTypes', [JobController::class, 'jobTypes'])->name('Admin.JobTypes');
    Route::post('/GetJobTypes', [JobController::class, 'getJobTypes'])->name('Admin.GetJobTypes');
    Route::post('/AddJobTypes', [JobController::class, 'addJobTypes'])->name('Admin.AddJobTypes');
    Route::post('/ChangeJobTypesStatus',[JobController::class,'changeJobTypesStatus'])->name('Admin.ChangeJobTypesStatus');
    Route::post('/DeleteJobTypes',[JobController::class,'deleteJobTypes'])->name('Admin.DeleteJobTypes');
    Route::post('/EditJobTypes',[JobController::class,'editJobTypes'])->name('Admin.EditJobTypes');
    Route::post('/UpdateJobTypes',[JobController::class,'updateJobTypes'])->name('Admin.UpdateJobTypes');

    // mode
    Route::get('/JobMode', [JobController::class, 'jobMode'])->name('Admin.JobMode');
    Route::post('/GetJobMode', [JobController::class, 'getJobMode'])->name('Admin.GetJobMode');
    Route::post('/AddJobMode', [JobController::class, 'addJobMode'])->name('Admin.AddJobMode');
    Route::post('/ChangeJobModeStatus',[JobController::class,'changeJobModeStatus'])->name('Admin.ChangeJobModeStatus');
    Route::post('/DeleteJobMode',[JobController::class,'deleteJobMode'])->name('Admin.DeleteJobMode');
    Route::post('/EditJobMode',[JobController::class,'editJobMode'])->name('Admin.EditJobMode');
    Route::post('/UpdateJobMode',[JobController::class,'updateJobMode'])->name('Admin.UpdateJobMode');

    // Shift
    Route::get('/JobShift', [JobController::class, 'jobShift'])->name('Admin.JobShift');
    Route::post('/GetJobShift', [JobController::class, 'getJobShift'])->name('Admin.GetJobShift');
    Route::post('/AddJobShift', [JobController::class, 'addJobShift'])->name('Admin.AddJobShift');
    Route::post('/ChangeJobShiftStatus',[JobController::class,'changeJobShiftStatus'])->name('Admin.ChangeJobShiftStatus');
    Route::post('/DeleteJobShift',[JobController::class,'deleteJobShift'])->name('Admin.DeleteJobShift');
    Route::post('/EditJobShift',[JobController::class,'editJobShift'])->name('Admin.EditJobShift');
    Route::post('/UpdateJobShift',[JobController::class,'updateJobShift'])->name('Admin.UpdateJobShift');

    // experience
    Route::get('/JobExperience', [JobController::class, 'jobExperience'])->name('Admin.JobExperience');
    Route::post('/GetJobExperience', [JobController::class, 'getJobExperience'])->name('Admin.GetJobExperience');
    Route::post('/AddJobExperience', [JobController::class, 'addJobExperience'])->name('Admin.AddJobExperience');
    Route::post('/ChangeJobExperienceStatus',[JobController::class,'changeJobExperienceStatus'])->name('Admin.ChangeJobExperienceStatus');
    Route::post('/DeleteJobExperience',[JobController::class,'deleteJobExperience'])->name('Admin.DeleteJobExperience');
    Route::post('/EditJobExperience',[JobController::class,'editJobExperience'])->name('Admin.EditJobExperience');
    Route::post('/UpdateJobExperience',[JobController::class,'updateJobExperience'])->name('Admin.UpdateJobExperience');

    //  CompanyController
    Route::get('/Companies', [CompanyController::class, 'Companies'])->name('Admin.Companies');
    Route::post('/GetCompanies', [CompanyController::class, 'getCompanies'])->name('Admin.GetCompanies');
    Route::post('/AddCompany', [CompanyController::class, 'addCompany'])->name('Admin.AddCompany');
    Route::post('/ChangeCompanyStatus',[CompanyController::class,'changeCompanyStatus'])->name('Admin.ChangeCompanyStatus');
    Route::post('/DeleteCompany',[CompanyController::class,'deleteCompany'])->name('Admin.DeleteCompany');
    Route::post('/EditCompany',[CompanyController::class,'editCompany'])->name('Admin.EditCompany');
    Route::post('/UpdateCompany',[CompanyController::class,'updateCompany'])->name('Admin.UpdateCompany');

    // Recruiters
    Route::get('/Recruiters', [RecruiterController::class, 'recruiters'])->name('Admin.Recruiters');
    Route::post('/GetRecruiters', [RecruiterController::class, 'getRecruiters'])->name('Admin.GetRecruiters');
    Route::post('/AddRecruiter', [RecruiterController::class, 'addRecruiter'])->name('Admin.AddRecruiter');
    Route::post('/ChangeRecruiterStatus',[RecruiterController::class,'changeRecruiterStatus'])->name('Admin.ChangeRecruiterStatus');
    Route::post('/DeleteRecruiter',[RecruiterController::class,'deleteRecruiter'])->name('Admin.DeleteRecruiter');
    Route::post('/EditRecruiter',[RecruiterController::class,'editRecruiter'])->name('Admin.EditRecruiter');
    Route::post('/UpdateRecruiter',[RecruiterController::class,'updateRecruiter'])->name('Admin.UpdateRecruiter');

});