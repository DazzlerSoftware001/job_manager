<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('Admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('Admin.dashboard'));
});

Breadcrumbs::for('Admin.CreateJob', function (BreadcrumbTrail $trail) {
    $trail->push('CreateJob', route('Admin.CreateJob'));
});

Breadcrumbs::for('Admin.JobList', function (BreadcrumbTrail $trail) {
    $trail->push('JobList', route('Admin.JobList'));
});

Breadcrumbs::for('Admin.ViewJobPost', function (BreadcrumbTrail $trail) {
    $trail->parent('Admin.JobList');
    $trail->push('ViewJobPost', route('Admin.JobList', [
        'id' => request()->route('id'),
    ]));
});

Breadcrumbs::for('Admin.ShowVerifiedJobs', function (BreadcrumbTrail $trail) {
    $trail->push('Verified Jobs', route('Admin.ShowVerifiedJobs'));
});

Breadcrumbs::for('Admin.ShowRejectedJobs', function (BreadcrumbTrail $trail) {
    $trail->push('Rejected Job', route('Admin.ShowRejectedJobs'));
});

Breadcrumbs::for('Admin.ShowPendingJobs', function (BreadcrumbTrail $trail) {
    $trail->push('Pending Job', route('Admin.ShowPendingJobs'));
});

Breadcrumbs::for('Admin.JobSkill', function (BreadcrumbTrail $trail) {
    $trail->push('JobSkill', route('Admin.JobSkill'));
});

Breadcrumbs::for('Admin.JobCategory', function (BreadcrumbTrail $trail) {
    $trail->push('JobCategory', route('Admin.JobCategory'));
});

Breadcrumbs::for('Admin.JobDepartment', function (BreadcrumbTrail $trail) {
    $trail->push('JobDepartment', route('Admin.JobDepartment'));
});

Breadcrumbs::for('Admin.JobRole', function (BreadcrumbTrail $trail) {
    $trail->push('JobRole', route('Admin.JobRole'));
});

Breadcrumbs::for('Admin.JobLocation', function (BreadcrumbTrail $trail) {
    $trail->push('JobLocation', route('Admin.JobLocation'));
});

Breadcrumbs::for('Admin.JobTypes', function (BreadcrumbTrail $trail) {
    $trail->push('Job types', route('Admin.JobTypes'));
});


Breadcrumbs::for('Admin.JobMode', function (BreadcrumbTrail $trail) {
    $trail->push('Job Mode', route('Admin.JobMode'));
});

Breadcrumbs::for('Admin.JobShift', function (BreadcrumbTrail $trail) {
    $trail->push('Job Shift', route('Admin.JobShift'));
});


Breadcrumbs::for('Admin.JobExperience', function (BreadcrumbTrail $trail) {
    $trail->push('Job Experience', route('Admin.JobExperience'));
});

Breadcrumbs::for('Admin.JobCurrency', function (BreadcrumbTrail $trail) {
    $trail->push('Job Currency', route('Admin.JobCurrency'));
});

Breadcrumbs::for('Admin.JobSalary', function (BreadcrumbTrail $trail) {
    $trail->push('Job Salary', route('Admin.JobSalary'));
});

Breadcrumbs::for('Admin.JobIntType', function (BreadcrumbTrail $trail) {
    $trail->push('Job Interview', route('Admin.JobIntType'));
});

Breadcrumbs::for('Admin.JobEducation', function (BreadcrumbTrail $trail) {
    $trail->push('Job Education', route('Admin.JobEducation'));
});

Breadcrumbs::for('Admin.Companies', function (BreadcrumbTrail $trail) {
    $trail->push('Companies', route('Admin.Companies'));
});

Breadcrumbs::for('Admin.Recruiters', function (BreadcrumbTrail $trail) {
    $trail->push('Recruiters', route('Admin.Recruiters'));
});

Breadcrumbs::for('Admin.UserList', function (BreadcrumbTrail $trail) {
    $trail->push('UserList', route('Admin.UserList'));
});

Breadcrumbs::for('Admin.UsersDetails', function (BreadcrumbTrail $trail) {
    $trail->parent('Admin.UserList');
    $trail->push('User Details', route('Admin.UsersDetails', [
        'userId' => request()->route('userId')
    ]));
});

Breadcrumbs::for('Admin.EditUser', function (BreadcrumbTrail $trail) {
    $trail->parent('Admin.UserList');
    $trail->push('EditUser', route('Admin.EditUser', [
        'id' => request()->route('id')
    ]));
});








// All Applicants
Breadcrumbs::for('Admin.AllApplicants', function (BreadcrumbTrail $trail) {
    $trail->push('All Applicants', route('Admin.AllApplicants'));
});


Breadcrumbs::for('Admin.ApllicantsDetails', function (BreadcrumbTrail $trail) {
    $trail->parent('Admin.AllApplicants');
    $trail->push('Applicant Details', route('Admin.ApllicantsDetails', [
        'userId' => request()->route('userId'),
        'jobId' => request()->route('jobId')
    ]));
});


Breadcrumbs::for('Admin.menu', function (BreadcrumbTrail $trail) {
    $trail->push('menu', route('Admin.menu'));
});

Breadcrumbs::for('Admin.FrontPageSettings', function (BreadcrumbTrail $trail) {
    $trail->push('FrontPage', route('Admin.FrontPageSettings'));
});

Breadcrumbs::for('Admin.HomePageSettings', function (BreadcrumbTrail $trail) {
    $trail->push('HomePage', route('Admin.HomePageSettings'));
});

Breadcrumbs::for('Admin.PageSettings', function (BreadcrumbTrail $trail) {
    $trail->push('PageSettings', route('Admin.PageSettings'));
});

Breadcrumbs::for('Admin.Footer', function (BreadcrumbTrail $trail) {
    $trail->push('Footer', route('Admin.Footer'));
});

Breadcrumbs::for('Admin.GeneralSetting', function (BreadcrumbTrail $trail) {
    $trail->push('GeneralSetting', route('Admin.GeneralSetting'));
});

Breadcrumbs::for('Admin.EmailSetting', function (BreadcrumbTrail $trail) {
    $trail->push('EmailSetting', route('Admin.EmailSetting'));
});

Breadcrumbs::for('Admin.EmailTemplates', function (BreadcrumbTrail $trail) {
    $trail->push('EmailTemplates', route('Admin.EmailTemplates'));
});

Breadcrumbs::for('Admin.Database', function (BreadcrumbTrail $trail) {
    $trail->push('Database', route('Admin.Database'));
});

Breadcrumbs::for('Admin.Maintenance', function (BreadcrumbTrail $trail) {
    $trail->push('Maintenance', route('Admin.Maintenance'));
});

