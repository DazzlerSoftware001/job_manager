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

