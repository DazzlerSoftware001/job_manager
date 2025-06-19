<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('Admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('Admin.dashboard'));
});


// All Applicants
Breadcrumbs::for('Admin.AllApplicants', function (BreadcrumbTrail $trail) {
    $trail->push('All Applicants', route('Admin.AllApplicants'));
});

// Applicant Details (with dynamic parameters)
// Breadcrumbs::for('Admin.ApllicantsDetails', function (BreadcrumbTrail $trail, $userId, $jobId) {
//     $trail->parent('Admin.AllApplicants');
//     $trail->push('Applicant Details', route('Admin.ApllicantsDetails', ['userId' => $userId, 'jobId' => $jobId]));
// });

Breadcrumbs::for('Admin.ApllicantsDetails', function (BreadcrumbTrail $trail) {
    $trail->parent('Admin.AllApplicants');
    $trail->push('Applicant Details', route('Admin.ApllicantsDetails', [
        'userId' => request()->route('userId'),
        'jobId' => request()->route('jobId')
    ]));
});

