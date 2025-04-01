<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\RecruiterController;
use App\Http\Controllers\Admin\AuthController;

Route::prefix('Admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('Admin.login');
    Route::post('/loginInsert', [AuthController::class, 'loginInsert'])->name('Admin.loginInsert');

    // Protected Routes with Middleware
    Route::middleware('admin')->group(function () {
        Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('Admin.dashboard');
        Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData'])->name('Admin.dashboardData');
        Route::post('/updateProfileImage', [DashboardController::class, 'updateProfileImage'])->name('Admin.UpdateProfileImage');
        Route::post('/updateProfileName', [DashboardController::class, 'updateProfileName'])->name('Admin.UpdateProfileName');

        Route::get('/JobSkill', [JobController::class, 'JobSkill'])->name('Admin.JobSkill');
        Route::post('/GetJobSkill', [JobController::class, 'getJobSkill'])->name('Admin.GetJobSkill');
        Route::post('/AddJobSkill', [JobController::class, 'addJobSkill'])->name('Admin.AddJobSkill');
        Route::post('/ChangeJobSkillStatus',[JobController::class,'changeJobSkillStatus'])->name('Admin.ChangeJobSkillStatus');
        Route::post('/DeleteJobSkill',[JobController::class,'deleteJobSkill'])->name('Admin.DeleteJobSkill');
        Route::post('/EditJobSkill',[JobController::class,'editJobSkill'])->name('Admin.EditJobSkill');
        Route::post('/UpdateJobSkill',[JobController::class,'updateJobSkill'])->name('Admin.UpdateJobSkill');


        // Department
        Route::get('/JobDepartment', [JobController::class, 'JobDepartment'])->name('Admin.JobDepartment');
        Route::post('/GetJobDepartment', [JobController::class, 'getJobDepartment'])->name('Admin.GetJobDepartment');
        Route::post('/AddJobDepartment', [JobController::class, 'addJobDepartment'])->name('Admin.AddJobDepartment');
        Route::post('/ChangeJobDepartmentStatus',[JobController::class,'changeJobDepartmentStatus'])->name('Admin.ChangeJobDepartmentStatus');
        Route::post('/DeleteJobDepartment',[JobController::class,'deleteJobDepartment'])->name('Admin.DeleteJobDepartment');
        Route::post('/EditJobDepartment',[JobController::class,'editJobDepartment'])->name('Admin.EditJobDepartment');
        Route::post('/UpdateJobDepartment',[JobController::class,'updateJobDepartment'])->name('Admin.UpdateJobDepartment');


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


        // Category
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


        // Currency
        Route::get('/JobCurrency', [JobController::class, 'jobCurrency'])->name('Admin.JobCurrency');
        Route::post('/GetJobCurrency', [JobController::class, 'getJobCurrency'])->name('Admin.GetJobCurrency');
        Route::post('/AddJobCurrency', [JobController::class, 'addJobCurrency'])->name('Admin.AddJobCurrency');
        Route::post('/ChangeJobCurrencyStatus',[JobController::class,'changeJobCurrencyStatus'])->name('Admin.ChangeJobCurrencyStatus');
        Route::post('/DeleteJobCurrency',[JobController::class,'deleteJobCurrency'])->name('Admin.DeleteJobCurrency');
        Route::post('/EditJobCurrency',[JobController::class,'editJobCurrency'])->name('Admin.EditJobCurrency');
        Route::post('/UpdateJobCurrency',[JobController::class,'updateJobCurrency'])->name('Admin.UpdateJobCurrency');

        // Annual Salary
        Route::get('/JobSalary', [JobController::class, 'jobSalary'])->name('Admin.JobSalary');
        Route::post('/GetJobSalary', [JobController::class, 'getJobSalary'])->name('Admin.GetJobSalary');
        Route::post('/AddJobSalary', [JobController::class, 'addJobSalary'])->name('Admin.AddJobSalary');
        Route::post('/ChangeJobSalaryStatus',[JobController::class,'changeJobSalaryStatus'])->name('Admin.ChangeJobSalaryStatus');
        Route::post('/DeleteJobSalary',[JobController::class,'deleteJobSalary'])->name('Admin.DeleteJobSalary');
        Route::post('/EditJobSalary',[JobController::class,'editJobSalary'])->name('Admin.EditJobSalary');
        Route::post('/UpdateJobSalary',[JobController::class,'updateJobSalary'])->name('Admin.UpdateJobSalary');



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


        // Interview Type
        Route::get('/JobIntType', [JobController::class, 'JobIntType'])->name('Admin.JobIntType');
        Route::post('/GetJobIntType', [JobController::class, 'getJobIntType'])->name('Admin.GetJobIntType');
        Route::post('/AddJobIntType', [JobController::class, 'addJobIntType'])->name('Admin.AddJobIntType');
        Route::post('/ChangeJobIntTypeStatus',[JobController::class,'changeJobIntTypeStatus'])->name('Admin.ChangeJobIntTypeStatus');
        Route::post('/DeleteJobIntType',[JobController::class,'deleteJobIntType'])->name('Admin.DeleteJobIntType');
        Route::post('/EditJobIntType',[JobController::class,'editJobIntType'])->name('Admin.EditJobIntType');
        Route::post('/UpdateJobIntType',[JobController::class,'updateJobIntType'])->name('Admin.UpdateJobIntType');


        // Educational Qualifications
        Route::get('/JobEducation', [JobController::class, 'jobEducation'])->name('Admin.JobEducation');
        Route::post('/GetJobEducation', [JobController::class, 'getJobEducation'])->name('Admin.GetJobEducation');
        Route::post('/AddJobEducation', [JobController::class, 'addJobEducation'])->name('Admin.AddJobEducation');
        Route::post('/ChangeJobEducationStatus',[JobController::class,'changeJobEducationStatus'])->name('Admin.ChangeJobEducationStatus');
        Route::post('/DeleteJobEducation',[JobController::class,'deleteJobEducation'])->name('Admin.DeleteJobEducation');
        Route::post('/EditJobEducation',[JobController::class,'editJobEducation'])->name('Admin.EditJobEducation');
        Route::post('/UpdateJobEducation',[JobController::class,'updateJobEducation'])->name('Admin.UpdateJobEducation');



        // Job Post 
        Route::get('/JobPost', [JobController::class, 'jobPost'])->name('Admin.JobPost');
        Route::post('/GetJobPost', [JobController::class, 'getJobPost'])->name('Admin.GetJobPost');
        Route::post('/AddJobPost', [JobController::class, 'addJobPost'])->name('Admin.AddJobPost');
        Route::post('/VerifyStatus', [JobController::class, 'verifyStatus'])->name('Admin.VerifyStatus');
        Route::post('/ChangeJobPostStatus',[JobController::class,'changeJobPostStatus'])->name('Admin.ChangeJobPostStatus');
        Route::post('/DeleteJobPost',[JobController::class,'deleteJobPost'])->name('Admin.DeleteJobPost');
        Route::post('/EditJobPost',[JobController::class,'editJobPost'])->name('Admin.EditJobPost');
        Route::post('/UpdateJobPost',[JobController::class,'updateJobPost'])->name('Admin.UpdateJobPost');

        Route::get('/VerifiedJobs',[JobController::class, 'verifiedJobs'])->name('Admin.VerifiedJobs');
        Route::get('/RejectedJobs',[JobController::class, 'rejectedJobs'])->name('Admin.RejectedJobs');
        Route::get('/PendingJobs',[JobController::class, 'pendingJobs'])->name('Admin.PendingJobs');




        Route::post('/logout', [AuthController::class, 'logout'])->name('Admin.logout');

    });

});